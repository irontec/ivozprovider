<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\Schedule\Schedule;

class ProviderSchedule extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;


    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(Schedule::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstance(Schedule::class);
        (function () use ($fixture) {
            $this->setName("aSchedule");
            $this->setTimeIn(
                \DateTime::createFromFormat(
                    'H:i:s',
                    '08:00:00',
                    new \DateTimeZone('UTC')
                )
            );
            $this->setTimeout(
                \DateTime::createFromFormat(
                    'H:i:s',
                    "16:00:00",
                    new \DateTimeZone('UTC')
                )
            );
            $this->setMonday(true);
            $this->setTuesday(true);
            $this->setWednesday(true);
            $this->setThursday(true);
            $this->setFriday(true);
            $this->setSaturday(false);
            $this->setSunday(false);
            $this->setCompany($fixture->getReference('_reference_ProviderCompany1'));
        })->call($item1);

        $this->addReference('_reference_ProviderSchedule1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstance(Schedule::class);
        (function () use ($fixture) {
            $this->setName("anotherSchedule");
            $this->setTimeIn(
                \DateTime::createFromFormat(
                    'H:i:s',
                    '08:00:00',
                    new \DateTimeZone('UTC')
                )
            );
            $this->setTimeout(
                \DateTime::createFromFormat(
                    'H:i:s',
                    "16:00:00",
                    new \DateTimeZone('UTC')
                )
            );
            $this->setMonday(true);
            $this->setWednesday(true);
            $this->setTuesday(true);
            $this->setThursday(true);
            $this->setFriday(true);
            $this->setSaturday(false);
            $this->setSunday(false);
            $this->setCompany($fixture->getReference('_reference_ProviderCompany1'));
        })->call($item2);

        $this->addReference('_reference_ProviderSchedule2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);
    
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderCompany::class
        );
    }
}
