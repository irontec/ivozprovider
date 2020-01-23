<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilter;

class ProviderExternalCallFilter extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(ExternalCallFilter::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstance(ExternalCallFilter::class);
        (function () use ($fixture) {
            $this->setName("testFilter");
            $this->setCompany($fixture->getReference('_reference_ProviderCompany1'));
            $this->setHolidayNumberCountry($fixture->getReference('_reference_ProviderCountry70'));
            $this->setOutOfScheduleNumberCountry($fixture->getReference('_reference_ProviderCountry70'));
        })->call($item1);

        $this->addReference('_reference_ProviderExternalCallFilter1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

    
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderCompany::class,
            ProviderCountry::class
        );
    }
}
