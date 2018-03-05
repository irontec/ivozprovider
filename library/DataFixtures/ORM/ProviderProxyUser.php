<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\ProxyUser\ProxyUser;

class ProviderProxyUser extends Fixture
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(ProxyUser::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstanceWithPublicMethods(ProxyUser::class);
        $item1->setName("proxyusers");
        $item1->setIp("127.0.0.1");
        $this->addReference('_reference_ProviderProxyUserProxyUser1', $item1);
        $manager->persist($item1);

    
        $manager->flush();
    }

}
