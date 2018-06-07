<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPattern;
use Ivoz\Provider\Domain\Model\RoutingPattern\Name;
use Ivoz\Provider\Domain\Model\RoutingPattern\Description;

class ProviderRoutingPattern extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(RoutingPattern::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $item1 = $this->createEntityInstanceWithPublicMethods(RoutingPattern::class);
        $item1->setPrefix("+34");
        $item1->setName(new Name('en', 'es'));
        $item1->setDescription(new Description('en', 'es'));
        $item1->setBrand($this->getReference('_reference_ProviderBrand1'));
        $this->addReference('_reference_ProviderRoutingPatternRoutingPattern68', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);


        $item2 = $this->createEntityInstanceWithPublicMethods(RoutingPattern::class);
        $item2->setPrefix("+35");
        $item2->setName(new Name('en', 'es'));
        $item2->setDescription(new Description('en', 'es'));
        $item2->setBrand($this->getReference('_reference_ProviderBrand1'));
        $this->addReference('_reference_ProviderRoutingPatternRoutingPattern2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderBrand::class
        );
    }
}
