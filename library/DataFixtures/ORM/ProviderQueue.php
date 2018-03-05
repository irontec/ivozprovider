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
    
        $item1 = $this->createEntityInstanceWithPublicMethods(Queue::class);
        $item1->setName("testQueue");
        $item1->setMaxWaitTime(20);
        $item1->setTimeoutTargetType("number");
        $item1->setTimeoutNumberValue("946002020");
        $item1->setMaxlen(5);
        $item1->setFullTargetType("number");
        $item1->setFullNumberValue("946002021");
        $item1->setPeriodicAnnounceFrequency(7);
        $item1->setMemberCallRest(0);
        $item1->setMemberCallTimeout(1);
        $item1->setStrategy("rrmemory");
        $item1->setWeight(5);
        $item1->setCompany($this->getReference('_reference_ProviderCompany1'));
        $item1->setPeriodicAnnounceLocution($this->getReference('_reference_ProviderLocution1'));
        $item1->setTimeoutLocution($this->getReference('_reference_ProviderLocution1'));
        $item1->setFullLocution($this->getReference('_reference_ProviderLocution1'));
        $item1->setTimeoutNumberCountry($this->getReference('_reference_ProviderCountry70'));
        $item1->setFullNumberCountry($this->getReference('_reference_ProviderCountry70'));
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
