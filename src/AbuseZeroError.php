<?php
declare(strict_types=1);
namespace AbuseZero;
final class AbuseZeroError extends \RuntimeException {
    public function __construct(public readonly string $errorCode, string $message, public readonly int $status = 0, public readonly ?string $requestId = null, public readonly bool $retryable = false, public readonly ?string $docsUrl = null) { parent::__construct($message); }
}
