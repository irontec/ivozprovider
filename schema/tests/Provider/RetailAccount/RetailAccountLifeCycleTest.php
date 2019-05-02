<?php

namespace Tests\Provider\RetailAccount;

use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpoint;
use Ivoz\Ast\Domain\Model\Voicemail\Voicemail;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountDto;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccount;

class RetailAccountLifeCycleTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @return RetailAccountDto
     */
    protected function createDto()
    {
        $retailAccountDto = new RetailAccountDto();
        $retailAccountDto
            ->setName('someRetailAccount')
            ->setTransport('udp')
            ->setDirectConnectivity('yes')
            ->setBrandId(1)
            ->setCompanyId(1);

        return $retailAccountDto;
    }

    /**
     * @return RetailAccount
     */
    protected function addRetailAccount()
    {
        $retailAccountDto = $this->createDto();

        /** @var RetailAccount $retailAccount */
        $retailAccount = $this->entityTools
            ->persistDto($retailAccountDto, null, true);

        return $retailAccount;
    }


    protected function updateRetailAccount()
    {
        $retailAccountRepository = $this->em
            ->getRepository(RetailAccount::class);

        $retailAccount = $retailAccountRepository->find(1);

        /** @var RetailAccountDto $retailAccountDto */
        $retailAccountDto = $this->entityTools->entityToDto($retailAccount);

        $retailAccountDto
            ->setDirectConnectivity('no');

        return $this
            ->entityTools
            ->persistDto($retailAccountDto, $retailAccount, true);
    }

    protected function removeRetailAccount()
    {
        $retailAccountRepository = $this->em
            ->getRepository(RetailAccount::class);

        $retailAccount = $retailAccountRepository->find(1);

        $this
            ->entityTools
            ->remove($retailAccount);
    }

    /**
     * @test
     */
    public function it_persists_RetailAccounts()
    {
        $retailAccount = $this->em
            ->getRepository(RetailAccount::class);
        $fixtureRetailAccounts = $retailAccount->findAll();

        $this->addRetailAccount();

        $brands = $retailAccount->findAll();
        $this->assertCount(count($fixtureRetailAccounts) + 1, $brands);
    }

    /**
     * @test
     */
    public function it_triggers_lifecycle_services()
    {
        $this->addRetailAccount();
        $this->assetChangedEntities([
            RetailAccount::class,
            PsEndpoint::class
        ]);
    }

    /**
     * @test
     */
    public function it_triggers_update_lifecycle_services()
    {
        $this->updateRetailAccount();
        $this->assetChangedEntities([
            RetailAccount::class,
            PsEndpoint::class
        ]);
    }

    /**
     * @test
     */
    public function it_triggers_remove_lifecycle_services()
    {
        $this->removeRetailAccount();
        $this->assetChangedEntities([
            RetailAccount::class,
        ]);
    }
}
