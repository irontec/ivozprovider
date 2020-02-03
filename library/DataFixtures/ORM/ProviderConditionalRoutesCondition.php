<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesCondition;

class ProviderConditionalRoutesCondition extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(ConditionalRoutesCondition::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstance(ConditionalRoutesCondition::class);
        (function () use ($fixture) {
            $this->setPriority(1);
            $this->setNumberValue("");
            $this->setFriendValue("");
            $this->setConditionalRoute($fixture->getReference('_reference_ProviderConditionalRouteConditionalRoute1'));
            $this->setNumberCountry($fixture->getReference('_reference_ProviderCountry70'));
        })->call($item1);

        $this->addReference('_reference_ProviderConditionalRoutesCondition1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

    
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderConditionalRoute::class,
            ProviderCountry::class
        );
    }
}
