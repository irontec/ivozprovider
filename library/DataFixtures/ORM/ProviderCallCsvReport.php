<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\CallCsvReport\CallCsvReport;
use Ivoz\Provider\Domain\Model\CallCsvReport\Csv;

class ProviderCallCsvReport extends Fixture implements DependentFixtureInterface
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
            ->getClassMetadata(CallCsvReport::class)
            ->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $item1 = $this->createEntityInstance(CallCsvReport::class);
        (function () use ($fixture) {
            $this->setSentTo('');
            $this->inDate = new \DateTime('2019-05-31 00:00:00');
            $this->outDate = new \DateTime('2019-05-31 23:59:59');
            $this->createdOn = new \DateTime('2019-06-01 05:59:59');

            $this->setBrand(
                $fixture->getReference('_reference_ProviderBrand1')
            );
            $this->setCallCsvScheduler(
                $fixture->getReference('_reference_ProviderCallCsvScheduler1')
            );
            $this->csv = new Csv(null, null, null);
        })->call($item1);

        $this->addReference('_reference_ProviderCallCsvReport1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstance(CallCsvReport::class);
        (function () use ($fixture) {
            $this->setSentTo('');
            $this->inDate = new \DateTime('2019-05-31 00:00:00');
            $this->outDate = new \DateTime('2019-05-31 23:59:59');
            $this->createdOn = new \DateTime('2019-06-01 05:59:59');

            $this->setCompany(
                $fixture->getReference('_reference_ProviderCompany1')
            );
            $this->setCallCsvScheduler(
                $fixture->getReference('_reference_ProviderCallCsvScheduler2')
            );
            $this->csv = new Csv(null, null, null);
        })->call($item2);

        $this->addReference('_reference_ProviderCallCsvReport2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProviderCallCsvScheduler::class
        ];
    }
}
