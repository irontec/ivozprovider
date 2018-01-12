<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\TargetPattern\TargetPattern;
use Ivoz\Provider\Domain\Model\TargetPattern\Name;
use Ivoz\Provider\Domain\Model\TargetPattern\Description;

class ProviderTargetPattern extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(TargetPattern::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstanceWithPublicMethods(TargetPattern::class);
        $item1->setRegExp("+633");
        $item1->setName(new Name('en', 'es'));
        $item1->setDescription(new Description('en', 'es'));
        $item1->setBrand($this->getReference('_reference_IvozProviderDomainModelBrandBrand1'));
        $this->addReference('_reference_IvozProviderDomainModelTargetPatternTargetPattern1', $item1);
        $manager->persist($item1);

    
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderBrand::class
        );
    }
}
