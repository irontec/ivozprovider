<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
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
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(TerminalModel::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $item1 = $this->createEntityInstance(TerminalModel::class);
        (function () use ($fixture) {
            $this->setIden("Generic");
            $this->setName("Generic SIP Model");
            $this->setDescription("Generic SIP Model");
            $this->setGenericTemplate("");
            $this->setSpecificTemplate("");
            $this->setGenericUrlPattern("");
            $this->setSpecificUrlPattern("");
            $this->setTerminalManufacturer($fixture->getReference('_reference_ProviderTerminalManufacturerTerminalManufacturer1'));
        })->call($item1);

        $this->addReference('_reference_ProviderTerminalModel1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstance(TerminalModel::class);
        (function () use ($fixture) {
            $this->setIden("YealinkT21P_E2");
            $this->setName("YealinkT21P_E2");
            $this->setDescription('');
            $this->setGenericUrlPattern("y000000000052.cfg");
            $this->setGenericTemplate(
                <<<TPL
                #!version:1.0.0.1
                account.1.enable = 1 
                account.1.label = Line 

                auto_provision.mode = 6 
                auto_provision.schedule.periodic_minute = 1 
                auto_provision.server.url = https://domain:1443/provision/t21E2
                auto_provision.dhcp_option.enable = 0
                auto_provision.pnp_enable = 0

                security.trust_certificates = 0
                TPL
            );
            $this->setSpecificUrlPattern("{mac}");
            $this->setTerminalManufacturer($fixture->getReference('_reference_ProviderTerminalManufacturerTerminalManufacturer2'));
        })->call($item2);

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
