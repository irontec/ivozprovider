<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\Ddi\Ddi;

class ProviderDdi extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $manager->getClassMetadata(Ddi::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstanceWithPublicMethods(Ddi::class);
        $item1->setDdi("123");
        $item1->setDdie164("+34123");
        $item1->setDisplayName("");
        $item1->setBillInboundCalls(false);
        $item1->setFriendValue("");
        $item1->setCompany($this->getReference('_reference_IvozProviderDomainModelCompanyCompany1'));
        $item1->setBrand($this->getReference('_reference_IvozProviderDomainModelBrandBrand1'));
        $item1->setPeeringContract($this->getReference('_reference_IvozProviderDomainModelPeeringContractPeeringContract1'));
        $item1->setCountry($this->getReference('_reference_IvozProviderDomainModelCountryCountry70'));
        $this->addReference('_reference_IvozProviderDomainModelDdiDdi1', $item1);
        $manager->persist($item1);

    
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderCompany::class,
            ProviderBrand::class,
            ProviderPeeringContract::class,
            ProviderCountry::class
        );
    }
}
