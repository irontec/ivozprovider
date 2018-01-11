<?php

namespace spec\Ivoz\Provider\Domain\Service\Company;

use Ivoz\Core\Application\Service\UpdateEntityFromDTO;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Service\Company\SanitizeEmptyValues;
use PhpSpec\Exception\Example\FailureException;
use PhpSpec\ObjectBehavior;

class SanitizeEmptyValuesSpec extends ObjectBehavior
{
    /**
     * @var UpdateEntityFromDTO
     */
    protected $entityUpdater;
    /**
     * @var CompanyDto
     */
    protected $dto;
    protected $entity;

    function let(
        UpdateEntityFromDTO $entityUpdater,
        Company $entity
    ) {
        $this->entityUpdater = $entityUpdater;
        $this->beConstructedWith($entityUpdater);

        $this->dto = new CompanyDto();
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
            ->setMediaRelaySetsId(0)
            ->setIpFilter(0)
            ->setOnDemandRecord(0)
            ->setOnDemandRecordCode(1);

        $this
            ->entity
            ->toDto()
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
            ->toDto()
            ->shouldNotBeCalled();

        $this->execute($this->entity, false);
    }

    function it_persist_new_entities()
    {
        $this->prepareDto();

        $this
            ->entityUpdater
            ->execute($this->entity, $this->dto)
            ->shouldBeCalled();

        $this->execute($this->entity, true);
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
}
