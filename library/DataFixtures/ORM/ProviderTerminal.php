<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\Terminal\Terminal;

class ProviderTerminal extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(Terminal::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $item1 = $this->createEntityInstance(Terminal::class);
        (function () {
            $this->setName("alice");
            $this->setDirectMediaMethod("invite");
            $this->setPassword("AUfVkn498_");
            $this->setMac("");
        })->call($item1);

        $item1->setCompany($this->getReference('_reference_ProviderCompany1'));
        $item1->setDomain($this->getReference('_reference_ProviderDomain3'));
        $item1->setTerminalModel($this->getReference('_reference_ProviderTerminalModel1'));
        $this->addReference('_reference_ProviderTerminal1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstance(Terminal::class);
        (function () {
            $this->setName("bob");
            $this->setDirectMediaMethod("invite");
            $this->setPassword("fLgQYa6-57");
            $this->setMac("");
        })->call($item2);

        $item2->setCompany($this->getReference('_reference_ProviderCompany1'));
        $item2->setDomain($this->getReference('_reference_ProviderDomain3'));
        $item2->setTerminalModel($this->getReference('_reference_ProviderTerminalModel1'));
        $this->addReference('_reference_ProviderTerminal2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        $item3 = $this->createEntityInstance(Terminal::class);
        (function () {
            $this->setName("testTerminal");
            $this->setDirectMediaMethod("invite");
            $this->setPassword("fLgQYa6-56");
            $this->setMac("0011223344aa");
        })->call($item3);
        $item3->setCompany($this->getReference('_reference_ProviderCompany1'));
        $item3->setDomain($this->getReference('_reference_ProviderDomain3'));
        $item3->setTerminalModel($this->getReference('_reference_ProviderTerminalModel1'));
        $this->addReference('_reference_ProviderTerminal3', $item3);
        $manager->persist($item3);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderCompany::class,
            ProviderDomain::class,
            ProviderTerminalModel::class
        );
    }
}
