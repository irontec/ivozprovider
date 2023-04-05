<?php

namespace DataFixtures\ORM;

use DataFixtures\Stub\Provider\BalanceMovementStub;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\Persistence\ObjectManager;
use Ivoz\Provider\Domain\Model\BalanceMovement\BalanceMovement;

class ProviderBalanceMovement extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    public function __construct(
        private BalanceMovementStub $balanceMovementStub,
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager
            ->getClassMetadata(BalanceMovement::class)
            ->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $entities = $this->balanceMovementStub->getAll();
        foreach ($entities as $entity) {
            $this->addReference(
                '_reference_BalanceMovement' . $entity->getId(),
                $entity
            );
            $manager->persist($entity);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderCompany::class,
            ProviderCarrier::class,
        );
    }
}
