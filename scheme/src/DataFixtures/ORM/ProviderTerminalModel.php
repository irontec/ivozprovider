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
        $manager->getClassMetadata(TerminalModel::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstanceWithPublicMethods(TerminalModel::class);
        $item1->setIden("Generic");
        $item1->setName("Generic SIP Model");
        $item1->setDescription("Generic SIP Model");
        $item1->setGenericTemplate("");
        $item1->setSpecificTemplate("");
        $item1->setGenericUrlPattern("");
        $item1->setSpecificUrlPattern("");
        $item1->setTerminalManufacturer($this->getReference('_reference_IvozProviderDomainModelTerminalManufacturerTerminalManufacturer1'));
        $this->addReference('_reference_IvozProviderDomainModelTerminalModelTerminalModel1', $item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstanceWithPublicMethods(TerminalModel::class);
        $item2->setIden("YealinkT21P_E2");
        $item2->setName("YealinkT21P_E2");
        $item2->setGenericUrlPattern("y000000000052.cfg");
        $item2->setSpecificUrlPattern("{mac}");
        $item2->setTerminalManufacturer($this->getReference('_reference_IvozProviderDomainModelTerminalManufacturerTerminalManufacturer2'));
        $this->addReference('_reference_IvozProviderDomainModelTerminalModelTerminalModel2', $item2);
        $manager->persist($item2);

        $item3 = $this->createEntityInstanceWithPublicMethods(TerminalModel::class);
        $item3->setIden("SPA502G");
        $item3->setName("SPA502G");
        $item3->setGenericUrlPattern("spa502G.cfg");
        $item3->setSpecificUrlPattern("{mac}");
        $item3->setTerminalManufacturer($this->getReference('_reference_IvozProviderDomainModelTerminalManufacturerTerminalManufacturer3'));
        $this->addReference('_reference_IvozProviderDomainModelTerminalModelTerminalModel3', $item3);
        $manager->persist($item3);

        $item4 = $this->createEntityInstanceWithPublicMethods(TerminalModel::class);
        $item4->setIden("YealinkT21P");
        $item4->setName("YealinkT21P");
        $item4->setGenericUrlPattern("y000000000034.cfg");
        $item4->setSpecificUrlPattern("{mac}");
        $item4->setTerminalManufacturer($this->getReference('_reference_IvozProviderDomainModelTerminalManufacturerTerminalManufacturer2'));
        $this->addReference('_reference_IvozProviderDomainModelTerminalModelTerminalModel4', $item4);
        $manager->persist($item4);

        $item5 = $this->createEntityInstanceWithPublicMethods(TerminalModel::class);
        $item5->setIden("YealinkT27P");
        $item5->setName("YealinkT27P");
        $item5->setGenericUrlPattern("y000000000045.cfg");
        $item5->setSpecificUrlPattern("{mac}");
        $item5->setTerminalManufacturer($this->getReference('_reference_IvozProviderDomainModelTerminalManufacturerTerminalManufacturer2'));
        $this->addReference('_reference_IvozProviderDomainModelTerminalModelTerminalModel5', $item5);
        $manager->persist($item5);

        $item6 = $this->createEntityInstanceWithPublicMethods(TerminalModel::class);
        $item6->setIden("SPA504G");
        $item6->setName("SPA504G");
        $item6->setGenericUrlPattern("spa504G.cfg");
        $item6->setSpecificUrlPattern("{mac}");
        $item6->setTerminalManufacturer($this->getReference('_reference_IvozProviderDomainModelTerminalManufacturerTerminalManufacturer3'));
        $this->addReference('_reference_IvozProviderDomainModelTerminalModelTerminalModel6', $item6);
        $manager->persist($item6);

        $item7 = $this->createEntityInstanceWithPublicMethods(TerminalModel::class);
        $item7->setIden("SPA509G");
        $item7->setName("SPA509G");
        $item7->setGenericUrlPattern("spa509G.cfg");
        $item7->setSpecificUrlPattern("{mac}");
        $item7->setTerminalManufacturer($this->getReference('_reference_IvozProviderDomainModelTerminalManufacturerTerminalManufacturer3'));
        $this->addReference('_reference_IvozProviderDomainModelTerminalModelTerminalModel7', $item7);
        $manager->persist($item7);

        $item8 = $this->createEntityInstanceWithPublicMethods(TerminalModel::class);
        $item8->setIden("SPA525G2");
        $item8->setName("SPA525G2");
        $item8->setGenericUrlPattern("spa525G2.cfg");
        $item8->setSpecificUrlPattern("{mac}");
        $item8->setTerminalManufacturer($this->getReference('_reference_IvozProviderDomainModelTerminalManufacturerTerminalManufacturer3'));
        $this->addReference('_reference_IvozProviderDomainModelTerminalModelTerminalModel8', $item8);
        $manager->persist($item8);

        $item9 = $this->createEntityInstanceWithPublicMethods(TerminalModel::class);
        $item9->setIden("SPA514G");
        $item9->setName("SPA514G");
        $item9->setGenericUrlPattern("spa514G.cfg");
        $item9->setSpecificUrlPattern("{mac}");
        $item9->setTerminalManufacturer($this->getReference('_reference_IvozProviderDomainModelTerminalManufacturerTerminalManufacturer3'));
        $this->addReference('_reference_IvozProviderDomainModelTerminalModelTerminalModel9', $item9);
        $manager->persist($item9);

        $item10 = $this->createEntityInstanceWithPublicMethods(TerminalModel::class);
        $item10->setIden("YealinkT46G");
        $item10->setName("YealinkT46G");
        $item10->setGenericUrlPattern("y000000000028.cfg");
        $item10->setSpecificUrlPattern("{mac}");
        $item10->setTerminalManufacturer($this->getReference('_reference_IvozProviderDomainModelTerminalManufacturerTerminalManufacturer2'));
        $this->addReference('_reference_IvozProviderDomainModelTerminalModelTerminalModel10', $item10);
        $manager->persist($item10);

        $item11 = $this->createEntityInstanceWithPublicMethods(TerminalModel::class);
        $item11->setIden("YealinkT48G");
        $item11->setName("YealinkT48G");
        $item11->setGenericUrlPattern("y000000000035.cfg");
        $item11->setSpecificUrlPattern("{mac}");
        $item11->setTerminalManufacturer($this->getReference('_reference_IvozProviderDomainModelTerminalManufacturerTerminalManufacturer2'));
        $this->addReference('_reference_IvozProviderDomainModelTerminalModelTerminalModel11', $item11);
        $manager->persist($item11);

        $item12 = $this->createEntityInstanceWithPublicMethods(TerminalModel::class);
        $item12->setIden("YealinkT23P");
        $item12->setName("YealinkT23P");
        $item12->setGenericUrlPattern("y000000000044.cfg");
        $item12->setSpecificUrlPattern("{mac}");
        $item12->setTerminalManufacturer($this->getReference('_reference_IvozProviderDomainModelTerminalManufacturerTerminalManufacturer2'));
        $this->addReference('_reference_IvozProviderDomainModelTerminalModelTerminalModel12', $item12);
        $manager->persist($item12);

        $item13 = $this->createEntityInstanceWithPublicMethods(TerminalModel::class);
        $item13->setIden("YealinkW5XP");
        $item13->setName("Yealink W5XP");
        $item13->setGenericUrlPattern("y000000000025.cfg");
        $item13->setSpecificUrlPattern("{mac}");
        $item13->setTerminalManufacturer($this->getReference('_reference_IvozProviderDomainModelTerminalManufacturerTerminalManufacturer2'));
        $this->addReference('_reference_IvozProviderDomainModelTerminalModelTerminalModel13', $item13);
        $manager->persist($item13);

        $item14 = $this->createEntityInstanceWithPublicMethods(TerminalModel::class);
        $item14->setIden("Test");
        $item14->setName("Test SIP Model");
        $item14->setDescription("Test SIP Model");
        $item14->setGenericTemplate("");
        $item14->setSpecificTemplate("");
        $item14->setGenericUrlPattern("");
        $item14->setSpecificUrlPattern("");
        $item14->setTerminalManufacturer($this->getReference('_reference_IvozProviderDomainModelTerminalManufacturerTerminalManufacturer1'));
        $this->addReference('_reference_IvozProviderDomainModelTerminalModelTerminalModel14', $item14);
        $manager->persist($item14);

    
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderTerminalManufacturer::class
        );
    }
}
