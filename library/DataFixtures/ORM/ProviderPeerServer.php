<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\PeerServer\PeerServer;

class ProviderPeerServer extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(PeerServer::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstanceWithPublicMethods(PeerServer::class);
        $item1->setHostname("127.0.0.1");
        $item1->setPort(5060);
        $item1->setParams("");
        $item1->setUriScheme(true);
        $item1->setTransport(true);
        $item1->setPrefix("");
        $item1->setSendPAI(false);
        $item1->setSendRPID(false);
        $item1->setSipProxy("127.0.0.1");
        $item1->setFromUser("");
        $item1->setFromDomain("");
//        $item1->setLcrGateway($this->getReference('_reference_ProviderLcrGateway1'));
        $item1->setPeeringContract($this->getReference('_reference_ProviderPeeringContract1'));
        $item1->setBrand($this->getReference('_reference_ProviderBrand1'));
        $this->addReference('_reference_ProviderPeerServer1', $item1);


        $item2 = $this->createEntityInstanceWithPublicMethods(PeerServer::class);
        $item2->setHostname("127.0.0.2");
        $item2->setPort(5060);
        $item2->setParams("");
        $item2->setUriScheme(true);
        $item2->setTransport(true);
        $item2->setPrefix("");
        $item2->setSendPAI(false);
        $item2->setSendRPID(false);
        $item2->setSipProxy("127.0.0.2");
        $item2->setFromUser("");
        $item2->setFromDomain("");
//        $item1->setLcrGateway($this->getReference('_reference_ProviderLcrGateway1'));
        $item2->setPeeringContract($this->getReference('_reference_ProviderPeeringContract1'));
        $item2->setBrand($this->getReference('_reference_ProviderBrand1'));
        $this->addReference('_reference_ProviderPeerServer2', $item2);

        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

    
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
//            ProviderLcrGateway::class,
            ProviderPeeringContract::class,
            ProviderBrand::class
        );
    }
}
