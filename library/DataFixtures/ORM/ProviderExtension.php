<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\Extension\Extension;

class ProviderExtension extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(Extension::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstanceWithPublicMethods(Extension::class);
        $item1->setNumber("101");
        $item1->setRouteType("user");
        $item1->setCompany($this->getReference('_reference_IvozProviderDomainModelCompanyCompany1'));
        $item1->setUser($this->getReference('_reference_IvozProviderDomainModelUserUser1'));
        $item1->setNumberCountry($this->getReference('_reference_IvozProviderDomainModelCountryCountry70'));
        $this->addReference('_reference_IvozProviderDomainModelExtensionExtension1', $item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstanceWithPublicMethods(Extension::class);
        $item2->setNumber("102");
        $item2->setRouteType("user");
        $item2->setCompany($this->getReference('_reference_IvozProviderDomainModelCompanyCompany1'));
        $item2->setUser($this->getReference('_reference_IvozProviderDomainModelUserUser2'));
        $item2->setNumberCountry($this->getReference('_reference_IvozProviderDomainModelCountryCountry70'));
        $this->addReference('_reference_IvozProviderDomainModelExtensionExtension2', $item2);
        $manager->persist($item2);

        $item3 = $this->createEntityInstanceWithPublicMethods(Extension::class);
        $item3->setNumber("12346");
        $item3->setRouteType("number");
        $item3->setNumberValue("946006060");
        $item3->setCompany($this->getReference('_reference_IvozProviderDomainModelCompanyCompany1'));
        $item3->setNumberCountry($this->getReference('_reference_IvozProviderDomainModelCountryCountry70'));
        $this->addReference('_reference_IvozProviderDomainModelExtensionExtension3', $item3);
        $manager->persist($item3);

    
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderCountry::class,
            ProviderCompany::class,
            ProviderUser::class
        );
    }
}
