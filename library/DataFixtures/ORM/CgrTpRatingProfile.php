<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Cgr\Domain\Model\TpRatingProfile\TpRatingProfile;

class CgrTpRatingProfile extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager
            ->getClassMetadata(TpRatingProfile::class)
            ->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var TpRatingProfile $item1 */
        $item1 = $this->createEntityInstanceWithPublicMethods(TpRatingProfile::class);

        $item1->setTpid('ivozprovider');
        $item1->setLoadid('DATABASE');
        $item1->setDirection('*out');
        $item1->setTenant('b1');
        $item1->setCategory('call');
        $item1->setSubject('c1');
        $item1->setActivationTime(
            new \DateTime('2018-01-01 10:10:10')
        );
        $item1->setRatingPlanTag('b1rp1');
        $item1->setCreatedAt(
            new \DateTime('2018-01-01 10:10:10')
        );
        $item1->setCompany(
            $this->getReference('_reference_ProviderCompany1')
        );
        $item1->setRatingPlan(
            $this->getReference('_reference_CgrRatingPlans1')
        );
        $this->sanitizeEntityValues($item1);
        $this->addReference('_reference_CgrTpRatingProfile1', $item1);
        $manager->persist($item1);

        /** @var TpRatingProfile $item2 */
        $item2 = $this->createEntityInstanceWithPublicMethods(TpRatingProfile::class);

        $item2->setTpid('ivozprovider');
        $item2->setLoadid('DATABASE');
        $item2->setDirection('*out');
        $item2->setTenant('b1');
        $item2->setCategory('call');
        $item2->setSubject('c1');
        $item2->setActivationTime(
            new \DateTime('2018-02-02 20:20:20')
        );
        $item2->setRatingPlanTag('b1rp2');
        $item2->setCreatedAt(
            new \DateTime('2018-02-02 20:20:20')
        );
        $item2->setCompany(
            $this->getReference('_reference_ProviderCompany1')
        );
        $item2->setRatingPlan(
            $this->getReference('_reference_CgrRatingPlans1')
        );
        $this->sanitizeEntityValues($item2);
        $this->addReference('_reference_CgrTpRatingProfile2', $item2);
        $manager->persist($item2);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            CgrRatingPlans::class,
            ProviderCompany::class,
        );
    }
}
