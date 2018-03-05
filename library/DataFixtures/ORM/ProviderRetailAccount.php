<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccount;

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
        $item1 = $this->createEntityInstanceWithPublicMethods(RetailAccount::class);
        $item1->setName('retail');
        $item1->setTransport('udp');
        $item1->setAuthNeeded('yes');
        $item1->setDisallow('all');
        $item1->setAllow('alaw');
        $item1->setDirectMediaMethod('invite');
        $item1->setCalleridUpdateHeader('pai');
        $item1->setUpdateCallerid('yes');
        $item1->setDirectConnectivity('yes');

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
