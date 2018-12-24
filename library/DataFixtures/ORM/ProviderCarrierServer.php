<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\CarrierServer\CarrierServer;
use Ivoz\Provider\Domain\Model\CarrierServer\CarrierServerInterface;

class ProviderCarrierServer extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(CarrierServer::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var CarrierServerInterface $item1 */
        $item1 = $this->createEntityInstance(CarrierServer::class);
        (function () {
            $this->setHostname("127.0.0.1");
            $this->setPort(5060);
            $this->setUriScheme(1);
            $this->setTransport(1);
            $this->setSendPAI(false);
            $this->setSendRPID(false);
            $this->setSipProxy("127.0.0.1");
            $this->setFromUser("");
            $this->setFromDomain("");
        })->call($item1);

        $item1->setCarrier($this->getReference('_reference_ProviderCarrier1'));
        $item1->setBrand($this->getReference('_reference_ProviderBrand1'));
        $this->addReference('_reference_ProviderCarrierServer1', $item1);

        /** @var CarrierServerInterface $item2 */
        $item2 = $this->createEntityInstance(CarrierServer::class);
        (function () {
            $this->setHostname("127.0.0.2");
            $this->setPort(5060);
            $this->setUriScheme(2);
            $this->setTransport(1);
            $this->setSendPAI(false);
            $this->setSendRPID(false);
            $this->setSipProxy("127.0.0.2");
            $this->setFromUser("");
            $this->setFromDomain("");
        })->call($item2);

        $item2->setCarrier($this->getReference('_reference_ProviderCarrier1'));
        $item2->setBrand($this->getReference('_reference_ProviderBrand1'));
        $this->addReference('_reference_ProviderCarrierServer2', $item2);

        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

    
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderCarrier::class,
            ProviderBrand::class
        );
    }
}
