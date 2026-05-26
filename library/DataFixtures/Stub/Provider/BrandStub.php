<?php

namespace DataFixtures\Stub\Provider;

use DataFixtures\Stub\StubTrait;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;
use Ivoz\Provider\Domain\Model\Brand\Logo;

class BrandStub
{
    use StubTrait;

    protected function getEntityName(): string
    {
        return Brand::class;
    }

    protected function load()
    {
        $dto = (new BrandDto(1))
            ->setName("DemoBrand")
            ->setDomainUsers("")
            ->setRecordingsLimitEmail("")
            ->setRecordingsLimitMB(0)
            ->setMaxCalls(0)
            ->setDomainId(6)
            ->setLanguageId(1)
            ->setDefaultTimezoneId(145)
            ->setCurrencyId(1)
            ->setOnDemandRecordNotificationTemplateId(7);

        $this->append($dto);
    }
}
