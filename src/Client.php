<?php
declare(strict_types=1);
namespace AbuseZero;
final class Client extends Core {
    protected const PUBLIC_CLIENT = false;
    /** @param array<string, mixed> $input
     * @return array{object: string, data: list<array{object: string}>, next_cursor: string|null} */
    public function workspaces(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('workspaces.list', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, credential: string, person: array{name: string|null, email: string|null}|null, app: array{id: string, name: string|null}|null, api_key: array{id: string, name: string|null, type: string}|null, machine_client: array{id: string, name: string|null}|null, workspace: array{id: string, name: string|null}|null, role: string|null, permissions: list<string>, scopes: list<string>} */
    public function me(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('me.get', $input, $path, $idempotencyKey);
    }
    /** @param array{cursor?: string, limit?: int} $input
     * @return array{object: string, data: list<array{object: string, id: string, name: string, type: string, scopes: list<string>, prefix: string|null, last_four: string|null, value: string|null, status: string, replacement_available: bool, expires_at: string|null, last_used_at: string|null, created_at: string|null}>, next_cursor: string|null} */
    public function apiKeys(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('api-keys.list', $input, $path, $idempotencyKey);
    }
    /** @param array{name: string, type: string, scopes?: list<string>, expires_in_days?: int|null} $input
     * @return array{object: string, id: string, name: string, type: string, scopes: list<string>, prefix: string|null, last_four: string|null, value: string|null, status: string, replacement_available: bool, expires_at: string|null, last_used_at: string|null, created_at: string|null, secret: string} */
    public function createApiKey(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('api-keys.create', $input, $path, $idempotencyKey);
    }
    /** @param array{name?: string, scopes?: list<string>, expires_in_days?: int|null} $input
     * @return array{object: string, id: string, name: string, type: string, scopes: list<string>, prefix: string|null, last_four: string|null, value: string|null, status: string, replacement_available: bool, expires_at: string|null, last_used_at: string|null, created_at: string|null} */
    public function updateApiKey(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('api-keys.update', $input, $path, $idempotencyKey);
    }
    /** @param array{overlap_hours: float|float|float} $input
     * @return array{object: string, id: string, name: string, type: string, scopes: list<string>, prefix: string|null, last_four: string|null, value: string|null, status: string, replacement_available: bool, expires_at: string|null, last_used_at: string|null, created_at: string|null, secret: string, previous: array{id: string|null, expires_at: string|null}} */
    public function rollApiKey(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('api-keys.roll', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, id: string, name: string, type: string, scopes: list<string>, prefix: string|null, last_four: string|null, value: string|null, status: string, replacement_available: bool, expires_at: string|null, last_used_at: string|null, created_at: string|null, secret: string} */
    public function showApiKeyReplacement(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('api-keys.replacement', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, id: string, name: string, type: string, scopes: list<string>, prefix: string|null, last_four: string|null, value: string|null, status: string, replacement_available: bool, expires_at: string|null, last_used_at: string|null, created_at: string|null} */
    public function revokeApiKey(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('api-keys.revoke', $input, $path, $idempotencyKey);
    }
    /** @param array{cursor?: string, limit?: int, view?: string} $input
     * @return array{object: string, data: list<array{object: string, id: string|null, name: string, scopes: list<string>, member: array{name: string|null, email: string|null, role: string|null, you: bool, former: bool}|null, created_at: string|null, last_used_at: string|null}>, next_cursor: string|null} */
    public function machineClients(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('machine-clients.list', $input, $path, $idempotencyKey);
    }
    /** @param array{name: string, scopes: list<string>} $input
     * @return array{object: string, id: string|null, name: string, scopes: list<string>, member: array{name: string|null, email: string|null, role: string|null, you: bool, former: bool}|null, created_at: string|null, last_used_at: string|null, secret: string, token_endpoint: string, audience: string} */
    public function createMachineClient(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('machine-clients.create', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, id: string|null, secret: string} */
    public function rotateMachineClientSecret(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('machine-clients.rotate_secret', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, id: string|null, deleted: bool} */
    public function revokeMachineClient(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('machine-clients.revoke', $input, $path, $idempotencyKey);
    }
    /** @param array{cursor?: string, limit?: int, view?: string} $input
     * @return array{object: string, data: list<array{object: string, id: string|null, name: string, trust: string, destination: string|null, scopes: list<string>, member: array{name: string|null, email: string|null, role: string|null, you: bool, former: bool}|null, approved_at: string|null}>, next_cursor: string|null} */
    public function authorizedApps(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('authorized-apps.list', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, id: string|null, deleted: bool} */
    public function disconnectAuthorizedApp(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('authorized-apps.disconnect', $input, $path, $idempotencyKey);
    }
    /** @param array{cursor?: string, limit?: int} $input
     * @return array{object: string, data: list<array{object: string, id: string|null, name: string|null, email: string, role: string, permissions: list<string>, invited_at: string|null, joined_at: string|null, last_sign_in_at: string|null, you: bool}>, next_cursor: string|null} */
    public function members(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('members.list', $input, $path, $idempotencyKey);
    }
    /** @param array{role?: string, permissions?: list<string>} $input
     * @return array{object: string, id: string|null, name: string|null, email: string, role: string, permissions: list<string>, invited_at: string|null, joined_at: string|null, last_sign_in_at: string|null, you: bool} */
    public function updateMember(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('members.update', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, id: string|null, deleted: bool} */
    public function removeMember(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('members.remove', $input, $path, $idempotencyKey);
    }
    /** @param array{cursor?: string, limit?: int} $input
     * @return array{object: string, data: list<array{object: string, id: string|null, email: string, role: string, invited_by: string|null, status: string, created_at: string|null, expires_at: string|null}>, next_cursor: string|null} */
    public function invitations(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('invitations.list', $input, $path, $idempotencyKey);
    }
    /** @param array{email: string, role: string} $input
     * @return array{object: string, id: string|null, email: string, role: string, invited_by: string|null, status: string, created_at: string|null, expires_at: string|null} */
    public function inviteMember(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('invitations.create', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, id: string|null, email: string, role: string, invited_by: string|null, status: string, created_at: string|null, expires_at: string|null} */
    public function resendInvitation(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('invitations.resend', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, id: string|null, email: string, role: string, invited_by: string|null, status: string, created_at: string|null, expires_at: string|null} */
    public function cancelInvitation(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('invitations.cancel', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, id: string, name: string, icon: array{updated_at: string|null}|null, time_zone: string|null, website: string|null, product_type: array{type: string, other?: string}|null, data_retention: array{evidence_days: int, max_days: int, options: list<int>}} */
    public function workspaceSettings(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('workspace.get', $input, $path, $idempotencyKey);
    }
    /** @param array{name?: string, website?: string|null, product_type?: array{type: string, other?: string}|null, time_zone?: string} $input
     * @return array{object: string, id: string, name: string, icon: array{updated_at: string|null}|null, time_zone: string|null, website: string|null, product_type: array{type: string, other?: string}|null, data_retention: array{evidence_days: int, max_days: int, options: list<int>}} */
    public function updateWorkspaceSettings(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('workspace.update', $input, $path, $idempotencyKey);
    }
    /** @param array{image: string} $input
     * @return array{object: string, id: string, state: string} */
    public function uploadWorkspaceIcon(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('workspace.icon_upload', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, id: string, name: string, icon: array{updated_at: string|null}|null, time_zone: string|null, website: string|null, product_type: array{type: string, other?: string}|null, data_retention: array{evidence_days: int, max_days: int, options: list<int>}} */
    public function removeWorkspaceIcon(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('workspace.icon_remove', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, id: string, state: string} */
    public function workspaceIconUpload(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('workspace.icon_upload_get', $input, $path, $idempotencyKey);
    }
    /** @param array{evidence_days: int} $input
     * @return array{object: string, id: string, name: string, icon: array{updated_at: string|null}|null, time_zone: string|null, website: string|null, product_type: array{type: string, other?: string}|null, data_retention: array{evidence_days: int, max_days: int, options: list<int>}} */
    public function setDataRetention(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('workspace.retention', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, steps: list<array{step: string, done: bool}>, complete: bool, finished: bool, dismissed: bool|null} */
    public function setupProgress(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('workspace.setup', $input, $path, $idempotencyKey);
    }
    /** @param array{website?: string|null, product_type?: array{type: string, other?: string}|null, time_zone?: string|null} $input
     * @return array{object: string, steps: list<array{step: string, done: bool}>, complete: bool, finished: bool, dismissed: bool|null} */
    public function finishSetup(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('workspace.setup_finish', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, steps: list<array{step: string, done: bool}>, complete: bool, finished: bool, dismissed: bool|null} */
    public function dismissSetupGuide(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('workspace.setup_dismiss', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, workspace: string} */
    public function leaveWorkspace(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('workspace.leave', $input, $path, $idempotencyKey);
    }
    /** @param array{cursor?: string, limit?: int, result?: string, benefit?: string, query?: string, days?: int} $input
     * @return array{object: string, data: list<array{object: string}>, next_cursor: string|null} */
    public function evaluations(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('evaluations.list', $input, $path, $idempotencyKey);
    }
    /** @param array{benefit: string, claim_id: string, subject: array{external_id?: string, email: string, email_verified?: bool}, context?: array{ip?: string|null, user_agent?: string, session_id?: string}|null, identifiers?: array{device_id?: string, device_token?: string, browser_cookie_id?: string, payment?: array{provider: string, scope: string, fingerprint: string}, phone_hash?: array{algorithm: string, key_version: string, value: string}, phone_verified?: bool, custom?: list<array{key: string, value_hash: array{algorithm: string, key_version: string, value: string}}>}, request?: array{method: string, url: string, headers: array<string, mixed>}} $input
     * @return array{source: 'abusezero', object: string, id: string, result: 'allow'|'deny', risk: array{score: float|null, band: string}, reason: array{code: string, message: string, rule?: string}|null, outcome?: array{state: string, due_at: string|null}|null}|array{source: 'abusezero', object: string, status: 'skipped', reason: string}|array{source: 'local_outage', claim_id: string, result: 'allow'|'deny', error: \AbuseZero\AbuseZeroError} */
    public function evaluate(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('evaluations.create', $input, $path, $idempotencyKey);
    }
    /** @param array{days?: int} $input
     * @return array{object: string, days: int|null, benefits: list<string>, results: list<string>, reasons: list<array{code: string, label: string}>} */
    public function evaluationFilters(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('evaluations.filters', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, id: string, benefit: string|null, claim_id: string|null, result: string, reason: array{code: string, message: string, rule?: string}|null, outcome: array{state: string|null, due_at?: string|null}, policy_version: float|null, created_at: string|null, mode: string, observed_result?: string|null, risk: array{score: float|null, band: string}, inputs: array{email: string, ip: string, user_id: string, phone: string, payment: string, device: string, browser: string}, browser_data: string|null, policy: array{id: string|null, version: float|null}, access_list_entry: array{id: string|null, kind: string, type: string|null, value: string|null}|null} */
    public function getEvaluation(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('evaluations.get', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string} */
    public function evaluationGraph(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('evaluations.graph', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, id: string, benefit: string|null, claim_id: string|null, result: string, reason: array{code: string, message: string, rule?: string}|null, outcome: array{state: string|null, due_at?: string|null}, policy_version: float|null, created_at: string|null, mode: string, observed_result?: string|null, risk: array{score: float|null, band: string}, signals: list<array{family: string, assessment: string}>, inputs: array{email: string, ip: string, user_id: string, phone: string, payment: string, device: string, browser: string}, browser_data: string|null, policy: array{id: string|null, version: float|null}, access_list_entry: array{id: string|null, kind: string, type: string|null, value: string|null}|null, evidence: array{request: array<string, mixed>|null, device_profile: array{status: string, expires_at: string|null}}} */
    public function evaluationEvidence(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('evaluations.evidence', $input, $path, $idempotencyKey);
    }
    /** @param array{cursor?: string, limit?: int} $input
     * @return array{object: string, data: list<array{object: string}>, next_cursor: string|null} */
    public function outcomes(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('outcomes.list', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string} */
    public function getOutcome(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('outcomes.get', $input, $path, $idempotencyKey);
    }
    /** @param array{outcome: string, reason?: string, external_outcome_id?: string} $input
     * @return array{object: string} */
    public function outcome(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('outcomes.report', $input, $path, $idempotencyKey);
    }
    /** @param array{benefit: string, claim_id: string, subject: array{external_id?: string, email: string, email_verified?: bool}, context?: array{ip?: string|null, user_agent?: string, session_id?: string}|null, identifiers?: array{device_id?: string, device_token?: string, browser_cookie_id?: string, payment?: array{provider: string, scope: string, fingerprint: string}, phone_hash?: array{algorithm: string, key_version: string, value: string}, phone_verified?: bool, custom?: list<array{key: string, value_hash: array{algorithm: string, key_version: string, value: string}}>}, request?: array{method: string, url: string, headers: array<string, mixed>}} $input
     * @return array{object: string, dry_run: bool, result: string, risk: array{score: float|null, band: string}, reason: array{code: string, message: string, rule?: string}|null, inputs: array{email: string, ip: string, user_id: string, phone: string, payment: string, device: string, browser: string}}|array{object: string, status: string, reason: string} */
    public function dryRunEvaluation(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('evaluations.dry_run', $input, $path, $idempotencyKey);
    }
    /** @param array{benefit_id: string, policy_key: string} $input
     * @return array{object: string} */
    public function simulate(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('simulations.sequence', $input, $path, $idempotencyKey);
    }
    /** @param array{benefit_id: string, policy_key: string} $input
     * @return array{object: string} */
    public function replay(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('simulations.replay', $input, $path, $idempotencyKey);
    }
    /** @param array{cursor?: string, limit?: int} $input
     * @return array{object: string, data: list<array{object: string}>, next_cursor: string|null} */
    public function benefits(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('benefits.list', $input, $path, $idempotencyKey);
    }
    /** @param array{name: string, key: string, config: array{automation?: string, outcome_tracking?: string, missing_outcome_behavior?: string, eligibility?: array{kind: string}|array{kind: string, period: string, timezone: string}|array{kind: string, days: int}, value?: array{amount: float, currency: string}}, policy_key: string, protection_mode: string} $input
     * @return array{object: string} */
    public function createBenefit(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('benefits.create', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string} */
    public function getBenefit(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('benefits.get', $input, $path, $idempotencyKey);
    }
    /** @param array{name: string, config: array{automation?: string, outcome_tracking?: string, missing_outcome_behavior?: string, eligibility?: array{kind: string}|array{kind: string, period: string, timezone: string}|array{kind: string, days: int}, value?: array{amount: float, currency: string}}, policy_key: string, protection_mode: string, revision: int} $input
     * @return array{object: string} */
    public function updateBenefit(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('benefits.update', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, id: string|null, deleted: bool} */
    public function deleteBenefit(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('benefits.delete', $input, $path, $idempotencyKey);
    }
    /** @param array{cursor?: string, limit?: int} $input
     * @return array{object: string, data: list<array{object: string}>, next_cursor: string|null} */
    public function policies(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('policies.list', $input, $path, $idempotencyKey);
    }
    /** @param array{name: string, key: string, definition: array{base?: string, risk_threshold?: int|null, default_result: string, rules: list<array{id: string, name: string, result: string, when: mixed, enabled?: bool, note?: string}>}} $input
     * @return array{object: string} */
    public function createPolicy(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('policies.create', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string} */
    public function getPolicy(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('policies.get', $input, $path, $idempotencyKey);
    }
    /** @param array{name: string, definition: array{base?: string, risk_threshold?: int|null, default_result: string, rules: list<array{id: string, name: string, result: string, when: mixed, enabled?: bool, note?: string}>}, revision: int, restored_from?: int} $input
     * @return array{object: string} */
    public function updatePolicy(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('policies.update', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, id: string|null, deleted: bool} */
    public function deletePolicy(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('policies.delete', $input, $path, $idempotencyKey);
    }
    /** @param array{name: string, key: string} $input
     * @return array{object: string} */
    public function duplicatePolicy(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('policies.duplicate', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, data: list<array{object: string}>, next_cursor: string|null} */
    public function policyVersions(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('policies.versions', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string} */
    public function getPolicyVersion(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('policies.version', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, data: list<array{object: string}>, next_cursor: string|null} */
    public function policySignals(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('policies.signals', $input, $path, $idempotencyKey);
    }
    /** @param array{cursor?: string, limit?: int, value?: string} $input
     * @return array{object: string, data: list<array{object: string}>, next_cursor: string|null} */
    public function accessLists(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('access-lists.list', $input, $path, $idempotencyKey);
    }
    /** @param array{kind: string, type: string, value?: string, values?: list<string>, benefit_ids?: list<string>, reason: string, expires_at?: string|null, expires_in_days?: int|null} $input
     * @return array{object: string} */
    public function addAccessListEntries(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('access-lists.create', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string} */
    public function getAccessListEntry(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('access-lists.get', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, id: string|null, deleted: bool} */
    public function deleteAccessListEntry(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('access-lists.delete', $input, $path, $idempotencyKey);
    }
    /** @param array{kind?: string, benefit_ids?: list<string>, reason?: string, expires_at?: string|null, expires_in_days?: int|null} $input
     * @return array{object: string} */
    public function updateAccessListEntry(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('access-lists.update', $input, $path, $idempotencyKey);
    }
    /** @param array{value: string} $input
     * @return array{object: string, type: string|null, matches: list<array{object: string, kind: string, id: string, result: string|null, benefit: string|null}|array{object: string, kind: string, count: int, capped: bool, days: float}|array{object: string, kind: string, count: int, capped: bool}|array{object: string, kind: string, id: string, key: string, name: string}|array{object: string, kind: string, id: string, key: string, name: string}|array{object: string, kind: string, id: string, key: string, name: string}|array{object: string, kind: string, id: string, list: string, type: string}|array{object: string, kind: string, id: string, name: string}|array{object: string, kind: string, id: string, url: string}|array{object: string, kind: string, id: string, email: string}|array{object: string, kind: string, id: string, file_name: string|null}|array{object: string, kind: string, id: string, key: string}>} */
    public function lookUpIdentifier(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('identifiers.lookup', $input, $path, $idempotencyKey);
    }
    /** @param array{cursor?: string, limit?: int} $input
     * @return array{object: string, data: list<array{object: string}>, next_cursor: string|null} */
    public function customIdentifiers(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('custom-identifiers.list', $input, $path, $idempotencyKey);
    }
    /** @param array{key: string, key_version: string, description: string} $input
     * @return array{object: string} */
    public function registerCustomIdentifier(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('custom-identifiers.create', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string} */
    public function getCustomIdentifier(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('custom-identifiers.get', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, id: string|null, deleted: bool} */
    public function deleteCustomIdentifier(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('custom-identifiers.delete', $input, $path, $idempotencyKey);
    }
    /** @param array{cursor?: string, limit?: int} $input
     * @return array{object: string, data: list<array{object: string}>, next_cursor: string|null} */
    public function imports(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('imports.list', $input, $path, $idempotencyKey);
    }
    /** @param array{rows: list<array{benefit?: string, subject: array{email: string, external_id?: string}, granted_on?: string, granted_time?: string, occurred_at?: string, claim_id?: string, identifiers?: array{payment?: array{provider: string, scope: string, fingerprint: string}}}>, benefit?: string, time_zone?: string, file_name?: string, confirm?: bool} $input
     * @return array{object: string} */
    public function importClaimHistory(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('imports.create', $input, $path, $idempotencyKey);
    }
    /** @param array{benefit?: string, time_zone?: string, file_name?: string, rows?: int, payment?: array{provider: string, scope: string}, confirm?: bool} $input
     * @return array{object: string} */
    public function createCsvImport(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('imports.csv', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string} */
    public function getImport(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('imports.get', $input, $path, $idempotencyKey);
    }
    /** @param array{cursor?: string, limit?: int} $input
     * @return array{object: string, data: list<array{object: string}>, next_cursor: string|null} */
    public function listImportProblems(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('imports.problems', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, url: string} */
    public function importProblemsDownload(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('imports.problems_download', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string} */
    public function confirmImport(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('imports.confirm', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string} */
    public function discardImport(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('imports.discard', $input, $path, $idempotencyKey);
    }
    /** @param array{row: int, cells: array{email?: string, benefit?: string, granted_on?: string, granted_time?: string, occurred_at?: string, user_id?: string, claim_id?: string, payment_fingerprint?: string}} $input
     * @return array{object: string, import: string, row: int, state: string, kind: string|null, field: string|null} */
    public function fixImportRow(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('imports.fix_row', $input, $path, $idempotencyKey);
    }
    /** @param array{row: int} $input
     * @return array{object: string} */
    public function skipImportRow(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('imports.skip_row', $input, $path, $idempotencyKey);
    }
    /** @param array{cursor?: string, limit?: int} $input
     * @return array{object: string, data: list<array{object: string}>, next_cursor: string|null} */
    public function exports(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('exports.list', $input, $path, $idempotencyKey);
    }
    /** @param array{days?: int, include_evidence?: bool} $input
     * @return array{object: string, id: string, status: string, status_url: string} */
    public function requestExport(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('exports.create', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string} */
    public function getExport(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('exports.get', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string} */
    public function exportDownload(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('exports.download', $input, $path, $idempotencyKey);
    }
    /** @param array{password: string, encryption?: string} $input
     * @return array{object: string, export: array{id: string, state: string, requested_by_you: bool, requested_at: string|null, completed_at: string|null, expires_at: string|null, parts: int|null, bytes: int|null, can_delete: bool}|null, next_allowed_at: string|null} */
    public function requestWorkspaceExport(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('workspace-exports.create', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, export: array{id: string, state: string, requested_by_you: bool, requested_at: string|null, completed_at: string|null, expires_at: string|null, parts: int|null, bytes: int|null, can_delete: bool}|null, next_allowed_at: string|null} */
    public function workspaceExport(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('workspace-exports.status', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, id: string, expires_at: string|null, links_expire_at: string|null, parts: list<array{part: int, bytes: int, file_name: string, url: string}>} */
    public function workspaceExportDownload(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('workspace-exports.download', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, export: array{id: string, state: string, requested_by_you: bool, requested_at: string|null, completed_at: string|null, expires_at: string|null, parts: int|null, bytes: int|null, can_delete: bool}|null, next_allowed_at: string|null} */
    public function deleteWorkspaceExport(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('workspace-exports.delete', $input, $path, $idempotencyKey);
    }
    /** @param array{selector: array{kind: string, user: string, email: bool}|array{kind: string}} $input
     * @return array{object: string} */
    public function dryRunDataDeletion(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('deletions.dry_run', $input, $path, $idempotencyKey);
    }
    /** @param array{cursor?: string, limit?: int} $input
     * @return array{object: string, data: list<array{object: string}>, next_cursor: string|null} */
    public function dataDeletions(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('deletions.list', $input, $path, $idempotencyKey);
    }
    /** @param array{selector: array{kind: string, user: string, email: bool}|array{kind: string}} $input
     * @return array{object: string, id: string, status: string, status_url: string} */
    public function requestDataDeletion(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('deletions.create', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string} */
    public function getDataDeletion(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('deletions.get', $input, $path, $idempotencyKey);
    }
    /** @param array{days?: int} $input
     * @return array{object: string, data: list<array{object: string}>, next_cursor: string|null} */
    public function analytics(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('analytics.list', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, hours: float, evaluations: array{total: int, allowed: int, denied: int, waiting_for_confirmation: int}, previous: array{total: int, allowed: int, denied: int, waiting_for_confirmation: int}, api_requests: array{total: int, errors: int}, last_evaluation_at: string|null, browser_issue: string|null, latest_evaluations: list<array{object: string, id: string, benefit: string, claim_id: string, result: string, mode: string, observed_result: string|null, reason: array{code: string, message: string}|null, outcome: array{state: string|null}, policy_version: float|null, browser_data: string|null, created_at: string|null}>} */
    public function overview(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('overview.get', $input, $path, $idempotencyKey);
    }
    /** @param array{days?: int, currency?: string, benefit?: string} $input
     * @return array{object: string, currency: string, from: string, to: string, delivered: float, saved: float, benefits: list<array{benefit: string|null, value: array{amount: float, currency: string}|null, delivered: float, saved: float}>} */
    public function benefitValue(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('analytics.value', $input, $path, $idempotencyKey);
    }
    /** @param array{days?: int, benefit?: string} $input
     * @return array{object: string, benefit: string|null, from: string, to: string, denied: int, reasons: list<array{code: string, label: string, count: int}>} */
    public function denialReasons(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('analytics.denial_reasons', $input, $path, $idempotencyKey);
    }
    /** @param array{cursor?: string, limit?: int, status?: string, key_id?: string} $input
     * @return array{object: string, data: list<array{object: string}>, next_cursor: string|null} */
    public function requestLogs(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('request-logs.list', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string} */
    public function getRequestLog(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('request-logs.get', $input, $path, $idempotencyKey);
    }
    /** @param array{cursor?: string, limit?: int} $input
     * @return array{object: string, data: list<array{object: string}>, next_cursor: string|null} */
    public function auditLogs(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('audit-logs.list', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string} */
    public function getAuditLog(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('audit-logs.get', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, workspace: string, plan: array{plan: string, name: string, interval: string|null, enterprise: bool, renews_at: string|null, ends_at: string|null}, credits: array{available: int, allowance: int, pay_as_you_go: int, per_evaluation: int, evaluations_left: int, state: string}, limits: array{protected_benefits: array{used: int, limit: int}, custom_policies: array{used: int, limit: int}, team_seats: array{used: int, limit: int}, retention_days: int, rate: int}, auto_reload: array{enabled: bool}} */
    public function accountStatus(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('account_status.get', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, status: string, api_keys: array{state: string, next_step: string|null}, browser_script: array{state: string, next_step: string|null}, evaluations: array{state: string, next_step: string|null}, outcomes: array{state: string, next_step: string|null}, webhooks: array{state: string, next_step: string|null}, credits: array{state: string, next_step: string|null}, checked_at: string|null} */
    public function integrationStatus(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('integration_status.get', $input, $path, $idempotencyKey);
    }
    /** @param array{cursor?: string, limit?: int, wait?: int} $input
     * @return array{object: string, data: list<array{object: string, id: string, type: string, api_version: string, created_at: string|null, workspace: string, test: bool, data: array{object: string, state: string, available: int, evaluations_left: int, days_left: int|null}|array{object: string, state: string, available: int, evaluations_left: int, days_left: null}|array{object: string, status: string, purpose: string}|array{object: string, status: string, purpose: string, confirmation_required: bool}|array{plan: string, name: string, interval: string|null, object: string, previous: array{plan: string, name: string, interval: string|null}|null}|array{object: string, id: string, status: string}|array{object: string, id: string, name: string, type: string, expires_at: string|null, created_at: string|null}|array{object: string, id: string, name: string, type: string, expires_at: string|null, created_at: string|null}|array{object: string, id: string, name: string|null, role: string, joined_at: string|null}|array{object: string, status: string, owner: array{id: string, name: string|null}|null, new_owner: array{id: string, name: string|null}|null}|array{object: string, day: string, limit: int}|array<string, mixed>}>, next_cursor: string, has_more: bool} */
    public function events(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('events.list', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, origins: list<string>, revision: int, sites: list<array{origin: string, listed: bool, first_seen_at: string|null, last_seen_at: string|null, sdk_version: string|null}>, issue: string|null, issue_since: string|null, coverage: array{days: float, total: int, collected: int, consent_declined: int, not_loaded: int, blocked: int, timed_out: int, failed: int, site_not_listed: int, sdk_outdated: int, expired: int, not_passed_on: int, not_sent: int}, notices: list<string>} */
    public function browserCollection(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('browser_collection.get', $input, $path, $idempotencyKey);
    }
    /** @param array{origins: list<string>, revision?: int} $input
     * @return array{object: string, origins: list<string>, revision: int, sites: list<array{origin: string, listed: bool, first_seen_at: string|null, last_seen_at: string|null, sdk_version: string|null}>, issue: string|null, issue_since: string|null, coverage: array{days: float, total: int, collected: int, consent_declined: int, not_loaded: int, blocked: int, timed_out: int, failed: int, site_not_listed: int, sdk_outdated: int, expired: int, not_passed_on: int, not_sent: int}, notices: list<string>} */
    public function updateBrowserCollection(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('browser_collection.update', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, script: string|null, sdk_version: string, publishable_key: string|null} */
    public function browserScript(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('browser_collection.script', $input, $path, $idempotencyKey);
    }
    /** @param array{cursor?: string, limit?: int} $input
     * @return array{object: string, data: list<array{object: string}>, next_cursor: string|null} */
    public function webhookEndpoints(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('webhook-endpoints.list', $input, $path, $idempotencyKey);
    }
    /** @param array{url: string, events: list<string>, benefit_ids?: list<string>, denied_only?: bool} $input
     * @return array{object: string, id: string|null, url: string, description: null, events: list<string>, benefits: list<string|null>, denied_only: bool, status: string, disabled_reason: string|null, last_success_at: string|null, revision: int, created_at: string|null, updated_at: string|null} */
    public function createWebhookEndpoint(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('webhook-endpoints.create', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string} */
    public function getWebhookEndpoint(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('webhook-endpoints.get', $input, $path, $idempotencyKey);
    }
    /** @param array{revision: int, url?: string, events?: list<string>, benefit_ids?: list<string>, denied_only?: bool} $input
     * @return array{object: string, id: string|null, url: string, description: null, events: list<string>, benefits: list<string|null>, denied_only: bool, status: string, disabled_reason: string|null, last_success_at: string|null, revision: int, created_at: string|null, updated_at: string|null} */
    public function updateWebhookEndpoint(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('webhook-endpoints.update', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, id: string|null, deleted: bool} */
    public function deleteWebhookEndpoint(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('webhook-endpoints.delete', $input, $path, $idempotencyKey);
    }
    /** @param array{type?: string} $input
     * @return array{object: string} */
    public function sendWebhookTest(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('webhook-endpoints.test', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, id: string|null, url: string, description: null, events: list<string>, benefits: list<string|null>, denied_only: bool, status: string, disabled_reason: string|null, last_success_at: string|null, revision: int, created_at: string|null, updated_at: string|null} */
    public function enableWebhookEndpoint(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('webhook-endpoints.enable', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, id: string|null, url: string, description: null, events: list<string>, benefits: list<string|null>, denied_only: bool, status: string, disabled_reason: string|null, last_success_at: string|null, revision: int, created_at: string|null, updated_at: string|null} */
    public function disableWebhookEndpoint(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('webhook-endpoints.disable', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, endpoint: string|null, secret: string} */
    public function webhookSigningSecret(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('webhook-endpoints.secret', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, id: string|null, url: string, description: null, events: list<string>, benefits: list<string|null>, denied_only: bool, status: string, disabled_reason: string|null, last_success_at: string|null, revision: int, created_at: string|null, updated_at: string|null} */
    public function rotateWebhookSigningSecret(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('webhook-endpoints.rotate_secret', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, day: string, deliveries: int, limit: int, limit_reached: bool, resets_at: string|null} */
    public function webhookUsage(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('webhook-deliveries.usage', $input, $path, $idempotencyKey);
    }
    /** @param array{cursor?: string, limit?: int, endpoint_id?: string, status?: string, type?: string, event_id?: string} $input
     * @return array{object: string, data: list<array{object: string}>, next_cursor: string|null} */
    public function webhookDeliveries(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('webhook-deliveries.list', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string} */
    public function getWebhookDelivery(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('webhook-deliveries.get', $input, $path, $idempotencyKey);
    }
    /** @param array{target?: string} $input
     * @return array{object: string} */
    public function resendWebhookDelivery(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('webhook-deliveries.resend', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, plan: string, name: string, interval: string|null, subscribed: bool, renews_at: string|null, ends_at: string|null, scheduled_change: array{plan: string, name: string, interval: string|null, at: string|null}|null, enterprise: bool, payment: array{state: string, due_at: string|null}, limits: array{protected_benefits: int, custom_policies: int, team_seats: int, retention_days: int, rate: int}, over_limit: array{state: string, grace_until: string|null, items: list<array{kind: string, id: string|null, name: string, paused: bool, will_pause: bool}>}|null} */
    public function plan(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('billing.plan', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, credits: array{available: int, allowance: int, pay_as_you_go: int, per_evaluation: int}, usage: array{absolute: array{allowance_credits: array{used: int, total: int}, pay_as_you_go_credits: array{used: int, total: int}, protected_benefits: array{used: int, total: int}, team_seats: array{used: int, total: int}}, allowance: array{allowance_credits: array{used: int, total: int}, pay_as_you_go_credits: array{used: int, total: int}, protected_benefits: array{used: int, total: int}, team_seats: array{used: int, total: int}}|null}, auto_reload: array{enabled: bool, capped: bool, threshold: int|null, amount_dollars: int|null, monthly_cap_dollars: int|null}} */
    public function usage(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('billing.usage', $input, $path, $idempotencyKey);
    }
    /** @param array{cursor?: string, activity?: string, direction?: string, days?: float|float|float|float, from?: string, to?: string} $input
     * @return array{object: string, data: list<array{object: string, date: string, daily_total: bool, activity: string, sources: list<string>, credits: int, plans: list<string>, enterprise_plans: list<string>}>, next_cursor: string|null} */
    public function creditHistory(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('billing.credit_history', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, time_zone: string, days: list<array{day: string, credits: int, top_benefit: array{name: string, evaluations: int}|null}>} */
    public function dailyUsage(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('billing.daily_usage', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, data: list<array{object: string, name: string, active: bool, added_at: string|null, ends_at: string|null, grants: array{credits: int, credit_cadence: string|null, credit_expiry: string|null, credit_expiry_days: int|null, team_seats: int, protected_benefits: int, custom_policies: int|null, rate: int|null, burst: int|null, concurrency: int|null, retention_days: int|null}}>, next_cursor: string|null} */
    public function enterprisePlans(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('billing.enterprise_plans', $input, $path, $idempotencyKey);
    }
    /** @param array{code: string} $input
     * @return array{object: string, plan: array{name: string, description: string|null, credits: int, credit_cadence: string|null, credit_expiry: string|null, credit_expiry_days: int|null, team_seats: int, protected_benefits: int, custom_policies: int|null, rate: int|null, burst: int|null, concurrency: int|null, retention_days: int|null, duration_months: int|null}} */
    public function previewEnterprisePlanCode(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('billing.codes.preview', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, data: list<array{object: string, kind: string, amount_cents: int, at: string|null, payment_method: string|null, discounted: bool}>, next_cursor: string|null} */
    public function upcomingCharge(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('billing.upcoming', $input, $path, $idempotencyKey);
    }
    /** @param array{cursor?: string} $input
     * @return array{object: string, data: list<array{object: string, number: string|null, created_at: string|null, status: string, description: string, period: array{start: string|null, end: string|null}|null, total_cents: int, paid_cents: int, due_cents: int, refunded_cents: int, payable: bool, url: string|null}>, next_cursor: string|null, outstanding_cents: int|null} */
    public function invoices(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('billing.invoices', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, data: list<array{object: string, id: string|null, type: string, brand: string|null, last4: string|null, exp_month: int|null, exp_year: int|null, label: string, default: bool, backup: int|null, declined: bool, expired: bool}>, next_cursor: string|null} */
    public function paymentMethods(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('billing.payment_methods', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, name: string, email: string, uses_account_email: bool, address: array{line1: string, line2: string, city: string, state: string, postal_code: string, country: string}|null, tax_id: array{type: string, value: string}|null} */
    public function billingDetails(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('billing.details', $input, $path, $idempotencyKey);
    }
    /** @param array{name: string, email: string|string, address: array{line1: string, line2: string, city: string, state: string, postal_code: string, country: string|string}, tax_id: array{type: string, value: string}|null} $input
     * @return array{object: string, name: string, email: string, uses_account_email: bool, address: array{line1: string, line2: string, city: string, state: string, postal_code: string, country: string}|null, tax_id: array{type: string, value: string}|null} */
    public function updateBillingDetails(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('billing.details.update', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, id: string|null, kind: string, status: string, payment_page_url: string|null, credits: int|null, bonus_credits: int|null, scheduled: bool} */
    public function getPayment(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('billing.payments.get', $input, $path, $idempotencyKey);
    }
    /** @param array{plan: string, interval?: string|null, promo_code?: string} $input
     * @return array{object: string, id: string|null, plan: string, interval: string|null, direction: string, timing: string, confirmable: bool, charge_now_cents: int, renewal_cents: int, credits_now: int, effective_at: string|null, expires_at: string|null, next_charge: array{amount_cents: int, at: string|null, discounted: bool}|null, promotion: array{code: string, amount_cents: int, full_cents: int, duration: string}|null} */
    public function quotePlanChange(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('billing.quotes.create', $input, $path, $idempotencyKey);
    }
    /** @param array{credits: int|null} $input
     * @return array{object: string, credits: int|null} */
    public function setLowCreditAlert(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('billing.low_credit_alert.update', $input, $path, $idempotencyKey);
    }
    /** @param array{kind: string, keep_active: string, pause: string} $input
     * @return array{object: string, status: string} */
    public function chooseWhatStaysActive(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('billing.over_limit.choose', $input, $path, $idempotencyKey);
    }
    /** @param array{enabled: bool, threshold: int|null, amount_dollars: int|null, monthly_cap_dollars?: int|null} $input
     * @return array{object: string, enabled: bool, capped: bool, threshold: int|null, amount_dollars: int|null, monthly_cap_dollars: int|null, spent_this_month_dollars: int} */
    public function setAutoReload(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('billing.auto_reload.update', $input, $path, $idempotencyKey);
    }
    /** @param array{amount_dollars: int} $input
     * @return array{object: string, id: string|null, kind: string, status: string, payment_page_url: string|null, credits: int|null, bonus_credits: int|null, scheduled: bool} */
    public function buyCredits(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('billing.credits.buy', $input, $path, $idempotencyKey);
    }
    /** @param array{payment_method_id?: string} $input
     * @return array{object: string, id: string|null, kind: string, status: string, payment_page_url: string|null, credits: int|null, bonus_credits: int|null, scheduled: bool} */
    public function retryCreditPurchase(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('billing.credits.retry', $input, $path, $idempotencyKey);
    }
    /** @param array{payment_method_id?: string} $input
     * @return array{object: string, id: string|null, kind: string, status: string, payment_page_url: string|null, credits: int|null, bonus_credits: int|null, scheduled: bool} */
    public function confirmPlanChange(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('billing.plan.change', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, status: string} */
    public function undoScheduledDowngrade(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('billing.downgrade.undo', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, status: string} */
    public function resumeSubscription(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('billing.subscription.resume', $input, $path, $idempotencyKey);
    }
    /** @param array{invoice_number?: string, payment_method_id?: string} $input
     * @return array{object: string, id: string|null, kind: string, status: string, payment_page_url: string|null, credits: int|null, bonus_credits: int|null, scheduled: bool} */
    public function payOverdueInvoice(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('billing.overdue.pay', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, status: string, overdue_invoices: list<array{number: string|null, amount_cents: int, status: string}>} */
    public function setDefaultPaymentMethod(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('billing.payment_methods.default', $input, $path, $idempotencyKey);
    }
    /** @param array{direction: string} $input
     * @return array{object: string, status: string, overdue_invoices: list<array{number: string|null, amount_cents: int, status: string}>} */
    public function moveBackupPaymentMethod(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('billing.payment_methods.move', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, status: string, overdue_invoices: list<array{number: string|null, amount_cents: int, status: string}>} */
    public function removePaymentMethod(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('billing.payment_methods.remove', $input, $path, $idempotencyKey);
    }
    /** @param array{code: string} $input
     * @return array{object: string, status: string, plan: string|null} */
    public function redeemEnterprisePlanCode(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('billing.codes.redeem', $input, $path, $idempotencyKey);
    }
    /** @param array{kind: string, plan?: string, interval?: string} $input
     * @return array{object: string, id: string, kind: string, plan: string|null, interval: string|null, status: string, approval_url: string|null, expires_at: string|null, completed_at: string|null} */
    public function createBillingApprovalLink(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('billing.approval_links.create', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, id: string, kind: string, plan: string|null, interval: string|null, status: string, approval_url: string|null, expires_at: string|null, completed_at: string|null} */
    public function billingApprovalLink(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('billing.approval_links.get', $input, $path, $idempotencyKey);
    }
    /** @param array{name: string} $input
     * @return array{object: string, name: string} */
    public function updateAccountName(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('account.update', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, members_and_invitations: bool, imports_and_exports: bool, integration_alerts: bool, weekly_summary: bool} */
    public function emailPreferences(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('account.email_preferences', $input, $path, $idempotencyKey);
    }
    /** @param array{members_and_invitations?: bool, imports_and_exports?: bool, integration_alerts?: bool, weekly_summary?: bool} $input
     * @return array{object: string, members_and_invitations: bool, imports_and_exports: bool, integration_alerts: bool, weekly_summary: bool} */
    public function updateEmailPreferences(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('account.email_preferences_update', $input, $path, $idempotencyKey);
    }
    /** @param array{filter?: string, cursor?: string} $input
     * @return array{object: string, data: list<array{object: string, id: string, workspace: string|null, kind: string, title: string, snippet: string, unread: bool, count: int, updated_at: string|null, actions: list<array{id: string, label: string}>, resolved: string|null}>, next_cursor: string|null, unread_count: int} */
    public function notifications(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('notifications.list', $input, $path, $idempotencyKey);
    }
    /** @param array{read: bool} $input
     * @return array{object: string, id: string, workspace: string|null, kind: string, title: string, snippet: string, unread: bool, count: int, updated_at: string|null, actions: list<array{id: string, label: string}>, resolved: string|null, unread_count: int} */
    public function markNotification(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('notifications.update', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, unread_count: int} */
    public function markAllNotificationsRead(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('notifications.read_all', $input, $path, $idempotencyKey);
    }
    /** @param array{action: string} $input
     * @return array{object: string, id: string, workspace: string|null, kind: string, title: string, snippet: string, unread: bool, count: int, updated_at: string|null, actions: list<array{id: string, label: string}>, resolved: string|null, unread_count: int} */
    public function runNotificationAction(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('notifications.run_action', $input, $path, $idempotencyKey);
    }
    /** @param array{subject: string, message: string, topic: string, request_id?: string} $input
     * @return array{object: string, id: string, status: string, created_at: string|null, updated_at: string|null} */
    public function contactSupport(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('support-tickets.create', $input, $path, $idempotencyKey);
    }
    /** @param array{cursor?: string, limit?: int} $input
     * @return array{object: string, data: list<array{object: string, id: string, status: string, created_at: string|null, updated_at: string|null}>, next_cursor: string|null} */
    public function supportTickets(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('support-tickets.list', $input, $path, $idempotencyKey);
    }
    /** @param array{message: string, page?: string} $input
     * @return array{object: string, sent: bool} */
    public function sendFeedback(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('feedback.create', $input, $path, $idempotencyKey);
    }
}
