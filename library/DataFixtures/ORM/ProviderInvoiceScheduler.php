<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\InvoiceScheduler\InvoiceScheduler;

class ProviderInvoiceScheduler extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager
            ->getClassMetadata(InvoiceScheduler::class)
            ->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $item1 = $this->createEntityInstance(InvoiceScheduler::class);
        (function () use ($fixture) {
            $this->setName('SchedulerName');
            $this->setUnit('week');
            $this->setFrequency(1);
            $this->setEmail('something@domain.net');
            $this->setLastExecution(new \DateTime('2018-12-01 08:00:00'));
            $this->setLastExecutionError('');
            $this->setNextExecution('2018-12-02 08:00:00');
            $this->setBrand(
                $fixture->getReference('_reference_ProviderBrand1')
            );
            $this->setCompany(
                $fixture->getReference('_reference_ProviderCompany1')
            );
        })->call($item1);

        $this->addReference('_reference_ProviderInvoiceScheduler1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderCompany::class
        );
    }
}
