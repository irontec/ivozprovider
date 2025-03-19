<?php

namespace DataFixtures\ORM;

use DataFixtures\FixtureHelperTrait;
use DataFixtures\Stub\Provider\LocationStub;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\Location\Location;

class ProviderLocation extends Fixture
{
    use FixtureHelperTrait;

    public function __construct(
        private LocationStub $locationStub,
    ) {
    }
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(Location::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

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

    public function getDependencies()
    {
        return array(
            ProviderCompany::class
        );
    }
}
