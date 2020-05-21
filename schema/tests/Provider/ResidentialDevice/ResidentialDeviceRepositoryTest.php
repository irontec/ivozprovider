<?php

namespace Tests\Provider\ResidentialDevice;

use Ivoz\Provider\Domain\Model\Domain\Domain;
use Ivoz\Provider\Domain\Model\Domain\DomainRepository;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDevice;

class ResidentialDeviceRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function test_runner()
    {
        $this->its_instantiable();
        $this->it_finds_one_by_name_and_domain();
        $this->it_counts_registrable_devices_by_brand();
    }

    public function its_instantiable()
    {
        /** @var ResidentialDeviceRepository $repository */
        $repository = $this
            ->em
            ->getRepository(ResidentialDevice::class);

        $this->assertInstanceOf(
            ResidentialDeviceRepository::class,
            $repository
        );
    }

    public function it_finds_one_by_name_and_domain()
    {
        /** @var ResidentialDeviceRepository $repository */
        $repository = $this
            ->em
            ->getRepository(ResidentialDevice::class);

        /** @var DomainRepository $domainRepository */
        $domainRepository = $this
            ->em
            ->getRepository(Domain::class);

        /** @var Domain $domain */
        $domain = $domainRepository->find(6);

        $residentialDevice = $repository->findOneByNameAndDomain(
            'residentialDevice',
            $domain
        );

        $this->assertInstanceOf(
            ResidentialDevice::class,
            $residentialDevice
        );
    }

    public function it_counts_registrable_devices_by_brand()
    {
        /** @var ResidentialDeviceRepository $repository */
        $repository = $this
            ->em
            ->getRepository(ResidentialDevice::class);

        $num = $repository->countRegistrableDevicesByCompanies([1]);

        $this->assertInternalType(
            'int',
            $num
        );
    }
}
