<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
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
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(Schedule::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstanceWithPublicMethods(Schedule::class);
        $item1->setName("aSchedule");
        $item1->setTimeIn(new \DateTime("1970-01-01 08:00:00"));
        $item1->setTimeout(new \DateTime("1970-01-01 16:00:00"));
        $item1->setMonday(true);
        $item1->setTuesday(true);
        $item1->setWednesday(true);
        $item1->setThursday(true);
        $item1->setFriday(true);
        $item1->setSaturday(false);
        $item1->setSunday(false);
        $item1->setCompany($this->getReference('_reference_ProviderCompany1'));
        $this->addReference('_reference_ProviderSchedule1', $item1);
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
