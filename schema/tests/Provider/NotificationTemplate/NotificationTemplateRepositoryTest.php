<?php

namespace Tests\Provider\NotificationTemplate;

use Ivoz\Provider\Domain\Model\BalanceNotification\BalanceNotification;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplate;

class NotificationTemplateRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function test_runner()
    {
        $this->its_instantiable();
        $this->its_finds_generic_call_csv_template();
        $this->its_finds_generic_invoice_template();
        $this->its_finds_template_by_balance_notification();
    }

    public function its_instantiable()
    {
        /** @var NotificationTemplateRepository $repository */
        $repository = $this
            ->em
            ->getRepository(NotificationTemplate::class);

        $this->assertInstanceOf(
            NotificationTemplateRepository::class,
            $repository
        );
    }

    public function its_finds_generic_call_csv_template()
    {
        /** @var NotificationTemplateRepository $repository */
        $repository = $this
            ->em
            ->getRepository(NotificationTemplate::class);

        $genericCallCsvTemplate = $repository
            ->findGenericCallCsvTemplate();

        $this->assertInstanceOf(
            NotificationTemplate::class,
            $genericCallCsvTemplate
        );
    }

    public function its_finds_generic_invoice_template()
    {
        /** @var NotificationTemplateRepository $repository */
        $repository = $this
            ->em
            ->getRepository(NotificationTemplate::class);

        $genericCallCsvTemplate = $repository
            ->findGenericInvoiceTemplate();

        $this->assertNull(
            $genericCallCsvTemplate
        );
    }

    public function its_finds_template_by_balance_notification()
    {
        /** @var NotificationTemplateRepository $notificationTemplateRepository */
        $notificationTemplateRepository = $this
            ->em
            ->getRepository(NotificationTemplate::class);

        $balanceNotificationRepository = $this
            ->em
            ->getRepository(BalanceNotification::class);

        $notificationTemplates = $notificationTemplateRepository
            ->findTemplateByBalanceNotification(
                $balanceNotificationRepository->find(1)
            );

        $this->assertInstanceOf(
            NotificationTemplateInterface::class,
            $notificationTemplates
        );
    }
}
