<?php
declare(strict_types=1);
namespace AbuseZero;
final class PublicClient extends Core {
    protected const PUBLIC_CLIENT = true;
    /** @param array<string, mixed> $input
     * @return array{object: string, currency: string, credits_per_evaluation: int, plans: list<array{object: string, plan: string, name: string, prices: array{month: array{amount_cents: int, credits: int}|null, year: array{amount_cents: int, credits: int}|null}, includes: array{protected_benefits: int, team_seats: int, data_retention_days: int, traffic: array{rate_per_second: int, burst: int, concurrency: int}}}>, credit_packs: array{credits_per_dollar: int, amounts: list<int>, custom_amount_step: int, custom_amount_max: int, first_purchase_multiplier: int}, yearly: array{rollover_percent: int, converted_credit_expiry_months: int}, every_plan: array{custom_policies: int, webhook_endpoints: int, webhook_resends_per_endpoint_per_hour: int, webhook_deliveries_per_day: int}, enterprise: array{contact: string}, url: string} */
    public function pricing(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('public.pricing', $input, $path, $idempotencyKey);
    }
    /** @param array{plan: string, interval?: string, amount?: int} $input
     * @return array{object: string, plan: string, interval: string|null, currency: string, amount_cents: int, credits: int, bonus_credits: int, total_credits: int} */
    public function priceQuote(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('public.pricing_quote', $input, $path, $idempotencyKey);
    }
    /** @param array{cursor?: string, limit?: int} $input
     * @return array{object: string, data: list<array{object: string, path: string, title: string, description: string|null, url: string, updated_at: string}>, next_cursor: string|null} */
    public function docs(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('public.docs', $input, $path, $idempotencyKey);
    }
    /** @param array{query: string, limit?: int} $input
     * @return array{object: string, data: list<array{object: string, path: string, title: string, url: string, snippet: string, updated_at: string}>, next_cursor: string|null} */
    public function searchDocs(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('public.docs_search', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, path: string, title: string, description: string|null, url: string, updated_at: string, markdown: string} */
    public function publicDocsPage(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('public.docs_page', $input, $path, $idempotencyKey);
    }
    /** @param array{cursor?: string, limit?: int} $input
     * @return array{object: string, data: list<array{object: string, path: string, title: string, description: string|null, url: string, updated_at: string}>, next_cursor: string|null} */
    public function helpArticles(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('public.help', $input, $path, $idempotencyKey);
    }
    /** @param array{query: string, limit?: int} $input
     * @return array{object: string, data: list<array{object: string, path: string, title: string, url: string, snippet: string, updated_at: string}>, next_cursor: string|null} */
    public function searchHelp(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('public.help_search', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, path: string, title: string, description: string|null, url: string, updated_at: string, markdown: string} */
    public function publicHelpArticle(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('public.help_article', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, version: string, document: array<string, mixed>} */
    public function openapi(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('public.openapi', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, data: list<array{object: string, id: string, summary: string, method: string, path: string, scope: string, sign_in: bool, mcp_tool: string|null, cli_command: string|null, mutation: bool, destructive: bool}>, next_cursor: string|null} */
    public function actions(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('public.actions', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, data: list<array{object: string, code: string, status: int, type: string, meaning: string, retryable: bool, next_step: string, docs_url: string}>, next_cursor: string|null} */
    public function errorCodes(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('public.errors', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, data: list<array{object: string, code: string, label: string, message: string, meaning: string|null, docs_url: string}>, next_cursor: string|null} */
    public function reasonCodes(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('public.reasons', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, data: list<array{object: string, type: string, description: string, example: array{object: string, id: string, type: string, api_version: string, created_at: string, workspace: string, data: array<string, mixed>}}>, next_cursor: string|null} */
    public function webhookEventTypes(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('public.webhook_events', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, data: list<array{object: string, key: string, label: string, group: string, type: string, values?: list<string>, min?: float, max?: float, integer?: bool}>, next_cursor: string|null} */
    public function conditions(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('public.conditions', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, terms: list<array{term: string, definition: string}>, faq: list<array{section: string|null, question: string, answer: string}>, url: string, faq_url: string, updated_at: string} */
    public function glossary(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('public.glossary', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, data: list<array{object: string, document: string, title: string, version: string, effective_date: string, url: string, updated_at: string}>, next_cursor: string|null} */
    public function legalDocuments(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('public.legal', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, document: string, title: string, version: string, effective_date: string, url: string, updated_at: string, markdown: string} */
    public function legalDocument(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('public.legal_document', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, url: string, entries: list<array{id: string, title: string, date: string, markdown: string}>, updated_at: string} */
    public function changelog(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('public.changelog', $input, $path, $idempotencyKey);
    }
    /** @param array{cursor?: string, limit?: int} $input
     * @return array{object: string, data: list<array{object: string, slug: string, title: string, description: string|null, url: string, published_on: string|null, revised_on: string|null, authors: list<string>, tags: list<string>, updated_at: string}>, next_cursor: string|null} */
    public function blogPosts(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('public.blog', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, slug: string, title: string, description: string|null, url: string, published_on: string|null, revised_on: string|null, authors: list<string>, tags: list<string>, updated_at: string, markdown: string} */
    public function blogPost(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('public.blog_post', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, api: string, npm: array{package: string, version: string}, browser_script: array{version: string, url: string}, skill: array{version: string, url: string}|null} */
    public function versions(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('public.versions', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, status: string, checked_at: string} */
    public function serviceStatus(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('public.status', $input, $path, $idempotencyKey);
    }
    /** @param array<string, mixed> $input
     * @return array{object: string, support: array{email: string, form: string|null, api: string}, sales: array{form: string, api: string}, security: array{email: string}} */
    public function contacts(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('public.contacts', $input, $path, $idempotencyKey);
    }
    /** @param array{name: string, email: string, message: string} $input
     * @return array{object: string, received: bool} */
    public function contactSales(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('public.contact_sales', $input, $path, $idempotencyKey);
    }
    /** @param array{email: string, subject: string, message: string, topic: string, name?: string, workspace_id?: string, request_id?: string} $input
     * @return array{object: string, reference: string, email: string} */
    public function contactSupport(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('public.contact_support', $input, $path, $idempotencyKey);
    }
    /** @param array{workspace_name: string, plan: string, interval?: string, credit_pack_dollars?: int} $input
     * @return array{object: string, id: string, approval_url: string, secret: string, expires_at: string, workspace_name: string, plan: string, interval: string|null, credit_pack_dollars: int|null, amount_cents: int} */
    public function startOnboarding(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('public.onboarding_start', $input, $path, $idempotencyKey);
    }
    /** @param array{secret: string, wait?: int} $input
     * @return array{object: string, id: string, status: string, expires_at: string, workspace: string|null, sign_in: array{token_endpoint: string, grant_type: string, client_id: string}|null} */
    public function onboardingStatus(#[\SensitiveParameter] array $input = [], #[\SensitiveParameter] array $path = [], #[\SensitiveParameter] ?string $idempotencyKey = null): array {
        return $this->callOperation('public.onboarding_status', $input, $path, $idempotencyKey);
    }
}
