<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\TerminalModel\TerminalModel;

class ProviderTerminalModel extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(TerminalModel::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstanceWithPublicMethods(TerminalModel::class);
        $item1->setIden("Generic");
        $item1->setName("Generic SIP Model");
        $item1->setDescription("Generic SIP Model");
        $item1->setGenericTemplate("");
        $item1->setSpecificTemplate("");
        $item1->setGenericUrlPattern("");
        $item1->setSpecificUrlPattern("");
        $item1->setTerminalManufacturer($this->getReference('_reference_ProviderTerminalManufacturerTerminalManufacturer1'));
        $this->addReference('_reference_ProviderTerminalModel1', $item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstanceWithPublicMethods(TerminalModel::class);
        $item2->setIden("YealinkT21P_E2");
        $item2->setName("YealinkT21P_E2");
        $item2->setGenericUrlPattern("y000000000052.cfg");
        $item2->setSpecificUrlPattern("{mac}");
        $item2->setTerminalManufacturer($this->getReference('_reference_ProviderTerminalManufacturerTerminalManufacturer2'));
        $this->addReference('_reference_ProviderTerminalModel2', $item2);
        $manager->persist($item2);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderTerminalManufacturer::class
        );
    }
}
