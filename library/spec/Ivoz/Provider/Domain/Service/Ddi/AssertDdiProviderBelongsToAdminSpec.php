<?php

namespace spec\Ivoz\Provider\Domain\Service\Ddi;

use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderRepository;
use Ivoz\Provider\Domain\Service\Ddi\AssertDdiProviderBelongsToAdmin;
use PhpSpec\ObjectBehavior;

class AssertDdiProviderBelongsToAdminSpec extends ObjectBehavior
{
    protected $ddiProviderRepository;

    public function let(
        DdiProviderRepository $ddiProviderRepository,
        AdministratorInterface $admin,
        DdiProviderInterface $ddiProvider
    ) {
        $this->ddiProviderRepository = $ddiProviderRepository;
        $this->beConstructedWith($ddiProviderRepository);

        $ddiProvider
            ->getId()
            ->willReturn(1);

        $ddiProviderRepository
            ->getDdiProviderIdsByBrandAdmin($admin)
            ->willReturn([1, 2]);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(AssertDdiProviderBelongsToAdmin::class);
    }

    function it_accepts_ddi_providers_of_the_admin_brand(
        AdministratorInterface $admin,
        DdiProviderInterface $ddiProvider
    ) {
        $this
            ->shouldNotThrow()
            ->during('execute', [$admin, $ddiProvider]);
    }

    function it_rejects_ddi_providers_of_other_brands(
        AdministratorInterface $admin,
        DdiProviderInterface $ddiProvider
    ) {
        $this
            ->ddiProviderRepository
            ->getDdiProviderIdsByBrandAdmin($admin)
            ->willReturn([2, 3]);

        $this
            ->shouldThrow(new \DomainException('DDI provider not found', 404))
            ->during('execute', [$admin, $ddiProvider]);
    }
}
