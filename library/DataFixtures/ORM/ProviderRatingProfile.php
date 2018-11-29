<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\RatingProfile\RatingProfile;

class ProviderRatingProfile extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager
            ->getClassMetadata(RatingProfile::class)
            ->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var RatingProfile $item1 */
        $item1 = $this->createEntityInstance(RatingProfile::class);
        (function () {
            $this->setActivationTime(new \DateTime('2018-02-02 20:20:20'));
        })->call($item1);
        $item1->setCompany(
            $this->getReference('_reference_ProviderCompany1')
        );
        $item1->setRatingPlanGroup(
            $this->getReference('_reference_ProviderRatingPlanGroup1')
        );
        $item1->setCarrier(
            $this->getReference('_reference_ProviderCarrier1')
        );

        $this->addReference('_reference_ProviderRatingProfile1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        /** @var RatingProfile $item2 */
        $item2 = $this->createEntityInstance(RatingProfile::class);
        (function () {
            $this->setActivationTime(new \DateTime('2018-02-02 20:20:20'));
        })->call($item2);
        $item2->setCompany($this->getReference('_reference_ProviderCompany1'));
        $item2->setRatingPlanGroup($this->getReference('_reference_ProviderRatingPlanGroup2'));
        $item2->setRoutingTag($this->getReference('_reference_ProviderRoutingTag1'));
        $this->addReference('_reference_ProviderRatingProfile2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderCompany::class,
            ProviderRatingPlanGroups::class,
            ProviderRoutingTag::class,
            ProviderCarrier::class,
        );
    }
}
