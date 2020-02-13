<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\FixedCostsRelInvoiceScheduler\FixedCostsRelInvoiceScheduler;

class ProviderFixedCostsRelInvoiceScheduler extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(FixedCostsRelInvoiceScheduler::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var FixedCostsRelInvoiceScheduler $item1 */
        $item1 = $this->createEntityInstance(FixedCostsRelInvoiceScheduler::class);
        (function () use ($fixture) {
            $this->setQuantity(1);
            $this->setFixedCost(
                $fixture->getReference('_reference_ProviderFixedCost1')
            );
            $this->setInvoiceScheduler(
                $fixture->getReference('_reference_ProviderInvoiceScheduler1')
            );
        })->call($item1);

        $this->addReference('_reference_ProviderFixedCostsRelInvoiceScheduler1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderFixedCost::class,
            ProviderInvoiceScheduler::class
        );
    }
}
