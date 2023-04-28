<?php

namespace DataFixtures\ORM;

use DataFixtures\Stub\Ast\QueueMemberStub;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Ast\Domain\Model\QueueMember\QueueMember;

class AstQueueMember extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    public function __construct(
        private QueueMemberStub $queueMemberStub
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(QueueMember::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $entities = $this->queueMemberStub->getAll();
        foreach ($entities as $entity) {
            $this->addReference(
                '_reference_AstQueueMember' . $entity->getId(),
                $entity
            );
            $manager->persist($entity);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderQueueMember::class,
        );
    }
}
