<?php

namespace Tests\Provider\RetailAccount;

use Ivoz\Provider\Domain\Model\Domain\Domain;
use Ivoz\Provider\Domain\Model\Domain\DomainInterface;
use Ivoz\Provider\Domain\Model\Domain\DomainRepository;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccount;

class RetailAccountRepositoryTest extends KernelTestCase
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
        /** @var RetailAccountRepository $repository */
        $repository = $this
            ->em
            ->getRepository(RetailAccount::class);

        $this->assertInstanceOf(
            RetailAccountRepository::class,
            $repository
        );
    }

    public function it_finds_one_by_name_and_domain()
    {
        /** @var RetailAccountRepository $repository */
        $repository = $this
            ->em
            ->getRepository(RetailAccount::class);

        /** @var DomainRepository $domainRepository */
        $domainRepository = $this
            ->em
            ->getRepository(Domain::class);

        /** @var DomainInterface $domain */
        $domain = $domainRepository->find(6);

        $RetailAccount = $repository->findOneByNameAndDomain(
            'testRetailAccount',
            $domain
        );

        $this->assertInstanceOf(
            RetailAccount::class,
            $RetailAccount
        );
    }

    public function it_counts_registrable_devices_by_brand()
    {
        /** @var RetailAccountRepository $repository */
        $repository = $this
            ->em
            ->getRepository(RetailAccount::class);

        $num = $repository->countRegistrableDevicesByCompanies([1]);

        $this->assertIsInt(
            $num
        );
    }
}
