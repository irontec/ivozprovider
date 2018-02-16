<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPattern;

class ProviderRoutingPatternGroupsRelPattern extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(RoutingPatternGroupsRelPattern::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item6310 = $this->createEntityInstanceWithPublicMethods(RoutingPatternGroupsRelPattern::class);
        $item6310->setRoutingPattern($this->getReference('_reference_IvozProviderDomainModelRoutingPatternRoutingPattern68'));
        $item6310->setRoutingPatternGroup($this->getReference('_reference_IvozProviderDomainModelRoutingPatternGroupRoutingPatternGroup7'));
        $this->addReference('_reference_IvozProviderDomainModelRoutingPatternGroupsRelPatternRoutingPatternGroupsRelPattern6310', $item6310);
        $manager->persist($item6310);

        $item6330 = $this->createEntityInstanceWithPublicMethods(RoutingPatternGroupsRelPattern::class);
        $item6330->setRoutingPattern($this->getReference('_reference_IvozProviderDomainModelRoutingPatternRoutingPattern68'));
        $item6330->setRoutingPatternGroup($this->getReference('_reference_IvozProviderDomainModelRoutingPatternGroupRoutingPatternGroup21'));
        $this->addReference('_reference_IvozProviderDomainModelRoutingPatternGroupsRelPatternRoutingPatternGroupsRelPattern6330', $item6330);
        $manager->persist($item6330);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderRoutingPattern::class,
            ProviderRoutingPatternGroup::class
        );
    }
}
