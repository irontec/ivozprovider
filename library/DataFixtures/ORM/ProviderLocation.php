<?php

namespace DataFixtures\ORM;

use DataFixtures\Stub\Provider\LocationStub;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\Location\Location;
use Ivoz\Provider\Domain\Model\Location\EncodedFile;
use Ivoz\Provider\Domain\Model\Location\OriginalFile;

class ProviderLocation extends Fixture
{
    use \DataFixtures\FixtureHelperTrait;

    public function __construct(
        private LocationStub $locationStub,
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(Location::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $manager
            ->getClassMetadata(Location::class)
            ->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $entities = $this->locationStub->getAll();
        foreach ($entities as $entity) {
            $this->addReference(
                '_reference_ProviderLocation' . $entity->getId(),
                $entity
            );
            $manager->persist($entity);
        }

        $manager->flush();
    }
}
