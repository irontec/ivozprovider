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
        $this->disableLifecycleEvents($manager);
        $manager
            ->getClassMetadata(InvoiceNumberSequence::class)
            ->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var InvoiceNumberSequence $item1 */
        $item1 = $this->createEntityInstanceWithPublicMethods(
            InvoiceNumberSequence::class
        );
        $item1->setBrand(
            $this->getReference('_reference_ProviderBrand1')
        );

        $item1->setIden('GeneratorName');
        $item1->setPrefix('auto');
        $item1->setSequenceLength(4);
        $item1->setIncrement(1);
        $item1->setLatestValue('auto0001');
        $item1->setIteration(1);
        $item1->setVersion(1);

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
