<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\Invoice\Invoice;

class ProviderInvoice extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(Invoice::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var Invoice $item1 */
        $item1 = $this->createEntityInstanceWithPublicMethods(Invoice::class);
        $item1->setBrand(
            $this->getReference('_reference_ProviderBrand1')
        );
        $item1->setCompany(
            $this->getReference('_reference_ProviderCompany1')
        );
        $item1->setInvoiceTemplate(
            $this->getReference('_reference_ProviderInvoiceTemplate1')
        );
        $item1->setNumber('1');
        $item1->setInDate(new \DateTime('2018-01-01'));
        $item1->setOutDate(new \DateTime('2018-01-31'));
        $item1->setTotal(0.272);
        $item1->setTaxRate(21.0);
        $item1->setTotalWithTax(0.330);
        $item1->setStatus('processing');

        $this->addReference('_reference_ProviderInvoice1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderBrand::class,
            ProviderCompany::class
        );
    }
}
