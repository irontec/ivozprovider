<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
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
        $this->disableLifecycleEvents($manager);
        $manager
            ->getClassMetadata(RatingPlanGroup::class)
            ->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var RatingPlanGroup $item1 */
        $item1 = $this->createEntityInstance(RatingPlanGroup::class);
        (function () {
            $this->setName(new Name('Something', 'Algo'));
            $this->setDescription(new Description('', ''));
        })->call($item1);

        $item1->setBrand(
            $this->getReference('_reference_ProviderBrand1')
        );
        $this->addReference('_reference_ProviderRatingPlanGroup1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        /** @var RatingPlanGroup $item2 */
        $item2 = $this->createEntityInstance(RatingPlanGroup::class);
        (function () {
            $this->setName(new Name('Something more', 'Algo más'));
            $this->setDescription(new Description('', ''));
        })->call($item2);

        $item2->setBrand(
            $this->getReference('_reference_ProviderBrand1')
        );
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
