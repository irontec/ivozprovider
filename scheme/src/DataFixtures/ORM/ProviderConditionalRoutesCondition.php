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
        $manager->getClassMetadata(ConditionalRoutesCondition::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstanceWithPublicMethods(ConditionalRoutesCondition::class);
        $item1->setPriority(1);
        $item1->setNumberValue("");
        $item1->setFriendValue("");
        $item1->setConditionalRoute($this->getReference('_reference_IvozProviderDomainModelConditionalRouteConditionalRoute1'));
        $item1->setNumberCountry($this->getReference('_reference_IvozProviderDomainModelCountryCountry70'));
        $this->addReference('_reference_IvozProviderDomainModelConditionalRoutesConditionConditionalRoutesCondition1', $item1);
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
