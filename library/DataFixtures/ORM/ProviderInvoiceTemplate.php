<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
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
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(InvoiceTemplate::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $item1 = $this->createEntityInstance(InvoiceTemplate::class);
        (function () use ($fixture) {
            $this->setName("Default");
            $this->setDescription("Something");
            $this->setTemplate("Template");
            $this->setTemplateHeader("Template header");
            $this->setTemplateFooter("Template footer");
            $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
        })->call($item1);

        $this->addReference('_reference_ProviderInvoiceTemplate1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstance(InvoiceTemplate::class);
        (function () use ($fixture) {
            $this->setName("Generic");
            $this->setDescription("Generic invoice template");
            $this->setTemplate("Generic Template body");
            $this->setTemplateHeader("Generic Template header");
            $this->setTemplateFooter("Generic Template footer");
        })->call($item2);

        $this->addReference('_reference_ProviderInvoiceTemplate2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderBrand::class
        );
    }
}
