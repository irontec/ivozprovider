<?php

namespace Tests\Provider\NotificationTemplate;

use Ivoz\Provider\Domain\Model\BalanceNotification\BalanceNotification;
use Ivoz\Provider\Domain\Model\CallCsvReport\CallCsvReport;
use Ivoz\Provider\Domain\Model\CallCsvReport\CallCsvReportRepository;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Company\CompanyRepository;
use Ivoz\Provider\Domain\Model\Language\Language;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplate;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;

class NotificationTemplateRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function test_runner()
    {
        $this->its_instantiable();
        $this->its_finds_call_csv_template();
        $this->its_finds_invoice_template();
        $this->its_finds_template_by_balance_notification();
        $this->its_finds_generic_on_demand_record_template();
        $this->its_finds_brand_on_demand_record_template();
        $this->its_finds_company_on_demand_record_template();
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

    public function its_finds_call_csv_template()
    {
        /** @var NotificationTemplateRepository $repository */
        $repository = $this
            ->em
            ->getRepository(NotificationTemplate::class);

        /** @var CallCsvReportRepository $callCsvReportRepository */
        $callCsvReportRepository = $this
            ->em
            ->getRepository(CallCsvReport::class);

        $genericCallCsvTemplate = $repository
            ->findCallCsvTemplateByCallCsvReport(
                $callCsvReportRepository->find(1)
            );

        $this->assertInstanceOf(
            NotificationTemplate::class,
            $genericCallCsvTemplate
        );
    }

    public function its_finds_invoice_template()
    {
        /** @var NotificationTemplateRepository $repository */
        $repository = $this
            ->em
            ->getRepository(NotificationTemplate::class);

        /** @var CompanyRepository $companyRepository */
        $companyRepository = $this
            ->em
            ->getRepository(Company::class);

        $genericCallCsvTemplate = $repository
            ->findInvoiceNotificationTemplateByCompany(
                $companyRepository->find(1)
            );

        $this->assertInstanceOf(
            NotificationTemplate::class,
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

        $languageRepository = $this
            ->em
            ->getRepository(Language::class);

        $notificationTemplates = $notificationTemplateRepository
            ->findTemplateByBalanceNotification(
                $balanceNotificationRepository->find(1),
                $languageRepository->find(1)
            );

        $this->assertInstanceOf(
            NotificationTemplateInterface::class,
            $notificationTemplates
        );
    }

    public function its_finds_generic_on_demand_record_template()
    {
        /** @var NotificationTemplateRepository $repository */
        $repository = $this
            ->em
            ->getRepository(NotificationTemplate::class);

        /** @var CompanyRepository $companyRepository */
        $companyRepository = $this
            ->em
            ->getRepository(Company::class);

        $company = $companyRepository->find(6);

        $template = $repository->findOnDemandRecordTemplateByCompany($company);

        $this->assertInstanceOf(NotificationTemplate::class, $template);
        $this->assertSame(
            NotificationTemplateInterface::TYPE_ONDEMANDRECORD,
            $template->getType()
        );
        $this->assertNull(
            $template->getBrand(),
            'Generic template must have no brand assigned'
        );
    }

    public function its_finds_brand_on_demand_record_template()
    {
        /** @var NotificationTemplateRepository $repository */
        $repository = $this
            ->em
            ->getRepository(NotificationTemplate::class);

        /** @var CompanyRepository $companyRepository */
        $companyRepository = $this
            ->em
            ->getRepository(Company::class);

        $company = $companyRepository->find(2);

        $template = $repository->findOnDemandRecordTemplateByCompany($company);

        $this->assertSame(7, $template->getId());
    }

    public function its_finds_company_on_demand_record_template()
    {
        /** @var NotificationTemplateRepository $repository */
        $repository = $this
            ->em
            ->getRepository(NotificationTemplate::class);

        /** @var CompanyRepository $companyRepository */
        $companyRepository = $this
            ->em
            ->getRepository(Company::class);

        $company = $companyRepository->find(7);

        $template = $repository->findOnDemandRecordTemplateByCompany($company);

        $this->assertSame(8, $template->getId());
    }
}
