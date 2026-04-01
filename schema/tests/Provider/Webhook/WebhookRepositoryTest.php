<?php

namespace Tests\Provider\Webhook;

use Ivoz\Provider\Domain\Model\Webhook\Webhook;
use Ivoz\Provider\Domain\Model\Webhook\WebhookRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;

class WebhookRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function test_runner()
    {
        $this->it_finds_brand_level_webhooks();
        $this->it_finds_company_level_webhooks();
        $this->it_finds_ddi_level_webhooks();
        $this->it_returns_empty_for_unknown_brand();
    }

    private function it_finds_brand_level_webhooks()
    {
        /** @var WebhookRepository $repository */
        $repository = $this->em->getRepository(Webhook::class);

        $result = $repository->findMatchingWebhooks(1, null, null);

        $this->assertCount(1, $result);
    }

    private function it_finds_company_level_webhooks()
    {
        /** @var WebhookRepository $repository */
        $repository = $this->em->getRepository(Webhook::class);

        $result = $repository->findMatchingWebhooks(1, 1, null);

        $this->assertCount(3, $result);
    }

    private function it_finds_ddi_level_webhooks()
    {
        /** @var WebhookRepository $repository */
        $repository = $this->em->getRepository(Webhook::class);

        $result = $repository->findMatchingWebhooks(1, 1, 1);

        $this->assertCount(4, $result);
    }

    private function it_returns_empty_for_unknown_brand()
    {
        /** @var WebhookRepository $repository */
        $repository = $this->em->getRepository(Webhook::class);

        $result = $repository->findMatchingWebhooks(999, null, null);

        $this->assertEmpty($result);
    }
}
