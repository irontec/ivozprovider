<?php

namespace spec\Ivoz\Provider\Domain\Service\Company;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Company\CompanyDTO;
use Ivoz\Provider\Domain\Model\Language\LanguageInterface;
use Ivoz\Provider\Domain\Model\Timezone\TimezoneInterface;
use Ivoz\Provider\Domain\Service\Company\SanitizeEmptyValues;
use PhpSpec\Exception\Example\FailureException;
use PhpSpec\ObjectBehavior;
use spec\SpecHelperTrait;

class SanitizeEmptyValuesSpec extends ObjectBehavior
{
    protected $entityPersister;
    /**
     * @var CompanyDTO
     */
    protected $dto;
    protected $entity;

    function let(
        EntityPersisterInterface $entityPersister,
        Company $entity
    ) {
        $this->entityPersister = $entityPersister;
        $this->beConstructedWith($entityPersister);

        $this->dto = new CompanyDTO();
        $this->entity = $entity;
    }

    protected function prepareDto()
    {
        $this
            ->dto
            ->setNif('12345678-Z')
            ->setPostalAddress('Postal address')
            ->setPostalCode('PC')
            ->setTown('Town')
            ->setCountryName('Country')
            ->setProvince('Province')
            ->setDefaultTimezoneId(1)
            ->setCountryId(70)
            ->setLanguageId(1)
            ->setOutboundPrefix('')
            ->setMediaRelaySetsId(0)
            ->setIpFilter(0)
            ->setOnDemandRecord(0)
            ->setOnDemandRecordCode(1)
            ->setAreaCode(1);

        $this
            ->entity
            ->toDTO()
            ->shouldBeCalled()
            ->willReturn($this->dto);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(SanitizeEmptyValues::class);
    }

    function it_checks_whether_the_entity_is_new()
    {
        $this
            ->entity
            ->toDTO()
            ->shouldNotBeCalled();

        $this->execute($this->entity, false);
    }

    function it_persist_new_entities()
    {
        $this->prepareDto();

        $this
            ->entityPersister
            ->persistDto($this->dto, $this->entity, false)
            ->shouldBeCalled();

        $this->execute($this->entity, true);
    }


    function it_sets_timezone_when_empty(
        BrandInterface $brand,
        TimezoneInterface $timezone
    )
    {
        $this
            ->entity
            ->getBrand()
            ->shouldBeCalled()
            ->willReturn($brand);

        $brand
            ->getDefaultTimezone()
            ->shouldBeCalled()
            ->willReturn($timezone);

        $timezone
            ->getId()
            ->shouldBeCalled()
            ->willReturn(1);

        $this->prepareDto();
        $this
            ->dto
            ->setDefaultTimezoneId(null);

        $this->execute($this->entity, true);

        if (!$this->dto->getDefaultTimezoneId()) {
            throw new FailureException(
                'Empty timezone found'
            );
        }
    }

    function it_sets_country_id_when_empty()
    {
        $this->prepareDto();
        $this
            ->dto
            ->setCountryId(null);

        $this->execute($this->entity, true);

        if (!$this->dto->getCountryId()) {
            throw new FailureException(
                'Empty country id found'
            );
        }
    }

    function it_sets_language_when_empty(
        BrandInterface $brand,
        LanguageInterface $language
    )
    {
        $this
            ->entity
            ->getBrand()
            ->shouldBeCalled()
            ->willReturn($brand);

        $brand
            ->getLanguage()
            ->shouldBeCalled()
            ->willReturn($language);

        $language
            ->getId()
            ->shouldBeCalled()
            ->willReturn(1);

        $this->prepareDto();
        $this
            ->dto
            ->setLanguageId(null);

        $this->execute($this->entity, true);

        if (!$this->dto->getLanguageId()) {
            throw new FailureException(
                'Empty language found'
            );
        }
    }

    function it_sets_outbound_prefix_when_empty()
    {
        $this->prepareDto();
        $this
            ->dto
            ->setOutboundPrefix(null);

        $this->execute($this->entity, true);

        if ($this->dto->getOutboundPrefix() !== '') {
            throw new FailureException(
                'Empty outbound prefix id found'
            );
        }
    }

    function it_sets_media_relay_sets_when_empty()
    {
        $this->prepareDto();
        $this
            ->dto
            ->setMediaRelaySetsId(null);

        $this->execute($this->entity, true);

        if ($this->dto->getMediaRelaySetsId() !== 0) {
            throw new FailureException(
                'Unexpected media relay sets id value found'
            );
        }
    }

    function it_sets_ip_filter_when_empty()
    {
        $this->prepareDto();
        $this
            ->dto
            ->setIpFilter(null);

        $this->execute($this->entity, true);

        if ($this->dto->getIpFilter() !== 0) {
            throw new FailureException(
                'Unexpected ip filter value found'
            );
        }
    }

    function it_sets_on_demand_record_when_empty()
    {
        $this->prepareDto();
        $this
            ->dto
            ->setOnDemandRecord(null);

        $this->execute($this->entity, true);

        if ($this->dto->getOnDemandRecord() !== 0) {
            throw new FailureException(
                'Unexpected on demand record value found'
            );
        }
    }

    function it_sets_on_demand_record_code_when_empty()
    {
        $this->prepareDto();
        $this
            ->dto
            ->setOnDemandRecordCode(null);

        $this->execute($this->entity, true);

        if ($this->dto->getOnDemandRecordCode() !== '') {
            throw new FailureException(
                'Unexpected on demand record code value found'
            );
        }
    }

    function it_sets_area_code_when_empty()
    {
        $this->prepareDto();
        $this
            ->dto
            ->setAreaCode(null);

        $this->execute($this->entity, true);

        if ($this->dto->getAreaCode() !== '') {
            throw new FailureException(
                'Unexpected area code value found'
            );
        }
    }
}
