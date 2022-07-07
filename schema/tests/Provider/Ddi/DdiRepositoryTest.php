<?php

namespace Tests\Provider\Ddi;

use Ivoz\Provider\Domain\Model\Ddi\DdiRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\Ddi\Ddi;

class DdiRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function test_runner()
    {
        $this->its_instantiable();
        $this->it_finds_one_by_ddi_e164();
        $this->it_finds_one_by_ddi_and_country();
        $this->it_counts_by_company();
        $this->it_counts_by_company_and_country();
        $this->it_counts_by_company_and_not_country();
    }

    public function its_instantiable()
    {
        /** @var DdiRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Ddi::class);

        $this->assertInstanceOf(
            DdiRepository::class,
            $repository
        );
    }

    public function it_finds_one_by_ddi_e164()
    {
        /** @var DdiRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Ddi::class);

        $ddi = $repository->findOneByDdiE164('+34123');

        $this->assertInstanceOf(
            Ddi::class,
            $ddi
        );
    }

    public function it_finds_one_by_ddi_and_country()
    {
        /** @var DdiRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Ddi::class);

        $ddi = $repository->findOneByDdiAndCountry('123', 68);

        $this->assertInstanceOf(
            Ddi::class,
            $ddi
        );
    }

    public function it_counts_by_company()
    {
        /** @var DdiRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Ddi::class);

        $num = $repository->countByCompany(1);

        $this->assertInternalType(
            'int',
            $num
        );
    }

    public function it_counts_by_company_and_country()
    {
        /** @var DdiRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Ddi::class);

        $num = $repository->countByCompanyAndCountry(1, 68);

        $this->assertInternalType(
            'int',
            $num
        );
    }

    public function it_counts_by_company_and_not_country()
    {
        /** @var DdiRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Ddi::class);

        $num = $repository->countByCompanyAndNotCountry(1, 68);

        $this->assertInternalType(
            'int',
            $num
        );
    }
}
