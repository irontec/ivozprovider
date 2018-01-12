<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\PricingPlansRelCompany\PricingPlansRelCompany;

class ProviderPricingPlansRelCompany extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(PricingPlansRelCompany::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstanceWithPublicMethods(PricingPlansRelCompany::class);
        $item1->setValidFrom(new \DateTime("2017-01-08 23:00:00"));
        $item1->setValidTo(new \DateTime("2217-01-09 00:00:00"));
        $item1->setMetric(10);
        $item1->setPricingPlan($this->getReference('_reference_IvozProviderDomainModelPricingPlanPricingPlan1'));
        $item1->setCompany($this->getReference('_reference_IvozProviderDomainModelCompanyCompany1'));
        $item1->setBrand($this->getReference('_reference_IvozProviderDomainModelBrandBrand1'));
        $this->addReference('_reference_IvozProviderDomainModelPricingPlansRelCompanyPricingPlansRelCompany1', $item1);
        $manager->persist($item1);

    
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderBrand::class,
            ProviderCompany::class,
            ProviderPricingPlan::class
        );
    }
}
