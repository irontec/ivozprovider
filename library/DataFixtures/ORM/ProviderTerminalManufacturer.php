<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\TerminalManufacturer\TerminalManufacturer;

class ProviderTerminalManufacturer extends Fixture
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(TerminalManufacturer::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstance(TerminalManufacturer::class);
        (function () use ($fixture) {
            $this->setIden("Generic");
            $this->setName("Generic SIP Manufacturer");
            $this->setDescription("Generic SIP Manufacturer");
        })->call($item1);

        $this->addReference('_reference_ProviderTerminalManufacturerTerminalManufacturer1', $item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstance(TerminalManufacturer::class);
        (function () use ($fixture) {
            $this->setIden("Yealink");
            $this->setName("Yealink");
        })->call($item2);

        $this->addReference('_reference_ProviderTerminalManufacturerTerminalManufacturer2', $item2);
        $manager->persist($item2);

        $item3 = $this->createEntityInstance(TerminalManufacturer::class);
        (function () use ($fixture) {
            $this->setIden("Cisco");
            $this->setName("Cisco");
        })->call($item3);

        $this->addReference('_reference_ProviderTerminalManufacturerTerminalManufacturer3', $item3);
        $manager->persist($item3);

        $item4 = $this->createEntityInstance(TerminalManufacturer::class);
        (function () use ($fixture) {
            $this->setIden("Test");
            $this->setName("Test SIP Manufacturer");
            $this->setDescription("Test SIP Manufacturer");
        })->call($item4);

        $this->addReference('_reference_ProviderTerminalManufacturerTerminalManufacturer4', $item4);
        $manager->persist($item4);

    
        $manager->flush();
    }
}
