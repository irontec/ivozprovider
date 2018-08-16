<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\RatingPlan\RatingPlan;
use Ivoz\Provider\Domain\Model\RatingPlan\Name;
use Ivoz\Provider\Domain\Model\RatingPlan\Description;

class ProviderRatingPlans extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager
            ->getClassMetadata(RatingPlan::class)
            ->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var RatingPlan $item1 */
        $item1 = $this->createEntityInstanceWithPublicMethods(RatingPlan::class);

        $item1->setTag('b1rp1');
        $item1->setName(new Name('Something', 'Algo'));
        $item1->setDescription(new Description('', ''));
        $item1->setBrand(
            $this->getReference('_reference_ProviderBrand1')
        );
        $this->addReference('_reference_ProviderRatingPlan1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        /** @var RatingPlan $item2 */
        $item2 = $this->createEntityInstanceWithPublicMethods(RatingPlan::class);

        $item2->setTag('b1rp2');
        $item2->setName(new Name('Something more', 'Algo más'));
        $item2->setDescription(new Description('', ''));
        $item2->setBrand(
            $this->getReference('_reference_ProviderBrand1')
        );
        $this->addReference('_reference_ProviderRatingPlan2', $item2);
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
