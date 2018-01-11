<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunk;

class ProviderProxyTrunk extends Fixture
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $manager->getClassMetadata(ProxyTrunk::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstanceWithPublicMethods(ProxyTrunk::class);
        $item1->setName("proxytrunks");
        $item1->setIp("127.0.0.1");
        $this->addReference('_reference_IvozProviderDomainModelProxyTrunkProxyTrunk1', $item1);
        $manager->persist($item1);

    
        $manager->flush();
    }
}
