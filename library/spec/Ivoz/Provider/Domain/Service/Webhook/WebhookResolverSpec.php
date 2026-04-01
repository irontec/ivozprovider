<?php

namespace spec\Ivoz\Provider\Domain\Service\Webhook;

use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\Webhook\WebhookInterface;
use Ivoz\Provider\Domain\Model\Webhook\WebhookRepository;
use Ivoz\Provider\Domain\Service\Webhook\WebhookResolver;
use PhpSpec\ObjectBehavior;
use spec\HelperTrait;

class WebhookResolverSpec extends ObjectBehavior
{
    use HelperTrait;

    /**
     * @var WebhookRepository
     */
    protected $webhookRepository;

    /**
     * @var WebhookInterface
     */
    protected $brandWebhook;

    /**
     * @var WebhookInterface
     */
    protected $companyWebhook;

    /**
     * @var WebhookInterface
     */
    protected $ddiWebhook;

    public function let(WebhookRepository $webhookRepository)
    {
        $this->webhookRepository = $webhookRepository;
        $this->beConstructedWith($webhookRepository);

        $this->prepareWebhooks();
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(WebhookResolver::class);
    }

    public function it_returns_null_when_no_webhooks_match()
    {
        $this
            ->webhookRepository
            ->findMatchingWebhooks(1, 10, 100)
            ->willReturn([]);

        $this->execute(
            1,
            10,
            100,
            'start'
        )->shouldReturn(null);
    }

    public function it_returns_null_when_no_webhook_matches_event()
    {
        $this->brandWebhook
            ->getEventStart()
            ->willReturn(false);

        $this->brandWebhook
            ->getEventAnswer()
            ->willReturn(true);

        $this
            ->webhookRepository
            ->findMatchingWebhooks(1, null, null)
            ->willReturn([$this->brandWebhook]);

        $this->execute(
            1,
            null,
            null,
            'start'
        )->shouldReturn(null);
    }

    public function it_returns_brand_webhook_as_fallback()
    {
        $this->brandWebhook
            ->getEventStart()
            ->willReturn(true);

        $this->brandWebhook
            ->getDdi()
            ->willReturn(null);

        $this->brandWebhook
            ->getCompany()
            ->willReturn(null);

        $this
            ->webhookRepository
            ->findMatchingWebhooks(1, null, null)
            ->willReturn([$this->brandWebhook]);

        $this->execute(
            1,
            null,
            null,
            'start'
        )->shouldReturn($this->brandWebhook);
    }

    public function it_prefers_company_webhook_over_brand()
    {
        $company = $this->getTestDouble(CompanyInterface::class);
        $company->getId()->willReturn(10);

        $this->brandWebhook
            ->getEventStart()
            ->willReturn(true);

        $this->brandWebhook
            ->getDdi()
            ->willReturn(null);

        $this->brandWebhook
            ->getCompany()
            ->willReturn(null);

        $this->companyWebhook
            ->getEventStart()
            ->willReturn(true);

        $this->companyWebhook
            ->getDdi()
            ->willReturn(null);

        $this->companyWebhook
            ->getCompany()
            ->willReturn($company);

        $this
            ->webhookRepository
            ->findMatchingWebhooks(1, 10, null)
            ->willReturn([$this->brandWebhook, $this->companyWebhook]);

        $this->execute(
            1,
            10,
            null,
            'start'
        )->shouldReturn($this->companyWebhook);
    }

    public function it_prefers_ddi_webhook_over_company_and_brand()
    {
        $company = $this->getTestDouble(CompanyInterface::class);
        $ddi = $this->getTestDouble(DdiInterface::class);

        $company
            ->getId()
            ->willReturn(10);

        $ddi
            ->getId()
            ->willReturn(100);

        $this->brandWebhook
            ->getEventStart()
            ->willReturn(true);

        $this->brandWebhook
            ->getDdi()
            ->willReturn(null);

        $this->brandWebhook
            ->getCompany()
            ->willReturn(null);

        $this->companyWebhook
            ->getEventStart()
            ->willReturn(true);

        $this->companyWebhook
            ->getDdi()
            ->willReturn(null);

        $this->companyWebhook
            ->getCompany()
            ->willReturn($company);

        $this->ddiWebhook
            ->getEventStart()
            ->willReturn(true);
        $this->ddiWebhook
            ->getDdi()
            ->willReturn($ddi);

        $this
            ->webhookRepository
            ->findMatchingWebhooks(1, 10, 100)
            ->willReturn([
                $this->brandWebhook,
                $this->companyWebhook,
                $this->ddiWebhook,
            ]);

        $this->execute(
            1,
            10,
            100,
            'start'
        )->shouldReturn($this->ddiWebhook);
    }

    public function it_falls_back_to_brand_when_ddi_webhook_does_not_match_event()
    {
        $company = $this->getTestDouble(CompanyInterface::class);
        $ddi = $this->getTestDouble(DdiInterface::class);
        $company->getId()->willReturn(10);
        $ddi->getId()->willReturn(100);

        $this->brandWebhook->getEventEnd()->willReturn(true);
        $this->brandWebhook->getDdi()->willReturn(null);
        $this->brandWebhook->getCompany()->willReturn(null);

        $this->ddiWebhook->getEventEnd()->willReturn(false);

        $this
            ->webhookRepository
            ->findMatchingWebhooks(1, 10, 100)
            ->willReturn([$this->brandWebhook, $this->ddiWebhook]);

        $this->execute(
            1,
            10,
            100,
            'end'
        )->shouldReturn($this->brandWebhook);
    }

    protected function prepareWebhooks()
    {
        $this->brandWebhook = $this->getTestDouble(WebhookInterface::class);
        $this->companyWebhook = $this->getTestDouble(WebhookInterface::class);
        $this->ddiWebhook = $this->getTestDouble(WebhookInterface::class);
    }
}
