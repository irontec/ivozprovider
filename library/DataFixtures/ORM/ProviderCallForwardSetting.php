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
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(CallForwardSetting::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $item1 = $this->createEntityInstanceWithPublicMethods(CallForwardSetting::class);
        $item1->setCallTypeFilter("internal");
        $item1->setCallForwardType("inconditional");
        $item1->setTargetType("number");
        $item1->setNumberValue("946002053");
        $item1->setUser($this->getReference('_reference_ProviderUser1'));
        $item1->setNumberCountry($this->getReference('_reference_ProviderCountry70'));
        $this->addReference('_reference_ProviderCallForwardSetting1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstanceWithPublicMethods(CallForwardSetting::class);
        $item2->setCallTypeFilter("external");
        $item2->setCallForwardType("noAnswer");
        $item2->setTargetType("number");
        $item2->setNumberValue("946002053");
        $item2->setNoAnswerTimeout(10);
        $item2->setUser($this->getReference('_reference_ProviderUser1'));
        $item2->setNumberCountry($this->getReference('_reference_ProviderCountry70'));
        $this->addReference('_reference_ProviderCallForwardSetting2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        $item3 = $this->createEntityInstanceWithPublicMethods(CallForwardSetting::class);
        $item3->setCallTypeFilter("external");
        $item3->setCallForwardType("busy");
        $item3->setTargetType("number");
        $item3->setNumberValue("946002053");
        $item3->setUser($this->getReference('_reference_ProviderUser1'));
        $item3->setNumberCountry($this->getReference('_reference_ProviderCountry70'));
        $this->addReference('_reference_ProviderCallForwardSetting3', $item3);
        $this->sanitizeEntityValues($item3);
        $manager->persist($item3);

        $item4 = $this->createEntityInstanceWithPublicMethods(CallForwardSetting::class);
        $item4->setCallTypeFilter("external");
        $item4->setCallForwardType("userNotRegistered");
        $item4->setTargetType("number");
        $item4->setNumberValue("946002054");
        $item4->setUser($this->getReference('_reference_ProviderUser1'));
        $item4->setNumberCountry($this->getReference('_reference_ProviderCountry70'));
        $this->addReference('_reference_ProviderCallForwardSetting4', $item4);
        $this->sanitizeEntityValues($item4);
        $manager->persist($item4);

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
