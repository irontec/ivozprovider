<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDevice;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface;

class ProviderResidentialDevice extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(ResidentialDevice::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var ResidentialDevice $item1 */
        $item1 = $this->createEntityInstance(ResidentialDevice::class);
        (function () use ($fixture) {
            $this->setName('residentialDevice');
            $this->setDescription('');
            $this->setTransport('udp');
            $this->setIp('1.2.3.4');
            $this->setPort(1024);
            $this->setPassword('+rA778LidL');
            $this->setDisallow('all');
            $this->setAllow('alaw');
            $this->setDirectMediaMethod('invite');
            $this->setCalleridUpdateHeader('pai');
            $this->setUpdateCallerid('yes');
            $this->setDirectConnectivity('no');
            $this->setRtpEncryption(false);
            $this->setBrand(
                $fixture->getReference('_reference_ProviderBrand1')
            );
            $this->setCompany(
                $fixture->getReference('_reference_ProviderCompany4')
            );
        })->call($item1);

        $this->addReference('_reference_ProviderResidentialDevice1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        for ($i = 2; $i < 6; $i++) {
            /** @var ResidentialDevice $item */
            $item = $this->createEntityInstance(ResidentialDevice::class);
            (function () use ($fixture, $i) {
                $this->setName('residentialDevice' . $i);
                $this->setDescription('');
                $this->setTransport('udp');
                $this->setIp('1.2.3.' . $i);
                $this->setPort(1024);
                $this->setPassword('+rA778LidL');
                $this->setDisallow('all');
                $this->setAllow('alaw');
                $this->setDirectMediaMethod('invite');
                $this->setCalleridUpdateHeader('pai');
                $this->setUpdateCallerid('yes');
                $this->setDirectConnectivity('no');
                $this->setRtpEncryption(false);
                $this->setBrand(
                    $fixture->getReference('_reference_ProviderBrand1')
                );
                $this->setCompany(
                    $fixture->getReference('_reference_ProviderCompany1')
                );
            })->call($item);

            $this->addReference('_reference_ProviderResidentialDevice' . $i, $item);
            $this->sanitizeEntityValues($item);
            $manager->persist($item);
        }

        /** @var ResidentialDevice $item6 */
        $item6 = $this->createEntityInstance(ResidentialDevice::class);
        (function () use ($fixture) {
            $this->setName('residentialDevice6');
            $this->setDescription('');
            $this->setTransport('udp');
            $this->setIp('1.2.3.4');
            $this->setPort(1024);
            $this->setRuriDomain('ruri2.example.com');
            $this->setPassword('+rA778LidL');
            $this->setDisallow('all');
            $this->setAllow('alaw');
            $this->setDirectMediaMethod('invite');
            $this->setCalleridUpdateHeader('pai');
            $this->setUpdateCallerid('yes');
            $this->setDirectConnectivity('yes');
            $this->setRtpEncryption(false);
            $this->setProxyUser(
                $fixture->getReference('_reference_ProviderProxyUserProxyUser1')
            );
            $this->setBrand(
                $fixture->getReference('_reference_ProviderBrand1')
            );
            $this->setCompany(
                $fixture->getReference('_reference_ProviderCompany4')
            );
        })->call($item6);

        $this->addReference('_reference_ProviderResidentialDevice6', $item6);
        $this->sanitizeEntityValues($item6);
        $manager->persist($item6);

        $manager->flush();
    }


    public function getDependencies()
    {
        return array(
            ProviderBrand::class,
            ProviderDomain::class,
            ProviderCompany::class
        );
    }
}
