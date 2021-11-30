<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlan;

class ProviderRatingPlan extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager
            ->getClassMetadata(RatingPlan::class)
            ->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var ratingPlan $item1 */
        $item1 = $this->createEntityInstance(RatingPlan::class);
        (function () use ($fixture) {
            $this
                ->timeIn = new \DateTime('2018-01-01 10:10:10');
            $this
                ->setRatingPlanGroup(
                    $fixture->getReference('_reference_ProviderRatingPlanGroup1')
                )
                ->setDestinationRateGroup(
                    $fixture->getReference('_reference_ProviderDestinationRateGroup1')
                );
        })->call($item1);

        $this->addReference('_reference_ProviderRatingPlan1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderRatingPlanGroups::class,
            ProviderDestinationRateGroup::class,

        );
    }
}
