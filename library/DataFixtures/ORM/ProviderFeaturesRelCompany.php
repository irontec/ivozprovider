<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\FeaturesRelCompany\FeaturesRelCompany;

class ProviderFeaturesRelCompany extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(FeaturesRelCompany::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstanceWithPublicMethods(FeaturesRelCompany::class);
        $item1->setCompany($this->getReference('_reference_IvozProviderDomainModelCompanyCompany1'));
        $item1->setFeature($this->getReference('_reference_IvozProviderDomainModelFeatureFeature1'));
        $this->addReference('_reference_IvozProviderDomainModelFeaturesRelCompanyFeaturesRelCompany1', $item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstanceWithPublicMethods(FeaturesRelCompany::class);
        $item2->setCompany($this->getReference('_reference_IvozProviderDomainModelCompanyCompany1'));
        $item2->setFeature($this->getReference('_reference_IvozProviderDomainModelFeatureFeature2'));
        $this->addReference('_reference_IvozProviderDomainModelFeaturesRelCompanyFeaturesRelCompany2', $item2);
        $manager->persist($item2);

        $item3 = $this->createEntityInstanceWithPublicMethods(FeaturesRelCompany::class);
        $item3->setCompany($this->getReference('_reference_IvozProviderDomainModelCompanyCompany1'));
        $item3->setFeature($this->getReference('_reference_IvozProviderDomainModelFeatureFeature3'));
        $this->addReference('_reference_IvozProviderDomainModelFeaturesRelCompanyFeaturesRelCompany3', $item3);
        $manager->persist($item3);

        $item4 = $this->createEntityInstanceWithPublicMethods(FeaturesRelCompany::class);
        $item4->setCompany($this->getReference('_reference_IvozProviderDomainModelCompanyCompany1'));
        $item4->setFeature($this->getReference('_reference_IvozProviderDomainModelFeatureFeature4'));
        $this->addReference('_reference_IvozProviderDomainModelFeaturesRelCompanyFeaturesRelCompany4', $item4);
        $manager->persist($item4);

        $item5 = $this->createEntityInstanceWithPublicMethods(FeaturesRelCompany::class);
        $item5->setCompany($this->getReference('_reference_IvozProviderDomainModelCompanyCompany1'));
        $item5->setFeature($this->getReference('_reference_IvozProviderDomainModelFeatureFeature5'));
        $this->addReference('_reference_IvozProviderDomainModelFeaturesRelCompanyFeaturesRelCompany5', $item5);
        $manager->persist($item5);

    
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderCompany::class,
            ProviderFeature::class
        );
    }
}
