<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServer;

class ProviderApplicationServer extends Fixture
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(ApplicationServer::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstanceWithPublicMethods(ApplicationServer::class);
        $item1->setIp("127.0.0.1");
        $item1->setName("as001");
        $this->addReference('_reference_IvozProviderDomainModelApplicationServerApplicationServer1', $item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstanceWithPublicMethods(ApplicationServer::class);
        $item2->setIp("127.1.1.1");
        $item2->setName("test001");
        $this->addReference('_reference_IvozProviderDomainModelApplicationServerApplicationServer2', $item2);
        $manager->persist($item2);

    
        $manager->flush();
    }
}
