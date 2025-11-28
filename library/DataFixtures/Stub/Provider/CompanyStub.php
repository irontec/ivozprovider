<?php

namespace DataFixtures\Stub\Provider;

use DataFixtures\Stub\StubTrait;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;

class CompanyStub
{
    use StubTrait;

    protected function getEntityName(): string
    {
        return Company::class;
    }

    protected function load()
    {
        $dto = (new CompanyDto(1))
            ->setName("DemoCompany")
            ->setDomainUsers("127.0.0.1")
            ->setMaxCalls(0)
            ->setIpfilter(false)
            ->setOnDemandRecord(0)
            ->setOnDemandRecordCode("")
            ->setExternallyextraopts("")
            ->setRecordingsLimitEmail("")
            ->setBillingMethod("prepaid")
            ->setBalance(1.2)
            ->setMaxDailyUsageEmail('no-replay@domain.net')
            ->setMaxDailyUsage(2)
            ->setCurrentDayUsage(1)
            ->setShowInvoices(true)
            ->setInvoicingNif('12345678A')
            ->setInvoicingPostalAddress('Company Address')
            ->setInvoicingPostalCode('54321')
            ->setInvoicingTown('Company Town')
            ->setInvoicingProvince('Company Province')
            ->setInvoicingCountryName('Company Country')
            ->setLanguageId(1)
            ->setDefaultTimezoneId(145)
            ->setBrandId(1)
            ->setDomainId(3)
            ->setCountryId(68)
            ->setTransformationRuleSetId(1)
            ->setVoicemailNotificationTemplateId(1)
            ->setAccessCredentialNotificationTemplateId(5)
            ->setCorporationId(1)
            ->setApplicationServerSetId(1)
            ->setMediaRelaySetId(0)
            ->setMaxDailyUsageNotificationTemplateId(2)
            ->setLocationId(1);

        $this->append($dto);
    }
}
