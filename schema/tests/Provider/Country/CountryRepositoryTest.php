<?php

namespace Tests\Provider\Country;

use Ivoz\Provider\Domain\Model\Country\CountryRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\Country\Country;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;

class CountryRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function test_runner()
    {
        $this->its_instantiable();
        $this->it_finds_by_country_code();
        $this->it_finds_by_country_code_and_code();
    }

    public function its_instantiable()
    {
        /** @var CountryRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Country::class);

        $this->assertInstanceOf(
            CountryRepository::class,
            $repository
        );
    }

    public function it_finds_by_country_code()
    {
        /** @var CountryRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Country::class);

        $response = $repository->findOneByCountryCode(
            '+34'
        );

        $this->assertInstanceOf(
            CountryInterface::class,
            $response
        );
    }

    public function it_finds_by_country_code_and_code()
    {
        /** @var CountryRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Country::class);

        $canada = $repository->findOneByCountryCode(
            '+1',
            'CA'
        );

        $eeuu = $repository->findOneByCountryCode(
            '+1',
            'US'
        );

        $this->assertNotSame(
            $canada,
            $eeuu
        );
    }
}
