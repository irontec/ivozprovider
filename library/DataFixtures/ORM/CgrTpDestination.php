<?php

namespace DataFixtures\ORM;

use DataFixtures\Stub\Cgr\TpDestinationStub;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\Persistence\ObjectManager;
use Ivoz\Cgr\Domain\Model\TpDestination\TpDestination;

class CgrTpDestination extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    public function __construct(
        private TpDestinationStub $tpDestinationStub
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager
            ->getClassMetadata(TpDestination::class)
            ->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $entities = $this->tpDestinationStub->getAll();
        foreach ($entities as $entity) {
            $this->addReference(
                '_reference_CgrTpDestination' . $entity->getId(),
                $entity
            );
            $manager->persist($entity);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderDestination::class
        );
    }
}
