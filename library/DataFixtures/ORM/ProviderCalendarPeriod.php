<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\CalendarPeriod\CalendarPeriod;
use Ivoz\Provider\Domain\Model\CalendarPeriod\CalendarPeriodInterface;

class ProviderCalendarPeriod extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(CalendarPeriod::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var CalendarPeriodInterface $item1 */
        $item1 = $this->createEntityInstance(CalendarPeriod::class);
        (function () use ($fixture) {
            $utc = new \DateTimeZone('UTC');
            $start = new \DateTime(
                '2019-01-01',
                $utc
            );
            $end = new \DateTime(
                '2019-10-01',
                $utc
            );
            $this
                ->setStartDate($start)
                ->setEndDate($end)
                ->setRouteType(
                    CalendarPeriodInterface::ROUTETYPE_NUMBER
                )
                ->setNumberValue('911')
            ;
            $this->setCalendar(
                $fixture->getReference('_reference_ProviderCalendar1')
            );
            $this->setNumberCountry(
                $fixture->getReference('_reference_ProviderCountry1')
            );
        })->call($item1);

        $this->addReference('_reference_ProviderCalendarPeriod1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProviderCalendar::class,
            ProviderCountry::class,
        ];
    }
}
