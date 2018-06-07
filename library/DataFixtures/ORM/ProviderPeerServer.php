<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\PeerServer\PeerServer;
use Ivoz\Provider\Domain\Model\PeerServer\PeerServerInterface;

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

        /** @var PeerServerInterface $item1 */
        $item1 = $this->createEntityInstanceWithPublicMethods(PeerServer::class);
        $item1->setHostname("127.0.0.1");
        $item1->setPort(5060);
        $item1->setUriScheme(1);
        $item1->setTransport(1);
        $item1->setSendPAI(false);
        $item1->setSendRPID(false);
        $item1->setSipProxy("127.0.0.1");
        $item1->setFromUser("");
        $item1->setFromDomain("");
        $item1->setPeeringContract($this->getReference('_reference_ProviderPeeringContract1'));
        $item1->setBrand($this->getReference('_reference_ProviderBrand1'));
        $this->addReference('_reference_ProviderPeerServer1', $item1);

        /** @var PeerServerInterface $item2 */
        $item2 = $this->createEntityInstanceWithPublicMethods(PeerServer::class);
        $item2->setHostname("127.0.0.2");
        $item2->setPort(5060);
        $item2->setUriScheme(2);
        $item2->setTransport(1);
        $item2->setSendPAI(false);
        $item2->setSendRPID(false);
        $item2->setSipProxy("127.0.0.2");
        $item2->setFromUser("");
        $item2->setFromDomain("");
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
            ProviderPeeringContract::class,
            ProviderBrand::class
        );
    }
}
