<?php

namespace spec\Ivoz\Provider\Domain\Service\Domain;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Domain\DomainDto;
use Ivoz\Provider\Domain\Model\Domain\DomainInterface;
use Ivoz\Provider\Domain\Model\Domain\DomainRepository;
use Ivoz\Provider\Domain\Service\Domain\UpdateByCompany;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UpdateByCompanySpec extends ObjectBehavior
{
    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    /**
     * @var DomainRepository
     */
    protected $domainRepository;

    /**
     * @var CompanyInterface
     */
    protected $entity;

    public function let(
        EntityPersisterInterface $entityPersister,
        DomainRepository $domainRepository,
        CompanyInterface $entity
    ) {
        $this->entityPersister = $entityPersister;
        $this->domainRepository = $domainRepository;
        $this->entity = $entity;

        $this->beConstructedWith(
            $entityPersister,
            $domainRepository
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(UpdateByCompany::class);
    }

    function it_returns_when_domain_user_is_empty()
    {
        $this->entity
            ->getDomainUsers()
            ->willReturn('');

        $this
            ->entity
            ->getDomain()
            ->shouldNotBeCalled();

        $this->execute(
            $this->entity,
            true
        );
    }

    function it_creates_new_domain_if_none(
        DomainInterface $domain
    ) {
        $this->prepareEntityResponses();

        $this
            ->entity
            ->getDomain()
            ->willReturn(null)
            ->shouldBeCalled();

        $this
            ->entityPersister
            ->persistDto(
                Argument::that($this->getDomainDtoAssertion()),
                null
            )
            ->willReturn($domain)
            ->shouldBeCalled();

        $this->entity
             ->setDomain($domain)
             ->shouldBeCalled();

        $this->execute(
            $this->entity,
            true
        );
    }


    function it_updates_domain_if_exists(
        DomainInterface $domain
    ) {
        $this->prepareEntityResponses();

        $this
            ->entity
            ->getDomain()
            ->willReturn($domain)
            ->shouldBeCalled();


        $domainDto = new DomainDto();
        $domain
            ->toDto()
            ->willReturn($domainDto)
            ->shouldBeCalled();

        $this
            ->entityPersister
            ->persistDto(
                Argument::that($this->getDomainDtoAssertion()),
                $domain
            )
            ->willReturn($domain)
            ->shouldBeCalled();

        $this->entity
            ->setDomain($domain)
            ->shouldBeCalled();

        $this->execute(
            $this->entity,
            true
        );
    }

    protected function getDomainDtoAssertion()
    {
        return function (DomainDto $dto) {

            $domain = $dto->getDomain();
            $expectedDomain = 'DomainUserValue';
            if ($domain !== $expectedDomain) {
                throw new FailureException('Unexpected domain value');
            }

            $description = $dto->getDescription();
            $expectedDescription = 'NameValue proxyusers domain';
            if ($description !== $expectedDescription) {
                throw new FailureException('Unexpected description value');
            }

            return true;
        };
    }

    private function prepareEntityResponses()
    {
        $this->entity
            ->getDomainUsers()
            ->willReturn('DomainUserValue');

        $this->entity
            ->getName()
            ->willReturn('NameValue');
    }
}
