<?php

namespace Tests\Provider\Currency;

use Ivoz\Provider\Domain\Model\Currency\CurrencyRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\Currency\Currency;
use Ivoz\Provider\Domain\Model\Currency\CurrencyInterface;

class CurrencyRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function its_instantiable()
    {
        /** @var CurrencyRepository $repository */
        $repository = $this
            ->em
            ->getRepository(Currency::class);

        $this->assertInstanceOf(
            CurrencyRepository::class,
            $repository
        );
    }
}
