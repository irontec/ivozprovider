<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\InvoiceTemplate\InvoiceTemplate;

class ProviderInvoiceTemplate extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $manager->getClassMetadata(InvoiceTemplate::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstanceWithPublicMethods(InvoiceTemplate::class);
        $item1->setName("Default");
        $item1->setDescription("Something");
        $item1->setTemplate("Template");
        $item1->setTemplateHeader("Template header");
        $item1->setTemplateFooter("Template footer");
        $item1->setBrand($this->getReference('_reference_IvozProviderDomainModelBrandBrand1'));
        $this->addReference('_reference_IvozProviderDomainModelInvoiceTemplateInvoiceTemplate1', $item1);
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
