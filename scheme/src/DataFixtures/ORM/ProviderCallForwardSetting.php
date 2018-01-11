<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\CallForwardSetting\CallForwardSetting;

class ProviderCallForwardSetting extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $manager->getClassMetadata(CallForwardSetting::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstanceWithPublicMethods(CallForwardSetting::class);
        $item1->setCallTypeFilter("internal");
        $item1->setCallForwardType("inconditional");
        $item1->setTargetType("number");
        $item1->setNumberValue("946002053");
        $item1->setNoAnswerTimeout(10);
        $item1->setUser($this->getReference('_reference_IvozProviderDomainModelUserUser1'));
        $item1->setNumberCountry($this->getReference('_reference_IvozProviderDomainModelCountryCountry70'));
        $this->addReference('_reference_IvozProviderDomainModelCallForwardSettingCallForwardSetting1', $item1);
        $manager->persist($item1);

    
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderUser::class,
            ProviderCountry::class
        );
    }
}
