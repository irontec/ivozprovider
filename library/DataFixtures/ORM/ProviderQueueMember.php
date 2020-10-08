<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\QueueMember\QueueMember;

class ProviderQueueMember extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(QueueMember::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstance(QueueMember::class);
        (function () use ($fixture) {
            $this->setPenalty(1);
            $this->setQueue($fixture->getReference('_reference_ProviderQueue1'));
            $this->setUser($fixture->getReference('_reference_ProviderUser1'));
        })->call($item1);


        $this->addReference('_reference_ProviderQueueMemberQueueMember1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

    
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderQueue::class,
            ProviderUser::class
        );
    }
}
