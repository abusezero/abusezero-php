<?php
declare(strict_types=1);
namespace AbuseZero;
final class Helpers {
    public static function incomingRequest(#[\SensitiveParameter] string $method, #[\SensitiveParameter] string $url, #[\SensitiveParameter] array $headers): array {
        $u = parse_url($url);
        if (!$u || !isset($u['host']) || !in_array($u['scheme'] ?? '', ['http','https'], true) || isset($u['user']) || isset($u['pass']) || strlen($url)>4096 || !preg_match('/^[A-Za-z]{1,16}$/D', $method)) throw new \InvalidArgumentException('Provide an incoming HTTP method and URL without credentials.');
        $clean=[]; $size=0;
        foreach ($headers as $name=>$value) {
            $name=strtolower((string)$name);$value=self::headerValue($value);
            if ($value===null || preg_match('/^(authorization|proxy-authorization|cookie|set-cookie|x-api-key|x-auth-token|x-csrf-token|x-xsrf-token)$|(?:^|-)(token|secret|session|password|api-key|apikey)(?:-|$)/i',$name) || !preg_match("/^[!#$%&'*+.^_`|~0-9a-z-]{1,128}$/D",$name) || strpbrk($value,"\r\n")!==false) continue;
            $value=substr($value,0,8192);
            if (count($clean)>=64 || $size+strlen($name)+strlen($value)>32768) continue;
            $clean[$name]=$value; $size+=strlen($name)+strlen($value);
        }
        return ['method'=>$method,'url'=>$url,'headers'=>$clean];
    }
    /** One header value: a string, or a list of strings joined with ", ". Anything else is left out. */
    private static function headerValue(mixed $value): ?string {
        if (is_string($value)) return $value;
        if (is_array($value) && $value !== [] && array_is_list($value) && count(array_filter($value,'is_string'))===count($value)) return implode(', ',$value);
        return null;
    }
    private static function keyedHash(#[\SensitiveParameter] string $secret,string $keyVersion,#[\SensitiveParameter] string $value): array {
        if ($secret==='') throw new \InvalidArgumentException('Provide your identifier hash secret.');
        if (!preg_match('/^[\x21-\x7e]{1,128}$/D',$keyVersion)) throw new \InvalidArgumentException('Use a printable key version with no spaces.');
        return ['algorithm'=>'hmac-sha256','key_version'=>$keyVersion,'value'=>hash_hmac('sha256',$value,$secret)];
    }
    public static function createPhoneHash(#[\SensitiveParameter] string $secret,string $keyVersion,#[\SensitiveParameter] string $e164): array {
        if (!preg_match('/^\+[1-9][0-9]{7,14}$/D',$e164)) throw new \InvalidArgumentException('Normalize the phone number to E.164 before hashing it.');
        return self::keyedHash($secret,$keyVersion,'abusezero:phone:e164:v1:'.$e164);
    }
    public static function createCustomIdentifier(#[\SensitiveParameter] string $secret,string $keyVersion,string $key,#[\SensitiveParameter] string $value): array {
        if (!preg_match('/^[a-z][a-z0-9_]{0,63}$/D',$key)) throw new \InvalidArgumentException('Use a lowercase identifier key that starts with a letter.');
        if ($value==='') throw new \InvalidArgumentException('Normalize the identifier to a non-empty value before hashing it.');
        return ['key'=>$key,'value_hash'=>self::keyedHash($secret,$keyVersion,'abusezero:custom:'.$key.':v1:'.$value)];
    }
    public static function verifyWebhook(#[\SensitiveParameter] string $payload,#[\SensitiveParameter] array $headers,#[\SensitiveParameter] string|array $secret,float $toleranceSeconds=300,?float $now=null): array {
        if (!is_finite($toleranceSeconds)||$toleranceSeconds<0) throw new \InvalidArgumentException('Set the tolerance to 0 seconds or more.');
        $keys=[];
        foreach ((is_array($secret)?$secret:[$secret]) as $s) {
            if ($s===null || $s===false || is_string($s)&&trim($s)==='') continue;
            if (!is_string($s)) throw new \InvalidArgumentException('Provide the complete webhook signing secret.');
            if (!preg_match('/^whsk_[A-Za-z0-9+\/]{43}=$/D',trim($s))) throw new \InvalidArgumentException('Provide the complete webhook signing secret.');
            $keys[]=base64_decode(substr(trim($s),5),true);
        }
        if (!$keys) throw new \InvalidArgumentException('Provide a webhook signing secret.');
        $h=[];foreach($headers as $name=>$value){$value=self::headerValue($value);if($value!==null)$h[strtolower((string)$name)]=$value;}
        $id=$h['abusezero-webhook-id']??'';$stamp=$h['abusezero-webhook-timestamp']??'';
        if ($id===''||!preg_match('/^[0-9]{1,12}$/D',$stamp)||abs(($now??microtime(true))-(float)$stamp)>$toleranceSeconds) throw new WebhookVerificationError("The webhook's headers are incomplete, or its timestamp is outside the tolerance.");
        $matched=false;
        foreach ($keys as $key) {
            $expected=hash_hmac('sha256',$id.'.'.$stamp.'.'.$payload,$key,true);
            foreach (preg_split('/\s+/',$h['abusezero-webhook-signature']??'') as $offered) {
                if (str_starts_with($offered,'v1,')) {$value=base64_decode(substr($offered,3),true);if ($value!==false&&hash_equals($expected,$value)) $matched=true;}
            }
        }
        if (!$matched) throw new WebhookVerificationError("The webhook signature doesn't match. Check the endpoint's signing secret, and pass the request body exactly as received.");
        try {$event=json_decode($payload,true,512,JSON_THROW_ON_ERROR|JSON_BIGINT_AS_STRING);}catch (\JsonException) {throw new WebhookVerificationError("The webhook body isn't an AbuseZero event.");}
        if (!is_array($event)||($event['object']??null)!=='event'||($event['id']??null)!==$id) throw new WebhookVerificationError("The webhook body isn't an AbuseZero event.");
        return $event;
    }
}
