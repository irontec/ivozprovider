<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\FeaturesRelBrand\FeaturesRelBrand;

class ProviderFeaturesRelBrand extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(FeaturesRelBrand::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstance(FeaturesRelBrand::class);
        $item1->setBrand($this->getReference('_reference_ProviderBrand1'));
        $item1->setFeature($this->getReference('_reference_ProviderFeature1'));
        $this->addReference('_reference_ProviderFeaturesRelBrandFeaturesRelBrand1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstance(FeaturesRelBrand::class);
        $item2->setBrand($this->getReference('_reference_ProviderBrand1'));
        $item2->setFeature($this->getReference('_reference_ProviderFeature2'));
        $this->addReference('_reference_ProviderFeaturesRelBrandFeaturesRelBrand2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        $item3 = $this->createEntityInstance(FeaturesRelBrand::class);
        $item3->setBrand($this->getReference('_reference_ProviderBrand1'));
        $item3->setFeature($this->getReference('_reference_ProviderFeature3'));
        $this->addReference('_reference_ProviderFeaturesRelBrandFeaturesRelBrand3', $item3);
        $this->sanitizeEntityValues($item3);
        $manager->persist($item3);

        $item4 = $this->createEntityInstance(FeaturesRelBrand::class);
        $item4->setBrand($this->getReference('_reference_ProviderBrand1'));
        $item4->setFeature($this->getReference('_reference_ProviderFeature4'));
        $this->addReference('_reference_ProviderFeaturesRelBrandFeaturesRelBrand4', $item4);
        $this->sanitizeEntityValues($item4);
        $manager->persist($item4);

        $item5 = $this->createEntityInstance(FeaturesRelBrand::class);
        $item5->setBrand($this->getReference('_reference_ProviderBrand1'));
        $item5->setFeature($this->getReference('_reference_ProviderFeature5'));
        $this->addReference('_reference_ProviderFeaturesRelBrandFeaturesRelBrand5', $item5);
        $this->sanitizeEntityValues($item5);
        $manager->persist($item5);

        $item6 = $this->createEntityInstance(FeaturesRelBrand::class);
        $item6->setBrand($this->getReference('_reference_ProviderBrand1'));
        $item6->setFeature($this->getReference('_reference_ProviderFeature6'));
        $this->addReference('_reference_ProviderFeaturesRelBrandFeaturesRelBrand6', $item6);
        $this->sanitizeEntityValues($item6);
        $manager->persist($item6);

        $item7 = $this->createEntityInstance(FeaturesRelBrand::class);
        $item7->setBrand($this->getReference('_reference_ProviderBrand1'));
        $item7->setFeature($this->getReference('_reference_ProviderFeature7'));
        $this->addReference('_reference_ProviderFeaturesRelBrandFeaturesRelBrand7', $item7);
        $this->sanitizeEntityValues($item7);
        $manager->persist($item7);

    
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderBrand::class,
            ProviderFeature::class
        );
    }
}
