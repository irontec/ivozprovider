<?php

namespace DataFixtures\ORM;

use DataFixtures\Stub\Provider\RecordingStub;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\Recording\Recording;

class ProviderRecording extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    public function __construct(
        private RecordingStub $recordingStub,
    ) {
    }
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(Recording::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $entities = $this->recordingStub->getAll();

        foreach ($entities as $entity) {
            $this->addReference(
                '_reference_Recording' . $entity->getId(),
                $entity
            );
            $manager->persist($entity);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderCompany::class
        );
    }
}
