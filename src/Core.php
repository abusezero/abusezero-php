<?php
declare(strict_types=1);
namespace AbuseZero;
abstract class Core {
    protected const PUBLIC_CLIENT=false;
    private static ?array $operations=null;
    private ?\CurlHandle $handle=null;
    private \SensitiveParameterValue $credential;
    private bool $key;
    private string $workspace;
    private string $outage;
    private string $base;
    private string $agent;
    private ?\Closure $transport;
    public function __construct(#[\SensitiveParameter] array $options=[]) {
        self::$operations ??= json_decode(file_get_contents(__DIR__.'/operations.json'),true,512,JSON_THROW_ON_ERROR);
        $key=$options['key']??null;$token=$options['accessToken']??null;$workspace=$options['workspace']??'';
        if (!static::PUBLIC_CLIENT && (bool)$key===(bool)$token) throw new AbuseZeroError('CREDENTIAL_REQUIRED','Provide one AbuseZero server API key or OAuth access token.',401);
        if ($key && !preg_match('/^(sk|rk)_[1-9][0-9]{19}\.[A-Za-z0-9_-]{43}$/D',$key)) throw new AbuseZeroError('INVALID_KEY','Use a restricted or broad-access server API key from Developers → API & Webhooks → API keys in the AbuseZero dashboard.',401);
        if ($token&&(!is_string($token)||!preg_match('/^[\x21-\x7e]{1,8192}$/D',$token)))throw new AbuseZeroError('INVALID_TOKEN','Use the access token from an OAuth sign-in or a machine client.',401);
        if ($token&&!$workspace) throw new AbuseZeroError('WORKSPACE_REQUIRED','Provide the workspace selected for this OAuth connection.',422);
        if ($workspace!==''&&!preg_match('/^[1-9][0-9]{19}$/D',$workspace)) throw new \InvalidArgumentException("Use the workspace's 20-digit ID.");
        $this->outage=$options['outage']??'throw';
        if (!in_array($this->outage,['throw','allow','deny'],true)) throw new \InvalidArgumentException('Set outage to throw, allow or deny.');
        $this->base=rtrim($options['baseUrl']??'https://api.abusezero.com','/');$u=parse_url($this->base);
        if (!$u||!isset($u['host'])||isset($u['user'])||isset($u['pass'])||isset($u['query'])||isset($u['fragment'])||!in_array($u['path']??'',['','/'],true)||!(($u['scheme']??'')==='https'||($u['scheme']??'')==='http'&&in_array($u['host'],['localhost','127.0.0.1','[::1]','::1'],true))) throw new \InvalidArgumentException('Use an HTTPS API origin, or HTTP on loopback for local testing.');
        $this->credential=new \SensitiveParameterValue($key??$token??'');$this->key=(bool)$key;$this->workspace=$workspace;
        $this->agent=substr(preg_replace('/[^\x20-\x7e]/','',$options['agent']??''),0,512);
        $this->transport=isset($options['transport'])?\Closure::fromCallable($options['transport']):null;
    }
    public function __debugInfo(): array {return ['client'=>static::class];}
    public function __serialize(): array {throw new \LogicException('AbuseZero clients hold credentials and can\'t be serialized. Create the client where you use it.');}
    public function __unserialize(array $data): void {throw new \LogicException('AbuseZero clients can\'t be unserialized. Create a new client.');}
    public function close(): void {$this->handle=null;}
    public function __destruct() {$this->close();}
    // Requests are checked in full. Responses are checked for their shape only: within v1 they can gain fields and values and raise limits.
    private static function validate(#[\SensitiveParameter] mixed $value,array $s,?array $root=null,bool $response=false,string $at=''): void {
        $root??=$s;$fail=fn()=>new \InvalidArgumentException('Check '.($at===''?'the request':$at).' against the API schema.');
        if (isset($s['$ref'])) {$ref=$root;foreach(explode('/',substr($s['$ref'],2)) as $part) $ref=$ref[str_replace(['~1','~0'],['/','~'],$part)];self::validate($value,$ref,$root,$response,$at);return;}
        $variants=$s['anyOf']??$s['oneOf']??null;
        if ($variants) {$count=0;foreach ($variants as $v) {try {self::validate($value,$v,$root,$response,$at);$count++;} catch (\InvalidArgumentException) {}} if($count===0||!$response&&isset($s['oneOf'])&&$count!==1)throw $fail();}
        $matches=fn($t)=>match($t) {'null'=>$value===null,'string'=>is_string($value),'object'=>is_array($value)&&($value===[]||!array_is_list($value))||is_object($value),'array'=>is_array($value)&&array_is_list($value),'integer'=>is_int($value),'number'=>is_int($value)||is_float($value)&&is_finite($value),'boolean'=>is_bool($value),default=>true};
        if (isset($s['type'])&&!array_filter((array)$s['type'],$matches)) throw $fail();
        if (!$response&&(array_key_exists('const',$s)&&$value!==$s['const']||isset($s['enum'])&&!in_array($value,$s['enum'],true))) throw $fail();
        if (($s['type']??null)==='object'&&is_array($value)) {
            foreach ($s['required']??[] as $key) if (!array_key_exists($key,$value)&&($response||!self::hasDefault($s['properties'][$key]??[],$root))) throw new \InvalidArgumentException('Check '.($at===''?$key:$at.'.'.$key).' against the API schema.');
            foreach ($value as $key=>$v) {if(!$response&&isset($s['propertyNames']))self::validate((string)$key,$s['propertyNames'],$root,false,$at);$child=$s['properties'][$key]??$s['additionalProperties']??[];if($child===false){if($response)continue;throw new \InvalidArgumentException('Check '.($at===''?(string)$key:$at.'.'.$key).' against the API schema.');}if(is_array($child))self::validate($v,$child,$root,$response,$at===''?(string)$key:$at.'.'.$key);}
        }
        if (($s['type']??null)==='array'&&is_array($value)) {if(!$response&&(count($value)<($s['minItems']??0)||count($value)>($s['maxItems']??INF)))throw $fail();foreach($value as $i=>$v)self::validate($v,$s['items']??[],$root,$response,$at===''?(string)$i:$at.'.'.$i);}
        if ($response) return;
        if (is_string($value)) {$length=preg_match_all('/./us',$value);if($length<($s['minLength']??0)||$length>($s['maxLength']??INF)||isset($s['pattern'])&&!preg_match('~'.str_replace('~','\~',$s['pattern']).'~u',$value))throw $fail();}
        if (is_int($value)||is_float($value)) {if(isset($s['multipleOf'])&&abs($value/$s['multipleOf']-round($value/$s['multipleOf']))>1e-9)throw $fail();if($value<($s['minimum']??-INF)||$value>($s['maximum']??INF)||$value<=($s['exclusiveMinimum']??-INF)||$value>=($s['exclusiveMaximum']??INF))throw $fail();}
    }
    // The API fills in a field that has a default, so a request may leave it out even where the schema lists it as required.
    private static function hasDefault(array $s,array $root): bool {
        for($depth=0;isset($s['$ref'])&&$depth<16;$depth++){$ref=$root;foreach(explode('/',substr($s['$ref'],2)) as $part)$ref=$ref[str_replace(['~1','~0'],['/','~'],$part)]??[];$s=$ref;}
        return array_key_exists('default',$s);
    }
    private static function wire(#[\SensitiveParameter] mixed $value,array $schema,?array $root=null): mixed {
        $root??=$schema;
        if(isset($schema['$ref'])){$ref=$root;foreach(explode('/',substr($schema['$ref'],2))as $p)$ref=$ref[str_replace(['~1','~0'],['/','~'],$p)];return self::wire($value,$ref,$root);}
        foreach($schema['anyOf']??$schema['oneOf']??[] as $v){try{self::validate($value,$v,$root);return self::wire($value,$v,$root);}catch(\InvalidArgumentException){}}
        if (($schema['type']??null)==='object'&&is_array($value)) {foreach($value as $k=>$v)$value[$k]=self::wire($v,$schema['properties'][$k]??(is_array($schema['additionalProperties']??null)?$schema['additionalProperties']:[]),$root);return (object)$value;}
        if (($schema['type']??null)==='array'&&is_array($value))return array_map(fn($v)=>self::wire($v,$schema['items']??[],$root),$value);
        return $value;
    }
    protected function callOperation(string $id,#[\SensitiveParameter] array $input,#[\SensitiveParameter] array $path,#[\SensitiveParameter] ?string $key): array {
        $op=self::$operations[$id];
        if ($op['public']!==static::PUBLIC_CLIENT)throw new \InvalidArgumentException('Use the matching API client.');
        if ($this->key&&$op['scope']==='operations:management')throw new AbuseZeroError('OAUTH_REQUIRED','This method needs an OAuth access token from a sign-in or a machine client.',403);
        if ($op['mutation']&&$key===null||$key!==null&&!preg_match('/^[\x21-\x7e]{1,128}$/D',$key))throw new AbuseZeroError('INVALID_IDEMPOTENCY_KEY','This method needs an idempotency key of 1–128 printable characters with no spaces.',422);
        $route=$op['path'];$expected=array_column($op['paths'],'name');$actual=array_keys($path);sort($expected);sort($actual);if($expected!==$actual)throw new \InvalidArgumentException('Pass these path fields: '.($expected?implode(', ',$expected):'none').'.');
        foreach($op['paths'] as $p){$v=$path[$p['name']];self::validate($v,$p['schema'],null,false,$p['name']);$encoded=rawurlencode((string)$v);if($p['name']==='path')$encoded=str_replace('%2F','/',$encoded);$route=str_replace('{'.$p['name'].'}',$encoded,$route);}
        if(isset($input['request'])&&is_array($input['request'])){$r=$input['request'];if(!is_string($r['method']??null)||!is_string($r['url']??null)||!is_array($r['headers']??null))throw new \InvalidArgumentException('Provide the incoming request as method, url and headers.');$input['request']=Helpers::incomingRequest($r['method'],$r['url'],$r['headers']);}
        try{self::validate($input,$op['input']);}catch(\InvalidArgumentException $e){throw new AbuseZeroError('INVALID_REQUEST',$e->getMessage(),422);}
        $headers=['Accept'=>'application/json'];if(!static::PUBLIC_CLIENT){$headers['Authorization']='Bearer '.$this->credential->getValue();if($this->workspace!=='')$headers['AbuseZero-Workspace']=$this->workspace;if($this->agent!=='')$headers['AbuseZero-Agent']=$this->agent;}
        if($key!==null)$headers['Idempotency-Key']=$key;
        $body=null;
        if($op['method']==='GET'){$query=[];foreach($input as $k=>$v)$query[$k]=is_string($v)?$v:json_encode($v,JSON_THROW_ON_ERROR);if($query)$route.='?'.http_build_query($query,'','&',PHP_QUERY_RFC3986);}
        else{$body=json_encode(self::wire($input,$op['input']),JSON_THROW_ON_ERROR|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);$headers['Content-Type']='application/json';if($id==='evaluations.create'&&strlen($body)>49152)throw new AbuseZeroError('INVALID_REQUEST','The evaluation is larger than 48 KiB. Send fewer or shorter headers in request.',422);}
        $budget=$op['timeout_ms']/1000;if($id==='events.list')$budget=max($budget,($input['wait']??0)+5);$deadline=hrtime(true)/1e9+$budget;$failure=null;$rateError=null;
        for($attempt=0;$attempt<3;$attempt++){
            $remaining=$deadline-hrtime(true)/1e9;$response=null;
            try{
                if($remaining<=0)throw new AbuseZeroError('DEADLINE_EXCEEDED','The request budget ran out. Retry with the same idempotency key before acting on the claim.',retryable:true);
                $response=$this->transport?($this->transport)($op['method'],$this->base.$route,$headers,$body,$remaining):$this->send($op['method'],$this->base.$route,$headers,$body,$remaining);
                if(hrtime(true)/1e9>=$deadline)throw new AbuseZeroError('DEADLINE_EXCEEDED','The request budget ran out. Retry with the same idempotency key before acting on the claim.',retryable:true);
                return $this->readResponse($op,$response);
            }catch(AbuseZeroError $e){$failure=$e;if($e->status===429)$rateError=$e;}
            if(!$failure->retryable||$attempt===2)break;
            $delay=[0.1,0.25][$attempt];$retry=$response['headers']['retry-after']??null;
            if($retry!==null)$delay=max($delay,is_numeric($retry)?(float)$retry:(strtotime($retry)?:time())-time());
            if(hrtime(true)/1e9+$delay>=$deadline)break;
            usleep((int)($delay*1e6));
        }
        $failure=$rateError??$failure;
        if($id==='evaluations.create'&&$this->outage!=='throw'&&$failure->retryable&&$failure->status!==429)return ['source'=>'local_outage','claim_id'=>$input['claim_id'],'result'=>$this->outage,'error'=>$failure];
        throw $failure;
    }
    private function send(string $method,#[\SensitiveParameter] string $url,#[\SensitiveParameter] array $headers,#[\SensitiveParameter] ?string $body,float $remaining): array {
        $this->handle??=curl_init();$h=$this->handle;curl_reset($h);$responseHeaders=[];
        $lines=[];foreach($headers as $k=>$v)$lines[]=$k.': '.$v;
        curl_setopt_array($h,[CURLOPT_URL=>$url,CURLOPT_CUSTOMREQUEST=>$method,CURLOPT_HTTPHEADER=>$lines,CURLOPT_RETURNTRANSFER=>true,CURLOPT_FOLLOWLOCATION=>false,CURLOPT_SSL_VERIFYPEER=>true,CURLOPT_SSL_VERIFYHOST=>2,CURLOPT_TIMEOUT_MS=>max(1,(int)($remaining*1000)),CURLOPT_CONNECTTIMEOUT_MS=>max(1,(int)($remaining*1000)),CURLOPT_PROTOCOLS=>CURLPROTO_HTTP|CURLPROTO_HTTPS,CURLOPT_HEADERFUNCTION=>static function($handle,$line)use(&$responseHeaders){$parts=explode(':',$line,2);if(count($parts)===2)$responseHeaders[strtolower(trim($parts[0]))]=trim($parts[1]);return strlen($line);}]);
        if($body!==null)curl_setopt($h,CURLOPT_POSTFIELDS,$body);
        $raw=curl_exec($h);$status=(int)curl_getinfo($h,CURLINFO_RESPONSE_CODE);
        if($raw===false){$timeout=curl_errno($h)===CURLE_OPERATION_TIMEDOUT;throw new AbuseZeroError($timeout?'DEADLINE_EXCEEDED':'TRANSPORT_ERROR',$timeout?'The request budget ran out. Retry with the same idempotency key before acting on the claim.':"AbuseZero couldn't be reached, or the response didn't arrive complete. Retry with the same idempotency key.",retryable:true);}
        return ['status'=>$status,'headers'=>$responseHeaders,'body'=>$raw];
    }
    private function readResponse(array $op,#[\SensitiveParameter] array $response): array {
        try{$data=json_decode($response['body'],true,512,JSON_THROW_ON_ERROR|JSON_BIGINT_AS_STRING);}catch(\JsonException){$data=null;}
        $status=$response['status'];
        if($status>=200&&$status<300){
            if(!is_array($data)||!str_starts_with(ltrim($response['body']),'{'))throw new AbuseZeroError('INVALID_RESPONSE',"AbuseZero's response couldn't be used. Retry with the same idempotency key before acting on the claim.",502,retryable:true);
            if(in_array($op['id'],['evaluations.create','evaluations.dry_run'],true)){
                if(($data['status']??null)==='skipped'&&is_string($data['reason']??null)&&preg_match('/^[a-z][a-z0-9_]{0,63}$/D',$data['reason'])){if($op['id']==='evaluations.create')$data['source']='abusezero';return $data;}
                $risk=$data['risk']??null;$score=$risk['score']??null;
                $valid=in_array($data['result']??null,['allow','deny'],true)&&is_array($risk)&&is_string($risk['band']??null)&&preg_match('/^[a-z][a-z0-9_]{0,63}$/D',$risk['band'])&&($score===null||(is_int($score)||is_float($score))&&$score>=0&&$score<=100);
                if($op['id']==='evaluations.create'){$valid=$valid&&($data['object']??null)==='evaluation'&&is_string($data['id']??null)&&preg_match('/^[1-9][0-9]{19}$/D',$data['id']);$reported=$data['outcome']??null;if($reported!==null&&!is_array($reported))throw new AbuseZeroError('INVALID_RESPONSE',"AbuseZero's response couldn't be used. Retry with the same idempotency key before acting on the claim.",502,retryable:true);$state=$reported['state']??$response['headers']['abusezero-outcome-state']??null;if($state!==null&&(!is_string($state)||!preg_match('/^[a-z][a-z0-9_]{0,63}$/D',$state)))$valid=false;$data['outcome']=$state===null?null:['state'=>$state,'due_at'=>$reported['due_at']??$response['headers']['abusezero-outcome-due-at']??null];$data['source']='abusezero';}
                if($op['id']==='evaluations.dry_run')$valid=$valid&&($data['object']??null)==='evaluation_dry_run'&&($data['dry_run']??null)===true;
                if(!$valid)throw new AbuseZeroError('INVALID_RESPONSE',"AbuseZero's response couldn't be used. Retry with the same idempotency key before acting on the claim.",502,retryable:true);
            }
            try{self::validate($data,$op['response'],null,true);}catch(\InvalidArgumentException){throw new AbuseZeroError('INVALID_RESPONSE',"AbuseZero's response couldn't be used. Retry with the same idempotency key before acting on the claim.",502,retryable:true);}
            return $data;
        }
        $detail=is_array($data['error']??null)?$data['error']:[];
        throw new AbuseZeroError($detail['code']??'HTTP_ERROR',$detail['message']??"AbuseZero couldn't finish the request.",$status,$response['headers']['x-request-id']??null,!in_array($status,[401,403],true)&&!($status>=300&&$status<400)&&(in_array($status,[429,502,503,504],true)||($detail['retryable']??false)===true),$detail['docs_url']??null);
    }
}
