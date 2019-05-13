<?php

namespace Tests\Provider\DdiProvider;

use Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderRepository;
use Ivoz\Provider\Infrastructure\Domain\Service\DdiProvider\SendTrunksAddressPermissionsReloadRequest;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProvider;

class DdiProviderLifeCycleTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function its_instantiable()
    {
        /** @var DdiProviderRepository $repository */
        $repository = $this
            ->em
            ->getRepository(DdiProvider::class);

        $this->assertInstanceOf(
            DdiProviderRepository::class,
            $repository
        );
    }

    /**
     * @test
     */
    public function it_triggers_trunks_address_permissions_reload_on_delete()
    {
        $trustedReloadServices = [
            SendTrunksAddressPermissionsReloadRequest::class
        ];

        $this->mockInfraestructureServices(
            'provider.lifecycle.ddi_provider.on_commit',
            $trustedReloadServices,
            1
        );

        $repository = $this->em->getRepository(DdiProvider::class);
        $ddiProvider = $repository->findOneBy([
            'name' => 'DDIProviderName'
        ]);
        $this->entityTools->remove(
            $ddiProvider
        );
    }
}
