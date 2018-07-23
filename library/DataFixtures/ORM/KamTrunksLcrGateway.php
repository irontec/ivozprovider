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
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(TrunksLcrGateway::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var TrunksLcrGatewayInterface $item1 */
        $item1 = $this->createEntityInstanceWithPublicMethods(TrunksLcrGateway::class);
        $item1->setLcrId(1);
        $item1->setGwName("b1p1s1");
        $item1->setIp("127.0.0.1");
        $item1->setHostname("hostname.net");
        $item1->setPort(5060);
        $item1->setParams("");
        $item1->setUriScheme(2);
        $item1->setTransport(1);
        $item1->setCarrierServer($this->getReference('_reference_ProviderCarrierServer1'));
        $this->addReference('_reference_KamTrunksLcrGateway1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderCarrierServer::class
        );
    }
}
