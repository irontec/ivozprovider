<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\Friend\Friend;

class ProviderFriend extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(Friend::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $item1 = $this->createEntityInstance(Friend::class);
        (function () use ($fixture) {
            $this->setName("testFriend");
            $this->setDirectConnectivity("yes");
            $this->setTransport("udp");
            $this->setIp("1.2.3.4");
            $this->setPort('5060');
            $this->setPassword("SDG3qd2j6+");
            $this->setPriority(1);
            $this->setFromDomain("");
            $this->setCompany($fixture->getReference('_reference_ProviderCompany1'));
        })->call($item1);

        $this->addReference('_reference_ProviderFriend1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstance(Friend::class);
        (function () use ($fixture) {
            $this->setName("testFriend2");
            $this->setDirectConnectivity("intervpbx");
            $this->setPriority(2);
            $this->setCompany($fixture->getReference('_reference_ProviderCompany2'));
            $this->setInterCompany($fixture->getReference('_reference_ProviderCompany1'));
        })->call($item2);

        $this->addReference('_reference_ProviderFriend2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderCompany::class,
            ProviderDomain::class
        );
    }
}
