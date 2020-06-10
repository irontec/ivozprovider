<?php

namespace Tests\Provider\Domain;

use Ivoz\Provider\Domain\Model\Domain\DomainRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\Domain\Domain;

class DomainRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function test_runner()
    {
        $this->its_instantiable();
        $this->it_finds_one_by_domain();
        $this->it_finds_by_company();
        $this->it_finds_by_brand_and_companies();
        $this->it_finds_by_brand_id();
        $this->it_finds_by_company_id();
    }

    public function its_instantiable()
    {
        /** @var DomainRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Domain::class);

        $this->assertInstanceOf(
            DomainRepository::class,
            $repository
        );
    }

    public function it_finds_one_by_domain()
    {
        /** @var DomainRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Domain::class);

        $Domain = $repository->findOneByDomain('users.ivozprovider.local');

        $this->assertInstanceOf(
            Domain::class,
            $Domain
        );
    }

    public function it_finds_by_company()
    {
        /** @var DomainRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Domain::class);

        $domain = $repository->findByCompanyId(1);

        $this->assertInstanceOf(
            Domain::class,
            $domain
        );
    }

    public function it_finds_by_brand_and_companies()
    {
        /** @var DomainRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Domain::class);

        $domain = $repository->findByBrandId(1);

        $this->assertNotEmpty(
            $domain
        );

        $this->assertInstanceOf(
            Domain::class,
            $domain[0]
        );
    }

    public function it_finds_by_brand_id()
    {
        /** @var DomainRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Domain::class);

        $domain = $repository->findByBrandId(1);

        $this->assertNotEmpty(
            $domain
        );

        $this->assertInstanceOf(
            Domain::class,
            $domain[0]
        );
    }

    public function it_finds_by_company_id()
    {
        /** @var DomainRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Domain::class);

        $domain = $repository->findByCompanyId(1);

        $this->assertInstanceOf(
            Domain::class,
            $domain
        );
    }
}
