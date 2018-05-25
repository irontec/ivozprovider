<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\LcrGateway\LcrGateway;

class ProviderLcrGateway extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(LcrGateway::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $item1 = $this->createEntityInstanceWithPublicMethods(LcrGateway::class);
        $item1->setLcrId(1);
        $item1->setGwName("b1p1s1");
        $item1->setIp("127.0.0.1");
        $item1->setHostname("hostname.net");
        $item1->setPort(5060);
        $item1->setParams("");
        $item1->setUriScheme(true);
        $item1->setTransport(true);
        $item1->setPeerServer($this->getReference('_reference_ProviderPeerServer1'));
        $this->addReference('_reference_ProviderLcrGateway1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderPeerServer::class
        );
    }
}
