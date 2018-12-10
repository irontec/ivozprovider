<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\Invoice\Invoice;
use Ivoz\Provider\Domain\Model\Invoice\Pdf;

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
        $item1 = $this->createEntityInstance(Invoice::class);
        (function () {
            $this->setNumber('1');
            $this->setInDate(new \DateTime('2018-01-01', new \DateTimeZone('UTC')));
            $this->setOutDate(new \DateTime('2018-01-31', new \DateTimeZone('UTC')));
            $this->setTotal(0.272);
            $this->setTaxRate(21.0);
            $this->setTotalWithTax(0.330);
            $this->setStatus('processing');
            $this->setPdf(new Pdf(null, null, null));
        })->call($item1);

        $item1->setBrand(
            $this->getReference('_reference_ProviderBrand1')
        );
        $item1->setCompany(
            $this->getReference('_reference_ProviderCompany1')
        );
        $item1->setInvoiceTemplate(
            $this->getReference('_reference_ProviderInvoiceTemplate1')
        );

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
