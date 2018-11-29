<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\Service\Service;
use Ivoz\Provider\Domain\Model\Service\Name;
use Ivoz\Provider\Domain\Model\Service\Description;

class ProviderService extends Fixture
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(Service::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstance(Service::class);
        (function () {
            $this->setIden("DirectPickUp");
            $this->setDefaultCode("94");
            $this->setExtraArgs(true);
            $this->setName(new Name('en', 'en'));
            $this->setDescription(new Description('en', 'en'));
        })->call($item1);

        $this->addReference('_reference_ProviderService1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstance(Service::class);
        (function () {
            $this->setIden("GroupPickUp");
            $this->setDefaultCode("95");
            $this->setExtraArgs(false);
            $this->setName(new Name('en', 'en'));
            $this->setDescription(new Description('en', 'en'));
        })->call($item2);

        $this->addReference('_reference_ProviderService2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        $item3 = $this->createEntityInstance(Service::class);
        (function () {
            $this->setIden("Voicemail");
            $this->setDefaultCode("93");
            $this->setExtraArgs(true);
            $this->setName(new Name('en', 'en'));
            $this->setDescription(new Description('en', 'en'));
        })->call($item3);

        $this->addReference('_reference_ProviderService3', $item3);
        $this->sanitizeEntityValues($item3);
        $manager->persist($item3);

        $item4 = $this->createEntityInstance(Service::class);
        (function () {
            $this->setIden("RecordLocution");
            $this->setDefaultCode("00");
            $this->setExtraArgs(true);
            $this->setName(new Name('en', 'en'));
            $this->setDescription(new Description('en', 'en'));
        })->call($item4);

        $this->addReference('_reference_ProviderService4', $item4);
        $this->sanitizeEntityValues($item4);
        $manager->persist($item4);

        $manager->flush();
    }
}
