<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\HuntGroupsRelUser\HuntGroupsRelUser;

class ProviderHuntGroupsRelUser extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(HuntGroupsRelUser::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $item1 = $this->createEntityInstance(HuntGroupsRelUser::class);
        (function () use ($fixture) {
            $this->setRouteType("user");
            $this->setTimeoutTime(1);
            $this->setPriority(1);
            $this->setHuntGroup($fixture->getReference('_reference_ProviderHuntGroup1'));
            $this->setUser($fixture->getReference('_reference_ProviderUser1'));
        })->call($item1);

        $this->addReference('_reference_ProviderHuntGroupsRelUser1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstance(HuntGroupsRelUser::class);
        (function () use ($fixture) {
            $this->setRouteType("number");
            $this->setTimeoutTime(1);
            $this->setPriority(2);
            $this->setHuntGroup($fixture->getReference('_reference_ProviderHuntGroup1'));
            $this->setNumberValue("946002050");
            $this->setNumberCountry($fixture->getReference('_reference_ProviderCountry70'));
        })->call($item2);

        $this->addReference('_reference_ProviderHuntGroupsRelUser2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderHuntGroup::class,
            ProviderUser::class
        );
    }
}
