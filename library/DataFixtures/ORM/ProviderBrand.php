<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Brand\Logo;
use Ivoz\Provider\Domain\Model\Brand\Invoice;

class ProviderBrand extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(Brand::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstanceWithPublicMethods(Brand::class);
        $item1->setName("DemoBrand");
        $item1->setDomainUsers("");
        $item1->setFromName("");
        $item1->setFromAddress("");
        $item1->setRecordingsLimitEmail("");
        $item1->setLogo(new Logo(null, null, null));
        $item1->setInvoice(new Invoice('', '', '', '', '', '', ''));
        $item1->setDomain($this->getReference('_reference_ProviderDomain6'));
        $item1->setLanguage($this->getReference('_reference_ProviderLanguage1'));
        $item1->setDefaultTimezone($this->getReference('_reference_ProviderTimezone145'));
        $this->addReference('_reference_ProviderBrand1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstanceWithPublicMethods(Brand::class);
        $item2->setName("Irontec_e2e");
        $item2->setDomainUsers("sip.irontec.com");
        $item2->setLogo(new Logo(null, null, null));
        $item2->setInvoice(new Invoice('', '', '', '', '', '', ''));
        $item2->setDomain($this->getReference('_reference_ProviderDomain4'));
        $item2->setLanguage($this->getReference('_reference_ProviderLanguage1'));
        $item2->setDefaultTimezone($this->getReference('_reference_ProviderTimezone145'));
        $this->addReference('_reference_ProviderBrand2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

    
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderDomain::class,
            ProviderLanguage::class,
            ProviderTimezone::class
        );
    }
}
