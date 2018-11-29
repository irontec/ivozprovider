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
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(ConditionalRoutesCondition::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstance(ConditionalRoutesCondition::class);
        (function () {
            $this->setPriority(1);
            $this->setNumberValue("");
            $this->setFriendValue("");
        })->call($item1);

        $item1->setConditionalRoute($this->getReference('_reference_ProviderConditionalRouteConditionalRoute1'));
        $item1->setNumberCountry($this->getReference('_reference_ProviderCountry70'));
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
