<?php
require __DIR__ . '/../vendor/autoload.php';

// Create the client once per process and reuse it.
function createClient(): AbuseZero\Client {
    return new AbuseZero\Client([
        'key' => getenv('ABUSEZERO_SECRET_KEY'), 'outage' => 'throw',
    ]);
}

// $grant must be idempotent for the claim and finish before this returns.
function evaluateAndGrant(AbuseZero\Client $client, string $claimId, string $email, string $clientIp,
                          string $deviceToken, array $request, callable $grant): array {
    $result = $client->evaluate([
        'benefit' => 'pro_trial', 'claim_id' => $claimId,
        'subject' => ['email' => $email],
        'context' => ['ip' => $clientIp],
        'identifiers' => ['device_token' => $deviceToken],
        'request' => $request,
    ], idempotencyKey: 'evaluate:' . $claimId);
    if (($result['status'] ?? null) === 'skipped') return $result;
    if ($result['source'] === 'local_outage' || $result['result'] !== 'allow') return $result;
    $grant($claimId);
    $client->outcome(['outcome' => 'granted'], ['id' => $result['id']], 'grant:' . $claimId);
    return $result;
}
