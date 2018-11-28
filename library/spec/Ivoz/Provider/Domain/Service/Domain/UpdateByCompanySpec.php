<?php

namespace spec\Ivoz\Provider\Domain\Service\Domain;

use Ivoz\Core\Application\Service\EntityTools;
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
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * @var DomainRepository
     */
    protected $domainRepository;

    /**
     * @var CompanyInterface
     */
    protected $entity;

    public function let(
        EntityTools $entityTools,
        DomainRepository $domainRepository,
        CompanyInterface $entity
    ) {
        $this->entityTools = $entityTools;
        $this->domainRepository = $domainRepository;
        $this->entity = $entity;

        $this->beConstructedWith(
            $entityTools,
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
            $this->entity
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
            ->entityTools
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
            $this->entity
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
        $this->entityTools
            ->entityToDto($domain)
            ->willReturn($domainDto);

        $this
            ->entityTools
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
            $this->entity
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
