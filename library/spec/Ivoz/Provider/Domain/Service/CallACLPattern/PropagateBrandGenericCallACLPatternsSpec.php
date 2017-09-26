<?php

namespace spec\Ivoz\Provider\Domain\Service\CallACLPattern;

use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\CallACLPattern\CallACLPattern;
use Ivoz\Provider\Domain\Service\CallACLPattern\PropagateBrandGenericCallACLPatterns;
use PhpSpec\ObjectBehavior;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Company\CompanyDTO;
use spec\SpecHelperTrait;

class PropagateBrandGenericCallACLPatternsSpec extends ObjectBehavior
{
    protected $entityPersister;
    protected $entity;
    protected $dto;

    function let(
        EntityPersisterInterface $entityPersister,
        Company $entity
    ) {
        $this->entityPersister = $entityPersister;
        $this->beConstructedWith($entityPersister);

        $this->dto = New CompanyDTO();
        $this->entity = $entity;
        $this
            ->entity
            ->toDTO()
            ->willReturn($this->dto);

        $this
            ->entity
            ->getBrand()
            ->willReturn(null);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(PropagateBrandGenericCallACLPatterns::class);
    }

    function it_checks_whether_the_entity_is_new()
    {
        $this
            ->entity
            ->toDTO()
            ->shouldNotBeCalled();

        $this->execute($this->entity, false);
    }

    function it_throws_exception_with_empty_brand()
    {
        $this
            ->shouldThrow('\Exception')
            ->during('execute', [$this->entity, true]);
    }

    function it_search_for_generic_acl_patterns(
        Brand $brand
    ) {
        $this
            ->entity
            ->getBrand()
            ->shouldBeCalled()
            ->willReturn($brand);

        $brand
            ->getGenericCallACLPatterns()
            ->willReturn([]);

        $this->execute($this->entity, true);
    }


    function it_sets_call_acl_patterns(
        Brand $brand,
        CallACLPattern $callACLPattern
    ) {
        $this
            ->entity
            ->getBrand()
            ->shouldBeCalled()
            ->willReturn($brand);

        $brand
            ->getGenericCallACLPatterns()
            ->willReturn([$callACLPattern]);

        $callACLPattern
            ->getName()
            ->shouldBeCalled()
            ->willReturn('Name');

        $callACLPattern
            ->getRegExp()
            ->shouldBeCalled()
            ->willReturn('RegExp');

        $this
            ->entityPersister
            ->persist($this->dto, $this->entity)
            ->shouldBeCalled();

        $this->execute($this->entity, true);

        $aclPattern = $this->dto->getCallACLPatterns();
        if ($aclPattern[0]->getName() !== 'Name') {
            throw new FailureException(
                'Unexpected call acl pattern name '
                . $aclPattern[0]->getName()
                . 'found, Name expected.'
            );
        }

        if ($aclPattern[0]->getRegExp() !== 'RegExp') {
            throw new FailureException(
                'Unexpected call acl pattern regExp '
                . $aclPattern[0]->getRegExp()
                . 'found, RegExp expected.'
            );
        }
    }
}
