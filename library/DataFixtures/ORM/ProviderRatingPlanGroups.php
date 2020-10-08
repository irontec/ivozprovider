<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\RatingPlanGroup\RatingPlanGroup;
use Ivoz\Provider\Domain\Model\RatingPlanGroup\Name;
use Ivoz\Provider\Domain\Model\RatingPlanGroup\Description;

class ProviderRatingPlanGroups extends Fixture implements DependentFixtureInterface
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
            ->getClassMetadata(RatingPlanGroup::class)
            ->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var RatingPlanGroup $item1 */
        $item1 = $this->createEntityInstance(RatingPlanGroup::class);
        (function () use ($fixture) {
            $this->setName(new Name('Something', 'Algo', 'Algo mes', 'Più'));
            $this->setDescription(new Description('en', 'es', 'ca', 'it'));
            $this->setBrand(
                $fixture->getReference('_reference_ProviderBrand1')
            );
        })->call($item1);

        $this->addReference('_reference_ProviderRatingPlanGroup1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        /** @var RatingPlanGroup $item2 */
        $item2 = $this->createEntityInstance(RatingPlanGroup::class);
        (function () use ($fixture) {
            $this->setName(new Name('Something more', 'Algo más', 'Algo mes', 'Più'));
            $this->setDescription(new Description('en', 'es', 'ca', 'it'));
            $this->setBrand(
                $fixture->getReference('_reference_ProviderBrand1')
            );
        })->call($item2);

        $this->addReference('_reference_ProviderRatingPlanGroup2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderBrand::class,
        );
    }
}
