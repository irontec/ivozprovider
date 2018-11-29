<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
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
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(ResidentialDevice::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var ResidentialDevice $item1 */
        $item1 = $this->createEntityInstance(ResidentialDevice::class);
        (function () {
            $this->setName('retail');
            $this->setTransport('udp');
            $this->setAuthNeeded('yes');
            $this->setDisallow('all');
            $this->setAllow('alaw');
            $this->setDirectMediaMethod('invite');
            $this->setCalleridUpdateHeader('pai');
            $this->setUpdateCallerid('yes');
            $this->setDirectConnectivity('yes');
        })->call($item1);

        $item1->setBrand(
            $this->getReference('_reference_ProviderBrand1')
        );
        $item1->setCompany(
            $this->getReference('_reference_ProviderCompany3')
        );
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
