<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
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
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(TerminalManufacturer::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstanceWithPublicMethods(TerminalManufacturer::class);
        $item1->setIden("Generic");
        $item1->setName("Generic SIP Manufacturer");
        $item1->setDescription("Generic SIP Manufacturer");
        $this->addReference('_reference_ProviderTerminalManufacturerTerminalManufacturer1', $item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstanceWithPublicMethods(TerminalManufacturer::class);
        $item2->setIden("Yealink");
        $item2->setName("Yealink");
        $this->addReference('_reference_ProviderTerminalManufacturerTerminalManufacturer2', $item2);
        $manager->persist($item2);

        $item3 = $this->createEntityInstanceWithPublicMethods(TerminalManufacturer::class);
        $item3->setIden("Cisco");
        $item3->setName("Cisco");
        $this->addReference('_reference_ProviderTerminalManufacturerTerminalManufacturer3', $item3);
        $manager->persist($item3);

        $item4 = $this->createEntityInstanceWithPublicMethods(TerminalManufacturer::class);
        $item4->setIden("Test");
        $item4->setName("Test SIP Manufacturer");
        $item4->setDescription("Test SIP Manufacturer");
        $this->addReference('_reference_ProviderTerminalManufacturerTerminalManufacturer4', $item4);
        $manager->persist($item4);

    
        $manager->flush();
    }
}
