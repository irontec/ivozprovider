<?php

namespace spec\Ivoz\Provider\Domain\Service\Brand;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Brand\BrandDTO;
use Ivoz\Provider\Domain\Service\Brand\SanitizeEmptyValues;
use PhpSpec\ObjectBehavior;
use PhpSpec\Exception\Example\FailureException;
use spec\SpecHelperTrait;

class SanitizeEmptyValuesSpec extends ObjectBehavior
{
    protected $entityPersister;
    protected $entity;
    protected $dto;

    function let(
        EntityPersisterInterface $entityPersister,
        Brand $entity
    ) {
        $this->entityPersister = $entityPersister;
        $this->entity = $entity;

        $this->beConstructedWith($entityPersister);

        $this->dto = New BrandDTO();
        $this
            ->dto
            ->setDefaultTimezoneId(1)
            ->setLanguageId(1);

        $this
            ->entity
            ->toDTO()
            ->willReturn($this->dto);
    }

    function it_is_initializable()
    {
        $this->shouldBeAnInstanceOf(SanitizeEmptyValues::class);
    }

    function it_checks_whether_the_entity_is_new()
    {
        $this
            ->entity
            ->toDTO()
            ->shouldNotBeCalled();

        $this->execute($this->entity, false);
    }

    function it_persists_new_entities()
    {
        $this
            ->entityPersister
            ->persistDto($this->dto, $this->entity)
            ->shouldBeCalled();

        $this->execute($this->entity, true);
    }

    function it_sets_default_timezone_when_empty()
    {
        $this
            ->dto
            ->setDefaultTimezoneId(null);

        $this->execute($this->entity, true);

        $timezoneId = $this->dto->getDefaultTimezoneId();
        if (!$timezoneId) {
            throw new FailureException('TimezoneId is empty');
        }
    }

    function it_sets_default_language_when_empty()
    {
        $this->dto->setLanguageId(null);
        $this->execute($this->entity, true);

        $languageId = $this->dto->getLanguageId();
        if (!$languageId) {
            throw new FailureException('LanguageId is empty');
        }
    }
}
