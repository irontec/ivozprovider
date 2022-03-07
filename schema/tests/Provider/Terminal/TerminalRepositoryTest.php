<?php

namespace Tests\Provider\Terminal;

use Ivoz\Provider\Domain\Model\Domain\Domain;
use Ivoz\Provider\Domain\Model\Domain\DomainInterface;
use Ivoz\Provider\Domain\Model\Domain\DomainRepository;
use Ivoz\Provider\Domain\Model\Terminal\TerminalRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\Terminal\Terminal;

class TerminalRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function test_runner()
    {
        $this->its_instantiable();
        $this->it_finds_one_by_name_and_domain();
        $this->it_finds_one_by_mac();
        $this->it_finds_by_companyId();
        $this->it_counts_registrable_devices_by_brand();
    }

    public function its_instantiable()
    {
        /** @var TerminalRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Terminal::class);

        $this->assertInstanceOf(
            TerminalRepository::class,
            $repository
        );
    }

    public function it_finds_one_by_name_and_domain()
    {
        /** @var TerminalRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Terminal::class);

        /** @var DomainRepository $domainRepository */
        $domainRepository = $this
            ->em
            ->getRepository(Domain::class);

        /** @var DomainInterface $domain */
        $domain = $domainRepository->find(3);

        $terminal = $repository->findOneByNameAndDomain(
            'alice',
            $domain
        );

        $this->assertInstanceOf(
            Terminal::class,
            $terminal
        );
    }

    public function it_finds_one_by_company_and_name()
    {
        /** @var TerminalRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Terminal::class);

        $terminal = $repository->findOneByCompanyAndName(
            1,
            'alice'
        );

        $this->assertInstanceOf(
            Terminal::class,
            $terminal
        );
    }

    public function it_finds_one_by_mac()
    {
        /** @var TerminalRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Terminal::class);

        $terminal = $repository->findOneByMac(
            '0011223344aa'
        );

        $this->assertInstanceOf(
            Terminal::class,
            $terminal
        );
    }

    public function it_finds_by_companyId()
    {
        $includedIds = [1];
        /** @var TerminalRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Terminal::class);

        $terminals = $repository->findUnassignedByCompanyId(
            1,
            $includedIds
        );

        $this->assertIsArray($terminals);

        $this->assertInstanceOf(
            Terminal::class,
            $terminals[0]
        );

        $this->assertEquals(
            $terminals[0]->getId(),
            $includedIds[0]
        );
    }

    public function it_counts_registrable_devices_by_brand()
    {
        /** @var TerminalRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Terminal::class);

        $num = $repository->countRegistrableDevices([1]);

        $this->assertIsInt(
            $num
        );
    }
}
