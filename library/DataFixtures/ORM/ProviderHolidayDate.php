<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
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
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(HolidayDate::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var HolidayDate $item1 */
        $item1 = $this->createEntityInstance(HolidayDate::class);
        (function () {
            $this->setName("Name");
            $this->setEventDate(new \DateTime("2021-12-21 00:00:00", new \DateTimeZone('UTC')));
        })->call($item1);

        $item1->setCalendar($this->getReference('_reference_ProviderCalendar1'));
        $this->addReference('_reference_ProviderHolidayDateHolidayDate1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

    
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderCalendar::class
        );
    }
}
