<?php

namespace Tests\Provider\RetailAccount;

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
}
