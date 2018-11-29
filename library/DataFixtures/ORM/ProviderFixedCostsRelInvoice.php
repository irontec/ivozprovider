<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\FixedCostsRelInvoice\FixedCostsRelInvoice;

class ProviderFixedCostsRelInvoice extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(FixedCostsRelInvoice::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var FixedCostsRelInvoice $item1 */
        $item1 = $this->createEntityInstance(FixedCostsRelInvoice::class);
        (function () {
            $this->setQuantity(1);
        })->call($item1);

        $item1->setFixedCost(
            $this->getReference('_reference_ProviderFixedCost1')
        );
        $item1->setInvoice(
            $this->getReference('_reference_ProviderInvoice1')
        );

        $this->addReference('_reference_ProviderFixedCostsRelInvoice1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderBrand::class,
            ProviderFixedCost::class,
            ProviderInvoice::class
        );
    }
}
