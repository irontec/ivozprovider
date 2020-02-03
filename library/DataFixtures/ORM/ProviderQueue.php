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
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(Queue::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $item1 = $this->createEntityInstance(Queue::class);
        (function () use ($fixture) {
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
            $this->setCompany($fixture->getReference('_reference_ProviderCompany1'));
            $this->setPeriodicAnnounceLocution($fixture->getReference('_reference_ProviderLocution1'));
            $this->setTimeoutLocution($fixture->getReference('_reference_ProviderLocution1'));
            $this->setFullLocution($fixture->getReference('_reference_ProviderLocution1'));
            $this->setTimeoutNumberCountry($fixture->getReference('_reference_ProviderCountry70'));
            $this->setFullNumberCountry($fixture->getReference('_reference_ProviderCountry70'));
        })->call($item1);

        $this->sanitizeEntityValues($item1);
        $this->addReference('_reference_ProviderQueue1', $item1);

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
