<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\HuntGroupsRelUser\HuntGroupsRelUser;

class ProviderHuntGroupsRelUser extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $manager->getClassMetadata(HuntGroupsRelUser::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstanceWithPublicMethods(HuntGroupsRelUser::class);
        $item1->setTimeoutTime(1);
        $item1->setPriority(1);
        $item1->setHuntGroup($this->getReference('_reference_IvozProviderDomainModelHuntGroupHuntGroup1'));
        $item1->setUser($this->getReference('_reference_IvozProviderDomainModelUserUser1'));
        $this->addReference('_reference_IvozProviderDomainModelHuntGroupsRelUserHuntGroupsRelUser1', $item1);
        $manager->persist($item1);

    
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderHuntGroup::class,
            ProviderUser::class
        );
    }
}
