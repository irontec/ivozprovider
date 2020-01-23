<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGateway;
use Ivoz\Kam\Domain\Model\TrunksLcrGateway\TrunksLcrGatewayInterface;

class KamTrunksLcrGateway extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(TrunksLcrGateway::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $manager->getConnection()->exec(
            "INSERT INTO kam_trunks_lcr_gateways (id, gw_name, hostname, carrierServerId) VALUES (0, 'LcrDummyGateway', 'dummy.ivozprovider.local', NULL)"
        );

        /** @var TrunksLcrGatewayInterface $item1 */
        $item1 = $this->createEntityInstance(TrunksLcrGateway::class);
        (function () use ($fixture) {
            $this->setLcrId(1);
            $this->setGwName("b1c1s1");
            $this->setIp("127.0.0.1");
            $this->setHostname("");
            $this->setPort(5060);
            $this->setParams("");
            $this->setUriScheme(1);
            $this->setTransport(1);
            $this->setCarrierServer($fixture->getReference('_reference_ProviderCarrierServer1'));
        })->call($item1);

        $this->addReference('_reference_KamTrunksLcrGateway1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        /** @var TrunksLcrGatewayInterface $item2 */
        $item2 = $this->createEntityInstance(TrunksLcrGateway::class);
        (function () use ($fixture) {
            $this->setLcrId(1);
            $this->setGwName("b1c1s2");
            $this->setIp("127.0.0.2");
            $this->setHostname("");
            $this->setPort(5060);
            $this->setParams("");
            $this->setUriScheme(1);
            $this->setTransport(1);
            $this->setCarrierServer($fixture->getReference('_reference_ProviderCarrierServer2'));
        })->call($item2);

        $this->addReference('_reference_KamTrunksLcrGateway2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderCarrierServer::class
        );
    }
}
