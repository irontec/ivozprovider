<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\FriendsPattern\FriendsPattern;

class ProviderFriendsPattern extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $manager->getClassMetadata(FriendsPattern::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstanceWithPublicMethods(FriendsPattern::class);
        $item1->setName("Spain");
        $item1->setRegExp("+34");
        $item1->setFriend($this->getReference('_reference_IvozProviderDomainModelFriendFriend1'));
        $this->addReference('_reference_IvozProviderDomainModelFriendsPatternFriendsPattern1', $item1);
        $manager->persist($item1);

    
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderFriend::class
        );
    }
}
