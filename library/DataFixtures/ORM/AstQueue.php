<?php

namespace DataFixtures\ORM;

use DataFixtures\Stub\Ast\QueueStub;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Ast\Domain\Model\Queue\Queue;

class AstQueue extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    private $queueStub;

    public function __construct(
        QueueStub $queueStub
    ) {
        $this->queueStub = $queueStub;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(Queue::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $entities = $this->queueStub->getAll();
        foreach ($entities as $entity) {
            $this->addReference(
                '_reference_AstQueue' . $entity->getId(),
                $entity
            );
            $manager->persist($entity);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderQueue::class,
        );
    }
}
