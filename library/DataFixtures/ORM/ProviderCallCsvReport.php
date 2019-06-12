<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\CallCsvReport\CallCsvReport;

class ProviderCallCsvReport extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager
            ->getClassMetadata(CallCsvReport::class)
            ->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $item1 = $this->createEntityInstance(CallCsvReport::class);
        (function () {
            $this->setSentTo('');
            $this->setInDate('2019-05-31 00:00:00');
            $this->setOutDate('2019-05-31 23:59:59');
            $this->setCreatedOn('2019-06-01 05:59:59');
        })->call($item1);

        $item1->setBrand(
            $this->getReference('_reference_ProviderBrand1')
        );
        $item1->setCallCsvScheduler(
            $this->getReference('_reference_ProviderCallCsvScheduler1')
        );

        $this->addReference('_reference_ProviderCallCsvReport1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstance(CallCsvReport::class);
        (function () {
            $this->setSentTo('');
            $this->setInDate('2019-05-31 00:00:00');
            $this->setOutDate('2019-05-31 23:59:59');
            $this->setCreatedOn('2019-06-01 05:59:59');
        })->call($item2);

        $item2->setCompany(
            $this->getReference('_reference_ProviderCompany1')
        );
        $item2->setCallCsvScheduler(
            $this->getReference('_reference_ProviderCallCsvScheduler2')
        );

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
