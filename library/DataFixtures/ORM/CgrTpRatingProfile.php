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
        $item1 = $this->createEntityInstance(TpRatingProfile::class);
        (function () {
            $this->setTpid('ivozprovider');
            $this->setLoadid('DATABASE');
            $this->setDirection('*out');
            $this->setTenant('b1');
            $this->setCategory('call');
            $this->setSubject('c1');
            $this->setActivationTime('2018-01-01 10:10:10');
            $this->setRatingPlanTag('b1rp1');
            $this->setCreatedAt(
                new \DateTime('2018-01-01 10:10:10')
            );
        })->call($item1);
        $item1->setRatingProfile(
            $this->getReference('_reference_ProviderRatingProfile1')
        );
        $this->sanitizeEntityValues($item1);
        $this->addReference('_reference_CgrTpRatingProfile1', $item1);
        $manager->persist($item1);

        /** @var TpRatingProfile $item2 */
        $item2 = $this->createEntityInstance(TpRatingProfile::class);
        (function () {
            $this->setTpid('ivozprovider');
            $this->setLoadid('DATABASE');
            $this->setDirection('*out');
            $this->setTenant('b1');
            $this->setCategory('call');
            $this->setSubject('c1rt1');
            $this->setActivationTime('2018-02-02 20:20:20');
            $this->setRatingPlanTag('b1rp2');
            $this->setCreatedAt(
                new \DateTime('2018-02-02 20:20:20')
            );
        })->call($item2);
        $item2->setRatingProfile(
            $this->getReference('_reference_ProviderRatingProfile2')
        );

        $this->sanitizeEntityValues($item2);
        $this->addReference('_reference_CgrTpRatingProfile2', $item2);
        $manager->persist($item2);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderRatingProfile::class,
        );
    }
}
