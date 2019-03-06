<?php

namespace Tests\Provider\DdiProviderRegistration;

use Ivoz\Kam\Domain\Model\TrunksUacreg\TrunksUacreg;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistration;
use Ivoz\Provider\Domain\Model\DdiProviderRegistration\DdiProviderRegistrationDto;

class DdiProviderRegistrationLifeCycleTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @return DdiProviderRegistrationDto
     */
    protected function createDto()
    {
        $ddiProviderRegistrationDto = new DdiProviderRegistrationDto();
        $ddiProviderRegistrationDto
            ->setUsername('testUserName')
            ->setDomain('testDomain.net')
            ->setRealm('testRealm')
            ->setAuthUsername('testAuthUsername')
            ->setAuthPassword('testAuthPassword')
            ->setAuthProxy('sip:testAuthProxy')
            ->setExpires(1)
            ->setContactUsername('testContactUsername')
            ->setDdiProviderId(1);

        return $ddiProviderRegistrationDto;
    }

    /**
     * @return DdiProviderRegistration
     */
    protected function addDdiProviderRegistration()
    {
        $ddiProviderRegistrationDto = $this->createDto();

        /** @var DdiProviderRegistration $ddiProviderRegistration */
        $ddiProviderRegistration = $this->entityTools
            ->persistDto($ddiProviderRegistrationDto, null, true);

        return $ddiProviderRegistration;
    }

    protected function updateDdiProviderRegistration()
    {
        $ddiProviderRegistrationRepository = $this->em
            ->getRepository(DdiProviderRegistration::class);

        $ddiProviderRegistration = $ddiProviderRegistrationRepository->find(1);

        /** @var DdiProviderRegistrationDto $ddiProviderRegistrationDto */
        $ddiProviderRegistrationDto = $this->entityTools->entityToDto($ddiProviderRegistration);

        $ddiProviderRegistrationDto
            ->setUsername('UpdatedUsername');

        return $this
            ->entityTools
            ->persistDto($ddiProviderRegistrationDto, $ddiProviderRegistration, true);
    }

    protected function removeDdiProviderRegistration()
    {
        $ddiProviderRegistrationRepository = $this->em
            ->getRepository(DdiProviderRegistration::class);

        $ddiProviderRegistration = $ddiProviderRegistrationRepository->find(1);

        $this
            ->entityTools
            ->remove($ddiProviderRegistration);
    }

    /**
     * @test
     */
    public function it_persists_ddiProviderRegistrations()
    {
        $ddiProviderRegistration = $this->em
            ->getRepository(DdiProviderRegistration::class);
        $fixtureDdiProviderRegistrations = $ddiProviderRegistration->findAll();

        $this->addDdiProviderRegistration();

        $brands = $ddiProviderRegistration->findAll();
        $this->assertCount(count($fixtureDdiProviderRegistrations) + 1, $brands);
    }

    /**
     * @test
     */
    public function it_triggers_lifecycle_services()
    {
        $this->addDdiProviderRegistration();
        $this->assetChangedEntities([
            DdiProviderRegistration::class,
            TrunksUacreg::class,
        ]);
    }

    /**
     * @test
     */
    public function it_triggers_update_lifecycle_services()
    {
        $this->updateDdiProviderRegistration();
        $this->assetChangedEntities([
            DdiProviderRegistration::class,
            TrunksUacreg::class,
        ]);
    }

    /**
     * @test
     */
    public function it_triggers_remove_lifecycle_services()
    {
        $this->removeDdiProviderRegistration();
        $this->assetChangedEntities([
            DdiProviderRegistration::class
        ]);
    }

    ////////////////////////////////////////////////
    ///
    ////////////////////////////////////////////////

    /**
     * @test
     * @deprecated
     */
    public function added_ddiProviderRegistration_has_trunksUacregs()
    {
        $this->addDdiProviderRegistration();

        /** @var Changelog[] $changelogEntries */
        $changelogEntries = $this->getChangelogByClass(
            TrunksUacreg::class
        );

        $this->assertCount(1, $changelogEntries);
        $changelog = $changelogEntries[0];

        $diff = $changelog->getData();
        $expectedSubset = [
            'l_uuid' => 'testContactUsername',
            'l_username' => 'unused',
            'l_domain' => 'unused',
            'r_username' => 'testUserName',
            'r_domain' => 'testDomain.net',
            'realm' => 'testRealm',
            'auth_username' => 'testAuthUsername',
            'auth_password' => '****',
            'auth_proxy' => 'sip:testAuthProxy',
            'expires' => 1,
            'ddiProviderRegistrationId' => 2,
            'brandId' => 1,
            'id' => 2,
            'auth_ha1' => '',
            'flags' => 0,
            'reg_delay' => 0.
        ];

        $this->assertEquals(
            $expectedSubset,
            $diff
        );
    }
}
