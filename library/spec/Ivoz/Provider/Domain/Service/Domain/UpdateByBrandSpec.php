<?php

namespace spec\Ivoz\Provider\Domain\Service\Domain;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;
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
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * @var DomainRepository
     */
    protected $domainRepository;

    /**
     * @var BrandInterface
     */
    protected $entity;

    public function let(
        EntityTools $entityTools,
        DomainRepository $domainRepository,
        BrandInterface $entity
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
            $this->entity
        );
    }

    function it_deletes_domains_when_domainUsers_is_empty(
        DomainInterface $domain
    ) {
        $this->prepareDomain($domain);

        $this
            ->entityTools
            ->remove($domain)
            ->shouldBeCalled();

        $this->execute(
            $this->entity
        );
    }

    function it_updates_domains_when_domainUsers_is_empty(
        DomainInterface $domain,
        DomainDto $domainDto,
        BrandDto $brandDto
    ) {
        $this->prepareDomain(
            $domain,
            'myNewDomain'
        );

        $this
            ->entity
            ->getName()
            ->willReturn('brandName');

        $this
            ->entityTools
            ->entityToDto($domain)
            ->willReturn($domainDto);

        $this->prepareDomainDtoCallChain(
            $domain,
            $domainDto
        );

        $this
            ->entityTools
            ->persistDto($domainDto, $domain, true)
            ->willReturn($domain)
            ->shouldBeCalled();

        $this->prepareBrandDtoCallChanin(
            $brandDto
        );

        $this
            ->entityTools
            ->persistDto($brandDto, $this->entity)
            ->shouldBeCalled();

        $this->execute(
            $this->entity
        );
    }

    function it_creates_a_new_domain_if_no_results(
        DomainInterface $domain,
        DomainDto $domainDto,
        BrandDto $brandDto
    ) {
        $this->prepareDomain(null, 'myNewDomain');

        $this
            ->entity
            ->getName()
            ->willReturn('brandName');

        $this
            ->entityTools
            ->entityToDto($domain)
            ->shouldNotBeCalled();

        $this
            ->entityTools
            ->persistDto(
                Argument::type(DomainDto::class),
                null,
                true
            )
            ->willReturn($domain)
            ->shouldBeCalled();

        $this->prepareBrandDtoCallChanin(
            $brandDto
        );

        $this->entityTools
            ->persistDto(
                Argument::type(BrandDto::class),
                $this->entity
            )
            ->shouldBeCalled();

        $this->execute(
            $this->entity
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
    private function prepareDomainDtoCallChain(DomainInterface $domain, DomainDto $domainDto)
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

    private function prepareBrandDtoCallChanin(BrandDto $brandDto)
    {
        $this
            ->entityTools
            ->entityToDto(
                $this->entity
            )
            ->willReturn(
                $brandDto
            )
            ->shouldBeCalled();

        $brandDto
            ->setDomain(Argument::type(DomainDto::class))
            ->willReturn($brandDto)
            ->shouldBeCalled();
    }
}
