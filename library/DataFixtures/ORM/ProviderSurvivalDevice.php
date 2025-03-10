<?php

namespace DataFixtures\ORM;

use DataFixtures\Stub\Provider\SurvivalDeviceStub;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\SurvivalDevice\SurvivalDevice;

class ProviderSurvivalDevice extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(SurvivalDevice::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
        
        $item1 = $this->createEntityInstance(SurvivalDevice::class);

        (function () use ($fixture) {
            $this->setName("survival test 1");
            $this->setProxy("23123");
            $this->setOutboundProxy("43322");
            $this->setUdpPort(5060);
            $this->setTcpPort(5060);
            $this->setTlsPort(5061);
            $this->setWssPort(10081);
            $this->setDescription("new survival device 1");
            $this->setCompany($fixture->getReference('_reference_ProviderCompany1'));
        })->call($item1);
        $this->addReference('__reference_SurvivalDevice1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);
        
        $item2 = $this->createEntityInstance(SurvivalDevice::class);
        (function () use ($fixture) {
            $this->setName("survival test 2");
            $this->setProxy("56789");
            $this->setOutboundProxy("67890");
            $this->setUdpPort(5070);
            $this->setTcpPort(5071);
            $this->setTlsPort(5062);
            $this->setWssPort(10082);
            $this->setDescription("new survival device 2");
            $this->setCompany($fixture->getReference('_reference_ProviderCompany2'));
        })->call($item2);
        $this->addReference('__reference_SurvivalDevice2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);  

        $item3 = $this->createEntityInstance(SurvivalDevice::class);
        (function () use ($fixture) {
            $this->setName("Survival Test 3");
            $this->setProxy("98765");
            $this->setOutboundProxy("54321");
            $this->setUdpPort(5080);
            $this->setTcpPort(5081);
            $this->setTlsPort(5063);
            $this->setWssPort(10083);
            $this->setDescription("new survival device 3");
            $this->setCompany($fixture->getReference('_reference_ProviderCompany3'));
        })->call($item3);
        $this->addReference('__reference_SurvivalDevice3', $item3);
        $this->sanitizeEntityValues($item3);
        $manager->persist($item3);

        $item4 = $this->createEntityInstance(SurvivalDevice::class);
        (function () use ($fixture) {
            $this->setName("Survival Test 4");
            $this->setProxy("11223");
            $this->setOutboundProxy("44556");
            $this->setUdpPort(5090);
            $this->setTcpPort(5091);
            $this->setTlsPort(5064);
            $this->setWssPort(10084);
            $this->setDescription("new survival device 4");
            $this->setCompany($fixture->getReference('_reference_ProviderCompany4'));
        })->call($item4);
        $this->addReference('__reference_SurvivalDevice4', $item4); 
        $this->sanitizeEntityValues($item4);
        $manager->persist($item4);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderCompany::class,
        );
    }
}
