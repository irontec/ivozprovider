<?php

namespace spec\Ivoz\Provider\Domain\Service\CallAclPattern;

use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\CallAclPattern\CallAclPattern;
use Ivoz\Provider\Domain\Service\CallAclPattern\PropagateBrandGenericCallAclPatterns;
use PhpSpec\ObjectBehavior;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Company\CompanyDTO;
use spec\SpecHelperTrait;

class PropagateBrandGenericCallAclPatternsSpec extends ObjectBehavior
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
        $this->shouldHaveType(PropagateBrandGenericCallAclPatterns::class);
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
            ->getGenericCallAclPatterns()
            ->willReturn([]);

        $this->execute($this->entity, true);
    }


    function it_sets_call_acl_patterns(
        Brand $brand,
        CallAclPattern $callAclPattern
    ) {
        $this
            ->entity
            ->getBrand()
            ->shouldBeCalled()
            ->willReturn($brand);

        $brand
            ->getGenericCallAclPatterns()
            ->willReturn([$callAclPattern]);

        $callAclPattern
            ->getName()
            ->shouldBeCalled()
            ->willReturn('Name');

        $callAclPattern
            ->getRegExp()
            ->shouldBeCalled()
            ->willReturn('RegExp');

        $this
            ->entityPersister
            ->persistDto($this->dto, $this->entity)
            ->shouldBeCalled();

        $this->execute($this->entity, true);

        $aclPattern = $this->dto->getCallAclPatterns();
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
