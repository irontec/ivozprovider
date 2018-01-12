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
    
        $item1 = $this->createEntityInstanceWithPublicMethods(FeaturesRelBrand::class);
        $item1->setBrand($this->getReference('_reference_IvozProviderDomainModelBrandBrand1'));
        $item1->setFeature($this->getReference('_reference_IvozProviderDomainModelFeatureFeature1'));
        $this->addReference('_reference_IvozProviderDomainModelFeaturesRelBrandFeaturesRelBrand1', $item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstanceWithPublicMethods(FeaturesRelBrand::class);
        $item2->setBrand($this->getReference('_reference_IvozProviderDomainModelBrandBrand1'));
        $item2->setFeature($this->getReference('_reference_IvozProviderDomainModelFeatureFeature2'));
        $this->addReference('_reference_IvozProviderDomainModelFeaturesRelBrandFeaturesRelBrand2', $item2);
        $manager->persist($item2);

        $item3 = $this->createEntityInstanceWithPublicMethods(FeaturesRelBrand::class);
        $item3->setBrand($this->getReference('_reference_IvozProviderDomainModelBrandBrand1'));
        $item3->setFeature($this->getReference('_reference_IvozProviderDomainModelFeatureFeature3'));
        $this->addReference('_reference_IvozProviderDomainModelFeaturesRelBrandFeaturesRelBrand3', $item3);
        $manager->persist($item3);

        $item4 = $this->createEntityInstanceWithPublicMethods(FeaturesRelBrand::class);
        $item4->setBrand($this->getReference('_reference_IvozProviderDomainModelBrandBrand1'));
        $item4->setFeature($this->getReference('_reference_IvozProviderDomainModelFeatureFeature4'));
        $this->addReference('_reference_IvozProviderDomainModelFeaturesRelBrandFeaturesRelBrand4', $item4);
        $manager->persist($item4);

        $item5 = $this->createEntityInstanceWithPublicMethods(FeaturesRelBrand::class);
        $item5->setBrand($this->getReference('_reference_IvozProviderDomainModelBrandBrand1'));
        $item5->setFeature($this->getReference('_reference_IvozProviderDomainModelFeatureFeature5'));
        $this->addReference('_reference_IvozProviderDomainModelFeaturesRelBrandFeaturesRelBrand5', $item5);
        $manager->persist($item5);

        $item6 = $this->createEntityInstanceWithPublicMethods(FeaturesRelBrand::class);
        $item6->setBrand($this->getReference('_reference_IvozProviderDomainModelBrandBrand1'));
        $item6->setFeature($this->getReference('_reference_IvozProviderDomainModelFeatureFeature6'));
        $this->addReference('_reference_IvozProviderDomainModelFeaturesRelBrandFeaturesRelBrand6', $item6);
        $manager->persist($item6);

        $item7 = $this->createEntityInstanceWithPublicMethods(FeaturesRelBrand::class);
        $item7->setBrand($this->getReference('_reference_IvozProviderDomainModelBrandBrand1'));
        $item7->setFeature($this->getReference('_reference_IvozProviderDomainModelFeatureFeature7'));
        $this->addReference('_reference_IvozProviderDomainModelFeaturesRelBrandFeaturesRelBrand7', $item7);
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
