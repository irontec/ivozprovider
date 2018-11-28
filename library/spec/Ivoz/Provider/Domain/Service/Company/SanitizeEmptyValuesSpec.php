<?php

namespace spec\Ivoz\Provider\Domain\Service\Company;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Service\Company\SanitizeEmptyValues;
use PhpSpec\Exception\Example\FailureException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SanitizeEmptyValuesSpec extends ObjectBehavior
{
    /**
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * @var CompanyDto
     */
    protected $dto;

    /** @var Company */
    protected $company;

    function let(
        EntityTools $entityTools,
        Company $entity
    ) {
        $this->company = $entity;
        $this->entityTools = $entityTools;
        $this->beConstructedWith($entityTools);

        $this->dto = new CompanyDto();
    }

    protected function prepareDto()
    {
        $this
            ->company
            ->isNew()
            ->willReturn(true)
            ->shouldBeCalled();

        $this
            ->entityTools
            ->entityToDto($this->company)
            ->willReturn($this->dto)
            ->shouldBeCalled();

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
            ->setMediaRelaySetsId(0)
            ->setIpFilter(0)
            ->setOnDemandRecord(0)
            ->setOnDemandRecordCode(1);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(SanitizeEmptyValues::class);
    }

    function it_checks_whether_the_entity_is_new()
    {
        $this
            ->company
            ->isNew()
            ->willReturn(false);

        $this
            ->entityTools
            ->entityToDto(Argument::any())
            ->shouldNotBeCalled();

        $this->execute($this->company, false);
    }

    function it_sets_media_relay_sets_when_empty()
    {
        $this->prepareDto();
        $this
            ->dto
            ->setMediaRelaySetsId(null);

        $this
            ->entityTools
            ->updateEntityByDto($this->company, $this->dto)
            ->shouldBeCalled();

        $this->execute($this->company, true);

        if ($this->dto->getMediaRelaySetsId() !== 0) {
            throw new FailureException(
                'Unexpected media relay sets id value found'
            );
        }
    }
}
