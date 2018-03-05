<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\Friend\Friend;

class ProviderFriend extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(Friend::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstanceWithPublicMethods(Friend::class);
        $item1->setName("testFriend");
        $item1->setTransport("udp");
        $item1->setIp("");
        $item1->setPort('5060');
        $item1->setPassword("SDG3qd2j6+");
        $item1->setPriority(1);
        $item1->setFromDomain("");
        $item1->setCompany($this->getReference('_reference_ProviderCompany1'));
        $item1->setDomain($this->getReference('_reference_ProviderDomain3'));
        $this->addReference('_reference_ProviderFriend1', $item1);
        $manager->persist($item1);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderCompany::class,
            ProviderDomain::class
        );
    }
}
