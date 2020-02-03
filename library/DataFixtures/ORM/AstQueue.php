<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Ast\Domain\Model\Queue\Queue;

class AstQueue extends Fixture implements DependentFixtureInterface
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
            $this->setName("b1c1q1_testQueue");
            $this->setPeriodicAnnounce("/opt/irontec/ivozprovider/storage/ivozprovider_model_locutions.encodedfile/0/1.");
            $this->setPeriodicAnnounceFrequency(7);
            $this->setTimeout(1);
            $this->setWrapuptime(0);
            $this->setMaxlen(5);
            $this->setStrategy("rrmemory");
            $this->setWeight(5);
            $this->setQueue($fixture->getReference('_reference_ProviderQueue1'));
        })->call($item1);

        $this->addReference('_reference_AstQueue1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

    
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderQueue::class,
        );
    }
}
