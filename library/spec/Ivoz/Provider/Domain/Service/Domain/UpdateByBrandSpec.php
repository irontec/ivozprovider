<?php

namespace spec\Ivoz\Provider\Domain\Service\Domain;

use Doctrine\ORM\EntityManagerInterface;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Domain\DomainDto;
use Ivoz\Provider\Domain\Model\Domain\DomainInterface;
use Ivoz\Provider\Domain\Model\Domain\DomainRepository;
use Ivoz\Provider\Domain\Service\Domain\UpdateByBrand;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UpdateByBrandSpec extends ObjectBehavior
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    /**
     * @var DomainRepository
     */
    protected $domainRepository;

    /**
     * @var BrandInterface
     */
    protected $entity;

    public function let(
        EntityManagerInterface $em,
        EntityPersisterInterface $entityPersister,
        DomainRepository $domainRepository,
        BrandInterface $entity
    ) {
        $this->em = $em;
        $this->entityPersister = $entityPersister;
        $this->domainRepository = $domainRepository;
        $this->entity = $entity;

        $this->beConstructedWith(
            $em,
            $entityPersister,
            $domainRepository
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(UpdateByBrand::class);
    }

    function it_returns_when_domain_user_has_not_changed()
    {
        $this->entity
            ->hasChanged('domain_users')
            ->willReturn(false);

        $this
            ->entity
            ->getId()
            ->shouldNotBeCalled();

        $this->execute(
            $this->entity,
            true
        );
    }

    function it_deletes_domains_when_domainUsers_is_empty(
        DomainInterface $domain
    ) {
        $this->prepareDomain($domain);

        $this
            ->em
            ->remove($domain)
            ->shouldBeCalled();

        $this->execute(
            $this->entity,
            true
        );
    }

    function it_updates_domains_when_domainUsers_is_empty(
        DomainInterface $domain,
        DomainDto $domainDto
    ) {
        $this->prepareDomain(
            $domain,
            'myNewDomain'
        );

        $this
            ->entity
            ->getName()
            ->willReturn('brandName');

        $this->prepareDtoCallChain($domain, $domainDto);

        $this
            ->entityPersister
            ->persistDto($domainDto, $domain)
            ->willReturn($domain)
            ->shouldBeCalled();

        $this
            ->entity
            ->setDomain($domain)
            ->shouldBeCalled();

        $this->execute(
            $this->entity,
            true
        );
    }

    function it_creates_a_new_domain_if_no_results(
        DomainInterface $domain,
        DomainDto $domainDto
    ) {
        $this->prepareDomain(null, 'myNewDomain');

        $this
            ->entity
            ->getName()
            ->willReturn('brandName');

        $domain
            ->toDto()
            ->shouldNotBeCalled();

        $this
            ->entityPersister
            ->persistDto(
                Argument::type(DomainDto::class),
                null
            )
            ->willReturn($domain)
            ->shouldBeCalled();

        $this
            ->entity
            ->setDomain($domain)
            ->shouldBeCalled();

        $this->execute(
            $this->entity,
            true
        );
    }

    /**
     * @param DomainInterface $domain
     */
    private function prepareDomain(
        DomainInterface $domain,
        string $domainUsers = ''
    ) {
        $this->entity
            ->hasChanged('domain_users')
            ->willReturn(true);

        $this
            ->entity
            ->getDomainUsers()
            ->willReturn($domainUsers);

        $this
            ->entity
            ->getDomain()
            ->willReturn($domain);
    }

    /**
     * @param DomainInterface $domain
     * @param DomainDto $domainDto
     */
    private function prepareDtoCallChain(DomainInterface $domain, DomainDto $domainDto)
    {
        $domain
            ->toDto()
            ->willReturn($domainDto);

        $domainDto
            ->setDomain('myNewDomain')
            ->willReturn($domainDto)
            ->shouldBeCalled();

        $domainDto
            ->setDescription("brandName proxyusers domain")
            ->willReturn($domainDto)
            ->shouldBeCalled();
    }
}
