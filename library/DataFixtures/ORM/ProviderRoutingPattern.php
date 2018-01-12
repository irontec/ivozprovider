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

        $item68 = $this->createEntityInstanceWithPublicMethods(RoutingPattern::class);
        $item68->setRegExp("+34");
        $item68->setName(new Name('en', 'es'));
        $item68->setDescription(new Description('en', 'es'));
        $item68->setBrand($this->getReference('_reference_IvozProviderDomainModelBrandBrand1'));
        $this->addReference('_reference_IvozProviderDomainModelRoutingPatternRoutingPattern68', $item68);
        $manager->persist($item68);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderBrand::class
        );
    }
}
