<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRoute;

class ProviderConditionalRoute extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(ConditionalRoute::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstanceWithPublicMethods(ConditionalRoute::class);
        $item1->setName("testConditional");
        $item1->setRoutetype("user");
        $item1->setNumbervalue("");
        $item1->setFriendvalue("");
        $item1->setCompany($this->getReference('_reference_IvozProviderDomainModelCompanyCompany1'));
        $item1->setUser($this->getReference('_reference_IvozProviderDomainModelUserUser1'));
        $item1->setNumberCountry($this->getReference('_reference_IvozProviderDomainModelCountryCountry70'));
        $this->addReference('_reference_IvozProviderDomainModelConditionalRouteConditionalRoute1', $item1);
        $manager->persist($item1);

    
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderCompany::class,
            ProviderUser::class,
            ProviderCountry::class
        );
    }
}
