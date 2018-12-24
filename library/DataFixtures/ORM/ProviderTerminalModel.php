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

        $item1 = $this->createEntityInstance(TerminalModel::class);
        (function () {
            $this->setIden("Generic");
            $this->setName("Generic SIP Model");
            $this->setDescription("Generic SIP Model");
            $this->setGenericTemplate("");
            $this->setSpecificTemplate("");
            $this->setGenericUrlPattern("");
            $this->setSpecificUrlPattern("");
        })->call($item1);

        $item1->setTerminalManufacturer($this->getReference('_reference_ProviderTerminalManufacturerTerminalManufacturer1'));
        $this->addReference('_reference_ProviderTerminalModel1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstance(TerminalModel::class);
        (function () {
            $this->setIden("YealinkT21P_E2");
            $this->setName("YealinkT21P_E2");
            $this->setGenericUrlPattern("y000000000052.cfg");
            $this->setSpecificUrlPattern("{mac}");
        })->call($item2);

        $item2->setTerminalManufacturer($this->getReference('_reference_ProviderTerminalManufacturerTerminalManufacturer2'));
        $this->addReference('_reference_ProviderTerminalModel2', $item2);
        $this->sanitizeEntityValues($item2);
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
