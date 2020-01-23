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
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(FixedCostsRelInvoice::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var FixedCostsRelInvoice $item1 */
        $item1 = $this->createEntityInstance(FixedCostsRelInvoice::class);
        (function () use ($fixture) {
            $this->setQuantity(1);
            $this->setFixedCost(
                $fixture->getReference('_reference_ProviderFixedCost1')
            );
            $this->setInvoice(
                $fixture->getReference('_reference_ProviderInvoice1')
            );
        })->call($item1);

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
