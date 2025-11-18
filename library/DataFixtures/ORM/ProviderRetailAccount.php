<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccount;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface;

class ProviderRetailAccount extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(RetailAccount::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var RetailAccount $item1 */
        $item1 = $this->createEntityInstance(RetailAccount::class);
        (function () use ($fixture) {
            $this->setName('testRetailAccount');
            $this->setTransport('udp');
            $this->setIp('1.2.3.4');
            $this->setPort(1024);
            $this->setDirectConnectivity('no');
            $this->setPassword('9rv6G3TVc-');
            $this->setBrand(
                $fixture->getReference('_reference_ProviderBrand1')
            );
            $this->setCompany(
                $fixture->getReference('_reference_ProviderCompany3')
            );
        })->call($item1);

        $this->addReference('_reference_ProviderRetailAccount1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        for ($i = 2; $i < 6; $i++) {
            /** @var RetailAccount $item */
            $item = $this->createEntityInstance(RetailAccount::class);
            (function () use ($fixture, $i) {
                $this->setName('testRetailAccount' . $i);
                $this->setTransport('udp');
                $this->setIp('1.2.3.' . $i);
                $this->setPort(1024);
                $this->setDirectConnectivity('no');
                $this->setPassword('9rv6G3TVc-');
                $this->setBrand(
                    $fixture->getReference('_reference_ProviderBrand1')
                );
                $this->setCompany(
                    $fixture->getReference('_reference_ProviderCompany3')
                );
            })->call($item);

            $this->addReference('_reference_ProviderRetailAccount' . $i, $item);
            $this->sanitizeEntityValues($item);
            $manager->persist($item);
        }

        /** @var RetailAccount $item6 */
        $item6 = $this->createEntityInstance(RetailAccount::class);
        (function () use ($fixture) {
            $this->setName('testRetailAccount6');
            $this->setTransport('udp');
            $this->setIp('1.2.3.4');
            $this->setPort(1024);
            $this->setDirectConnectivity('yes');
            $this->setPassword('9rv6G3TVc-');
            $this->setProxyUser(
                $fixture->getReference('_reference_ProviderProxyUserProxyUser1')
            );
            $this->setBrand(
                $fixture->getReference('_reference_ProviderBrand1')
            );
            $this->setCompany(
                $fixture->getReference('_reference_ProviderCompany3')
            );
        })->call($item6);

        $this->addReference('_reference_ProviderRetailAccount6', $item6);
        $this->sanitizeEntityValues($item6);
        $manager->persist($item6);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderBrand::class,
            ProviderDomain::class,
            ProviderCompany::class
        );
    }
}
