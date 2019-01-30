<?php

namespace Tests\Provider\DestinationRateGroup;

use Ivoz\Cgr\Domain\Model\TpDestinationRateGroup\TpDestinationRateGroup;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroup;
use Ivoz\Provider\Domain\Model\DestinationRateGroup\DestinationRateGroupDto;

class DestinationRateGroupLifeCycleTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @return DestinationRateGroupDto
     */
    protected function createDto()
    {
        $ddiProviderRegistrationDto = new DestinationRateGroupDto();
        $ddiProviderRegistrationDto
            ->setStatus('waiting')
            ->setNameEs('nameEs')
            ->setNameEn('nameEn')
            ->setDescriptionEs('descriptionEs')
            ->setDescriptionEn('descriptionEn')
            ->setBrandId(1);

        return $ddiProviderRegistrationDto;
    }

    /**
     * @return DestinationRateGroup
     */
    protected function addDestinationRateGroup()
    {
        $ddiProviderRegistrationDto = $this->createDto();

        /** @var DestinationRateGroup $ddiProviderRegistration */
        $ddiProviderRegistration = $this->entityTools
            ->persistDto($ddiProviderRegistrationDto, null, true);

        return $ddiProviderRegistration;
    }


    protected function updateDestinationRateGroup()
    {
        $destinationRateGroupRepository = $this->em
            ->getRepository(DestinationRateGroup::class);

        $destinationRateGroup = $destinationRateGroupRepository->find(1);

        /** @var DestinationRateGroupDto $destinationRateGroupDto */
        $destinationRateGroupDto = $this->entityTools->entityToDto($destinationRateGroup);

        $destinationRateGroupDto
            ->setNameEs('updatedNameEs');

        return $this
            ->entityTools
            ->persistDto($destinationRateGroupDto, $destinationRateGroup, true);
    }

    protected function removeDestinationRateGroup()
    {
        $destinationRateGroupRepository = $this->em
            ->getRepository(DestinationRateGroup::class);

        $destinationRateGroup = $destinationRateGroupRepository->find(1);

        $this
            ->entityTools
            ->remove($destinationRateGroup);
    }

    /**
     * @test
     */
    public function it_persists_destinationRateGroups()
    {
        $ddiProviderRegistration = $this->em
            ->getRepository(DestinationRateGroup::class);
        $fixtureDestinationRateGroups = $ddiProviderRegistration->findAll();

        $this->addDestinationRateGroup();

        $brands = $ddiProviderRegistration->findAll();
        $this->assertCount(count($fixtureDestinationRateGroups) + 1, $brands);
    }

    /**
     * @test
     */
    public function it_triggers_lifecycle_services()
    {
        $this->addDestinationRateGroup();
        $this->assetChangedEntities([
            DestinationRateGroup::class
        ]);
    }

    /**
     * @test
     */
    public function it_triggers_update_lifecycle_services()
    {
        $this->updateDestinationRateGroup();
        $this->assetChangedEntities([
            DestinationRateGroup::class
        ]);
    }

    /**
     * @test
     */
    public function it_triggers_remove_lifecycle_services()
    {
        $this->removeDestinationRateGroup();
        $this->assetChangedEntities([
            DestinationRateGroup::class
        ]);
    }
}
