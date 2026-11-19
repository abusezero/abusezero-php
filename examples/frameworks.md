# Laravel

Register `AbuseZero\Client` in the service container as a singleton, with the SECRET KEY from your server configuration and `outage` set to `throw`. Resolve it where you use it, including inside queued jobs: clients can't be serialized.

```php
$result = $client->evaluate([
    'benefit' => 'pro_trial', 'claim_id' => (string) $trial->id,
    'subject' => ['email' => $request->user()->email],
    'context' => ['ip' => $request->ip()], // Set Laravel's trusted proxies so this is the visitor's IP.
    'identifiers' => ['device_token' => (string) $request->input('device_token')],
    'request' => ['method' => $request->method(), 'url' => $request->fullUrl(), 'headers' => $request->headers->all()],
], idempotencyKey: 'evaluate:' . $trial->id);
```

Use your own stored claim ID and the signed-in user's email. Handle each result as the README's Results table describes before you grant the benefit.

For webhooks, pass `$request->getContent()` and `$request->headers->all()` to `AbuseZero\Helpers::verifyWebhook()`, and act on the returned event only after it succeeds.
