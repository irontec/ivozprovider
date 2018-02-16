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
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(Queue::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstanceWithPublicMethods(Queue::class);
        $item1->setName("b1c1q1_testQueue");
        $item1->setPeriodicAnnounce("/opt/irontec/ivozprovider/storage/ivozprovider_model_locutions.encodedfile/0/1.");
        $item1->setPeriodicAnnounceFrequency(7);
        $item1->setTimeout(1);
        $item1->setWrapuptime(0);
        $item1->setMaxlen(5);
        $item1->setStrategy("rrmemory");
        $item1->setWeight(5);
        $item1->setQueue($this->getReference('_reference_IvozProviderDomainModelQueueQueue1'));
        $this->addReference('_reference_IvozAstDomainModelQueueQueue1', $item1);
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
