<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRoute;

class ProviderConditionalRoute extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(ConditionalRoute::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $item1 = $this->createEntityInstance(ConditionalRoute::class);
        (function () use ($fixture) {
            $this->setName("testConditional");
            $this->setRoutetype("user");
            $this->setNumbervalue("");
            $this->setFriendvalue("");
            $this->setCompany($fixture->getReference('_reference_ProviderCompany1'));
            $this->setUser($fixture->getReference('_reference_ProviderUser1'));
            $this->setNumberCountry($fixture->getReference('_reference_ProviderCountry70'));
        })->call($item1);

        $this->addReference('_reference_ProviderConditionalRouteConditionalRoute1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstance(ConditionalRoute::class);
        (function () use ($fixture) {
            $this->setName("testConditional2");
            $this->setRoutetype("user");
            $this->setNumbervalue("");
            $this->setFriendvalue("");
            $this->setCompany($fixture->getReference('_reference_ProviderCompany1'));
            $this->setUser($fixture->getReference('_reference_ProviderUser2'));
            $this->setNumberCountry($fixture->getReference('_reference_ProviderCountry70'));
        })->call($item2);

        $this->addReference('_reference_ProviderConditionalRouteConditionalRoute2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderCompany::class,
            ProviderUser::class,
            ProviderCountry::class
        );
    }
}
