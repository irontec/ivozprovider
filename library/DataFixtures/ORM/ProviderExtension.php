<?php

namespace DataFixtures\ORM;

use DataFixtures\FixtureHelperTrait;
use DataFixtures\Stub\Provider\ExtensionStub;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\Extension\Extension;

class ProviderExtension extends Fixture
{
    use FixtureHelperTrait;

    public function __construct(
        private ExtensionStub $extensionStub,
    ) {
    }
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(Extension::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $entities = $this->extensionStub->getAll();

        foreach ($entities as $entity) {
            $this->addReference(
                '_reference_ProviderExtension' . $entity->getId(),
                $entity
            );
            $manager->persist($entity);
        }

        $manager->flush();
    }
}
