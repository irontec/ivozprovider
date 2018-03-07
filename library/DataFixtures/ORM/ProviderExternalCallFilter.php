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
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(ExternalCallFilter::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstanceWithPublicMethods(ExternalCallFilter::class);
        $item1->setName("testFilter");
        $item1->setCompany($this->getReference('_reference_ProviderCompany1'));
        $item1->setHolidayNumberCountry($this->getReference('_reference_ProviderCountry70'));
        $item1->setOutOfScheduleNumberCountry($this->getReference('_reference_ProviderCountry70'));
        $this->addReference('_reference_ProviderExternalCallFilter1', $item1);
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
