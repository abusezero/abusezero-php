# abusezero/abusezero-php

**Abuse prevention API for SaaS**

Prevent users from creating extra accounts to repeatedly claim your trials, free plans, credits, and other benefits.

The official AbuseZero PHP SDK runs evaluations and manages your workspace from your server.

```sh
composer require abusezero/abusezero-php
```

Requires PHP 8.3 or later with the cURL extension.

## Server

```php
<?php
require __DIR__ . '/vendor/autoload.php';

$abusezero = new AbuseZero\Client(['key' => getenv('ABUSEZERO_SECRET_KEY'), 'outage' => 'throw']);

$evaluation = $abusezero->evaluate([
    'benefit' => 'pro_trial',
    'claim_id' => $claimId, // Your own ID for the claim, as a string.
    'subject' => ['email' => $email],
    'context' => ['ip' => $clientIp], // The visitor's IP from your trusted proxy settings.
    'identifiers' => ['device_token' => $deviceToken], // From the standalone browser script.
    'request' => ['method' => $method, 'url' => $url, 'headers' => $headers], // The incoming request.
], idempotencyKey: "claim:{$claimId}");
```

Keep SECRET KEYS and the client in your backend. Create one client per process and reuse it, and call `close()` when the process stops. Clients hold your credential, so they can't be serialized: create the client inside a queued job instead of passing it in.

Send IDs as strings. Send the visitor's IP address as `context.ip`, from your application's trusted proxy settings: the SDK doesn't infer it. `request` takes the request your server received. Its `headers` map each header name to a string or a list of strings, as `getallheaders()` or your framework returns them. Credential headers, such as `Authorization` and `Cookie`, are removed before it's sent.

### Results

Check `status` first, then `source`, then `result`.

