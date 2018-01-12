<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\QueueMember\QueueMember;

class ProviderQueueMember extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(QueueMember::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstanceWithPublicMethods(QueueMember::class);
        $item1->setPenalty(1);
        $item1->setQueue($this->getReference('_reference_IvozProviderDomainModelQueueQueue1'));
        $item1->setUser($this->getReference('_reference_IvozProviderDomainModelUserUser1'));
        $this->addReference('_reference_IvozProviderDomainModelQueueMemberQueueMember1', $item1);
        $manager->persist($item1);

    
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderQueue::class,
            ProviderUser::class
        );
    }
}
