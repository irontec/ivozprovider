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
            $this->setAuthNeeded('yes');
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