| Result | What to do |
| --- | --- |
| `status` is `skipped` | No evaluation ran. Handle it as its own branch. See [skipped evaluations](#skipped-evaluations). |
| `source` is `local_outage` | AbuseZero couldn't be reached or didn't answer in time. `result` is the value you chose for `outage`, and there's no `id` yet. |
| `result` is `deny` | Don't grant the benefit. |
| `result` is `allow` | Grant the benefit, then report the outcome. |

After the grant succeeds, report it on the evaluation:

```php
$abusezero->outcome(['outcome' => 'granted'], ['id' => $evaluation['id']], "grant:{$claimId}");
```

A `local_outage` result has no evaluation to report on. When AbuseZero is reachable again, evaluate the claim again with the same idempotency key, then report the outcome on that evaluation.

### Outages and retries

`outage` decides what `evaluate()` does when AbuseZero can't be reached or can't finish the request in time. With `throw`, the default, it throws the `AbuseZeroError` and your code decides. With `allow` or `deny`, it returns a `local_outage` result with that decision and the error. Rate limits (`429`) and errors that aren't retryable always throw, and other methods always throw.

A call makes at most three attempts. Network errors, retryable API errors and HTTP 429, 502, 503 and 504 are retried, and `Retry-After` sets the shortest wait. Every attempt sends the same body and idempotency key. Each call has one request budget, including waits: 1.8 seconds for `evaluate()` and 5 seconds for other methods. `events()` adds 5 seconds to the wait you request.

### Scopes

RESTRICTED KEYS use `operations:general`, `operations:configuration` or both. The scopes are independent. Evaluations, evidence, outcome reports, imports, exports, user-history deletion, webhook test events and resending webhook deliveries use `operations:general`. Configuration changes use `operations:configuration`. A SECRET KEY holds both. API keys never hold `operations:management`: it needs an OAuth sign-in or a machine client.

To act for a person who signed in with OAuth, pass their access token and the workspace instead of a key:

```php
$abusezero = new AbuseZero\Client([
    'accessToken' => $accessToken,
    'workspace' => getenv('ABUSEZERO_WORKSPACE'),
    'outage' => 'throw',
]);
```

The member's permissions in that workspace still apply. A machine client's access token works the same way. See [Machine clients](https://docs.abusezero.com/docs/keys-and-access#machine-clients) and [create a machine client](https://docs.abusezero.com/docs/api-reference/machine-clients#create-a-machine-client) for its token endpoint and audience.

### Skipped evaluations

When a workspace can't run an evaluation, `evaluate()` and `dryRunEvaluation()` return `['status' => 'skipped', 'reason' => …]` with no `result`. No allow or deny was decided, so handle skips as their own branch in your flow. Your `outage` setting doesn't apply. A skip is final for its idempotency key: once the workspace can run evaluations again, evaluate the claim with a new key.

| Reason | What it means |
| --- | --- |
| `insufficient_credits` | The workspace doesn't have enough credits for the evaluation. |
| `billing_overdue` | The workspace doesn't have enough credits while a payment is overdue. |
| `service_inactive` | The workspace can't run evaluations right now. |
| `benefit_paused` | The benefit is paused because the workspace is over its plan's limits. |

The workspace owner sees the credit balance and usage against plan limits and buys credits in **Workspace settings → Usage**, manages plans in **Workspace settings → Subscription**, and manages payments in **Workspace settings → Billing**. `usage()` reads the same balance. New reasons can be added within API `v1`, so handle a reason you don't recognize like any other skip.

### Webhooks

```php
$event = AbuseZero\Helpers::verifyWebhook(
    $rawBody, // The request body exactly as received.
    $headers,
    getenv('ABUSEZERO_WEBHOOK_SECRET'),
);
```

`verifyWebhook()` checks an AbuseZero webhook request and returns its event. It throws `AbuseZero\WebhookVerificationError` when the request isn't signed with the endpoint's `whsk_` secret, was changed, or is more than 5 minutes old (the fourth argument changes this, in seconds). During a secret rotation, pass both secrets as an array; an entry that isn't set or is empty is skipped. A secret that isn't a complete `whsk_` signing secret throws an `InvalidArgumentException` before the request is checked. Reply with a `2xx` status within 10 seconds and process the event afterwards. An event can arrive more than once: skip IDs you already handled.

Add endpoints in **Developers → API & Webhooks → Webhooks**, or with `createWebhookEndpoint()`, then read the endpoint's secret with `webhookSigningSecret()`, which needs an OAuth sign-in or a machine client. The guide is at https://docs.abusezero.com/docs/guides/receive-webhooks.

### Errors

Failed calls throw an `AbuseZero\AbuseZeroError` with `errorCode`, `status`, `requestId`, `retryable` and `docsUrl`. `getMessage()` says what to do next. `status` is `0` when no response arrived, and `docsUrl` is the error code reference's section for the error when AbuseZero sent one.

Input that doesn't match the API schema throws `AbuseZeroError` with `INVALID_REQUEST`, and the message names the field. A missing or invalid idempotency key throws `INVALID_IDEMPOTENCY_KEY`. A missing or invalid `key` or `accessToken`, or an access token without `workspace`, throws `AbuseZeroError` (`CREDENTIAL_REQUIRED`, `INVALID_KEY`, `INVALID_TOKEN` or `WORKSPACE_REQUIRED`). Other invalid options, path fields, a `request` without a method, full URL and headers, and invalid helper arguments throw an `InvalidArgumentException`. Nothing is sent in any of these cases. The [PHP SDK guide](https://docs.abusezero.com/docs/tools/php-sdk#php-sdk-errors) lists every code the SDK adds.

### Phone numbers and custom identifiers

```php
$secret = getenv('IDENTIFIER_HASH_SECRET');
$phone = AbuseZero\Helpers::createPhoneHash($secret, 'v1', '+14155550123');
$license = AbuseZero\Helpers::createCustomIdentifier($secret, 'v1', 'license_id', $licenseId);
// Send them with the evaluation:
// 'identifiers' => ['phone_hash' => $phone, 'phone_verified' => true, 'custom' => [$license]]
```

`createPhoneHash()` takes an E.164 phone number. `createCustomIdentifier()` takes the identifier's key and its value. [Register](https://docs.abusezero.com/docs/api-reference/custom-identifiers#register-a-custom-identifier) a custom identifier's key before you send it. Use the same secret and key version in every application that should recognize the same people.

### Public API

`AbuseZero\PublicClient` reads prices, the developer docs, the API's references and legal documents, and contacts sales or support. It needs no key or sign-in.

```php
$public = new AbuseZero\PublicClient();
$quote = $public->priceQuote(['plan' => 'pro', 'interval' => 'year']);
```

### Methods and pagination

Every API operation for servers has a method, listed in [`API.md`](API.md) with its HTTP operation. Pass fields in the input array and path fields, such as `id`, in the second argument. Methods marked Required in `API.md`, including `dryRunEvaluation()`, need an idempotency key. The [REST API reference](https://docs.abusezero.com/docs/api-reference) describes every field.

List methods take `cursor` and `limit`. Handle `data`, then pass `next_cursor` to the same method until it's `null`. Keep IDs and cursors as strings. `events()` always returns `next_cursor`: save it, and read again straight away while `has_more` is `true`.

## Browser

You don't need a second package for the browser. Load the standalone browser script from `https://abusezero.com` with your PUBLISHABLE KEY, and send its device token to your server:

```html
<script type="module">
  import { observe } from "https://abusezero.com/sdk/abusezero-browser-0.13.0.js?key=pk_…";

  const claimId = document.querySelector("#claim-id").value; // Your own ID for the claim.
  const { deviceToken } = await observe({ key: "pk_…", claimId });
  // Send deviceToken to your server, then pass it as identifiers.device_token in the evaluation.
</script>
```

- **When to call `observe()`:** when the person submits the claim.
- **Always send the device token.** It carries the browser data, or the reason there is none, such as `unavailable:consent_declined`. Evaluations still run without browser data.
- **Consent:** collection runs unless you pass `consent`. When your `consent` callback resolves to `false`, no browser data is sent for that claim. If your consent tool doesn't load the script at all, send `unavailable:not_loaded` as the device token.
- **Your sites:** AbuseZero accepts browser data only from HTTPS sites in your site list, in Developers → Browser SDK.
- **Content Security Policy:** copy the directives from **Developers → Browser SDK → Script → View install code**.

The guide is at https://docs.abusezero.com/docs/tools/browser-sdk#standalone-browser-script.

## Testing

Pass a `transport` callable to send requests through your own code, such as a test double or a proxy. It receives the method, URL, headers, body and the remaining seconds, and returns `['status' => …, 'headers' => […], 'body' => …]` with lowercase header names. Your transport must honor the remaining time, verify TLS and refuse redirects, as the built-in one does.

`baseUrl` changes the API origin. It must use HTTPS, except HTTP on a loopback address, such as `localhost`, for local testing.

## License

Proprietary. See `LICENSE`. Third-party components are listed in `THIRD-PARTY-NOTICES`.
