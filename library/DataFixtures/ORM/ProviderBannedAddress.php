<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\BannedAddress\BannedAddress;
use Ivoz\Provider\Domain\Model\BannedAddress\BannedAddressInterface;

class ProviderBannedAddress extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(BannedAddress::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstance(BannedAddress::class);
        (function () use ($fixture) {
            $this->setIp("8.8.8.8");
            $this->setLastTimeBanned("2020-03-10 10:00:00");
            $this->setBlocker(BannedAddressInterface::BLOCKER_ANTIFLOOD);
            $this->setAor('aor');
        })->call($item1);

        $this->addReference('_reference_ProviderBannedAddress1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstance(BannedAddress::class);
        (function () use ($fixture) {
            $this->setIp("8.8.8.8");
            $this->setLastTimeBanned("2020-03-10 10:00:00");
            $this->setBlocker(BannedAddressInterface::BLOCKER_IPFILTER);
            $this->setAor('aor');
            $this->setBrand(
                $fixture->getReference('_reference_ProviderBrand1')
            );
            $this->setCompany(
                $fixture->getReference('_reference_ProviderCompany1')
            );
        })->call($item2);

        $this->addReference('_reference_ProviderBannedAddress2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        $item3 = $this->createEntityInstance(BannedAddress::class);
        (function () use ($fixture) {
            $this->setIp("8.8.8.9");
            $this->setLastTimeBanned("2020-03-10 10:00:00");
            $this->setBlocker(BannedAddressInterface::BLOCKER_ANTIBRUTEFORCE);
            $this->setAor('aor');
            $this->setBrand(
                $fixture->getReference('_reference_ProviderBrand1')
            );
            $this->setCompany(
                $fixture->getReference('_reference_ProviderCompany1')
            );
        })->call($item3);

        $this->addReference('_reference_ProviderBannedAddress3', $item3);
        $this->sanitizeEntityValues($item3);
        $manager->persist($item3);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProviderCompany::class,
        ];
    }
}
