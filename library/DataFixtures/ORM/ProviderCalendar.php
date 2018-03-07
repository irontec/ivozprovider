<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\Calendar\Calendar;

class ProviderCalendar extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(Calendar::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstanceWithPublicMethods(Calendar::class);
        $item1->setName("testCalendar");
        $item1->setCompany($this->getReference('_reference_ProviderCompany1'));
        $this->addReference('_reference_ProviderCalendar1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstanceWithPublicMethods(Calendar::class);
        $item2->setName("testCalendar2");
        $item2->setCompany($this->getReference('_reference_ProviderCompany1'));
        $this->addReference('_reference_ProviderCalendar2', $item2);
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
