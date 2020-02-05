<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\InvoiceNumberSequence\InvoiceNumberSequence;

class ProviderInvoiceNumberSequence extends Fixture implements DependentFixtureInterface
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
            ->getClassMetadata(InvoiceNumberSequence::class)
            ->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var InvoiceNumberSequence $item1 */
        $item1 = $this->createEntityInstance(
            InvoiceNumberSequence::class
        );
        (function () use ($fixture) {
            $this->setName('GeneratorName');
            $this->setPrefix('auto');
            $this->setSequenceLength(4);
            $this->setIncrement(1);
            $this->setLatestValue('auto0001');
            $this->setIteration(1);
            $this->setVersion(1);
            $this->setBrand(
                $fixture->getReference('_reference_ProviderBrand1')
            );
        })->call($item1);

        $this->addReference('_reference_ProviderInvoiceNumberSequence1', $item1);
        $this->sanitizeEntityValues($item1);
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
