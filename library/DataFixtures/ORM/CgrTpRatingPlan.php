<?php

namespace DataFixtures\ORM;

use DataFixtures\Stub\Cgr\TpRatingPlanStub;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\Persistence\ObjectManager;
use Ivoz\Cgr\Domain\Model\TpRatingPlan\TpRatingPlan;

class CgrTpRatingPlan extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    public function __construct(
        private TpRatingPlanStub $tpDestinationStub
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(TpRatingPlan::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $entities = $this->tpDestinationStub->getAll();
        foreach ($entities as $entity) {
            $this->addReference(
                '_reference_CgrTpRatingPlan' . $entity->getId(),
                $entity
            );
            $manager->persist($entity);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderRatingPlan::class
        );
    }
}
