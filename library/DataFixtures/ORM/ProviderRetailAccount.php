<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccount;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface;

class ProviderRetailAccount extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(RetailAccount::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var RetailAccount $item1 */
        $item1 = $this->createEntityInstance(RetailAccount::class);
        (function () {
            $this->setName('testRetailAccount');
            $this->setTransport('udp');
            $this->setDirectConnectivity('yes');
        })->call($item1);

        $item1->setBrand(
            $this->getReference('_reference_ProviderBrand1')
        );
        $item1->setCompany(
            $this->getReference('_reference_ProviderCompany3')
        );
        $this->addReference('_reference_ProviderRetailAccount1', $item1);
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
