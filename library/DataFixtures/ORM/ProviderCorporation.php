<?php

namespace DataFixtures\ORM;

use DataFixtures\Stub\Provider\CorporationStub;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\Persistence\ObjectManager;
use Ivoz\Provider\Domain\Model\Corporation\Corporation;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProviderCorporation extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    public function __construct(
        private CorporationStub $corporationStub,
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager
            ->getClassMetadata(Corporation::class)
            ->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $entities = $this->corporationStub->getAll();
        foreach ($entities as $entity) {
            $this->addReference(
                '_reference_Corporation' . $entity->getId(),
                $entity
            );
            $manager->persist($entity);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderBrand::class,
        );
    }
}
