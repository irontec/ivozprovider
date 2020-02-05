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
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(RoutingPatternGroupsRelPattern::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item6310 = $this->createEntityInstance(RoutingPatternGroupsRelPattern::class);
        (function () use ($fixture) {
            $this->setRoutingPattern($fixture->getReference('_reference_ProviderRoutingPatternRoutingPattern68'));
            $this->setRoutingPatternGroup($fixture->getReference('_reference_ProviderRoutingPatternGroup7'));
        })->call($item6310);
        $this->addReference('_reference_ProviderRoutingPatternGroupsRelPatternRoutingPatternGroupsRelPattern6310', $item6310);
        $this->sanitizeEntityValues($item6310);
        $manager->persist($item6310);

        $item6330 = $this->createEntityInstance(RoutingPatternGroupsRelPattern::class);
        (function () use ($fixture) {
            $this->setRoutingPattern($fixture->getReference('_reference_ProviderRoutingPatternRoutingPattern68'));
            $this->setRoutingPatternGroup($fixture->getReference('_reference_ProviderRoutingPatternGroup21'));
        })->call($item6330);
        $this->addReference('_reference_ProviderRoutingPatternGroupsRelPatternRoutingPatternGroupsRelPattern6330', $item6330);
        $this->sanitizeEntityValues($item6330);
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
