<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\Queue\Queue;

class ProviderQueue extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(Queue::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $item1 = $this->createEntityInstance(Queue::class);
        (function () {
            $this->setName("testQueue");
            $this->setMaxWaitTime(20);
            $this->setTimeoutTargetType("number");
            $this->setTimeoutNumberValue("946002020");
            $this->setMaxlen(5);
            $this->setFullTargetType("number");
            $this->setFullNumberValue("946002021");
            $this->setPeriodicAnnounceFrequency(7);
            $this->setMemberCallRest(0);
            $this->setMemberCallTimeout(1);
            $this->setStrategy("rrmemory");
            $this->setWeight(5);
        })->call($item1);

        $item1->setCompany($this->getReference('_reference_ProviderCompany1'));
        $item1->setPeriodicAnnounceLocution($this->getReference('_reference_ProviderLocution1'));
        $item1->setTimeoutLocution($this->getReference('_reference_ProviderLocution1'));
        $item1->setFullLocution($this->getReference('_reference_ProviderLocution1'));
        $item1->setTimeoutNumberCountry($this->getReference('_reference_ProviderCountry70'));
        $item1->setFullNumberCountry($this->getReference('_reference_ProviderCountry70'));
        $this->addReference('_reference_ProviderQueue1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

    
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderCompany::class,
            ProviderLocution::class,
            ProviderCountry::class
        );
    }
}
