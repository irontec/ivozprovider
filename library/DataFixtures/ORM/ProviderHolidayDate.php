<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\HolidayDate\HolidayDate;

class ProviderHolidayDate extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(HolidayDate::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var HolidayDate $item1 */
        $item1 = $this->createEntityInstance(HolidayDate::class);
        (function () use ($fixture) {
            $this->setName("Name");
            $this->eventDate = new \DateTime("2021-12-21 00:00:00", new \DateTimeZone('UTC'));
            $this->setCalendar($fixture->getReference('_reference_ProviderCalendar1'));
        })->call($item1);

        $this->addReference('_reference_ProviderHolidayDateHolidayDate1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);


        /** @var HolidayDate $item2 */
        $item2 = $this->createEntityInstance(HolidayDate::class);
        (function () use ($fixture) {
            $this->setName("timeRangeEvent");
            $this->setEventDate(
                new \DateTime("2021-12-21 00:00:00", new \DateTimeZone('UTC'))
            );
            $this->setWholeDayEvent(0);
            $this->setTimeIn(
                new \DateTime('00:00:00')
            );
            $this->setTimeOut(
                new \DateTime('10:00:00')
            );
            $this->setCalendar($fixture->getReference('_reference_ProviderCalendar1'));
        })->call($item2);

        $this->addReference('_reference_ProviderHolidayDateHolidayDate2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderCalendar::class
        );
    }
}
