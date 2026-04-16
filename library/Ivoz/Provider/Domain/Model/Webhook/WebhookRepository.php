<?php

namespace Ivoz\Provider\Domain\Model\Webhook;

use Ivoz\Core\Domain\Service\Repository\RepositoryInterface;

/**
 * @extends RepositoryInterface<WebhookInterface, WebhookDto>
 */
interface WebhookRepository extends RepositoryInterface
{
    /**
     * @return WebhookInterface[]
     */
    public function findMatchingWebhooks(int $brandId, ?int $companyId, ?int $ddiId): array;
}
