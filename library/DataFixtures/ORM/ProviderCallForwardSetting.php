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
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(CallForwardSetting::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $item1 = $this->createEntityInstance(CallForwardSetting::class);
        (function () use ($fixture) {
            $this->setCallTypeFilter("internal");
            $this->setCallForwardType("inconditional");
            $this->setTargetType("number");
            $this->setNumberValue("946002053");
            $this->setUser($fixture->getReference('_reference_ProviderUser1'));
            $this->setNumberCountry($fixture->getReference('_reference_ProviderCountry70'));
        })->call($item1);

        $this->addReference('_reference_ProviderCallForwardSetting1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstance(CallForwardSetting::class);
        (function () use ($fixture) {
            $this->setCallTypeFilter("external");
            $this->setCallForwardType("noAnswer");
            $this->setTargetType("number");
            $this->setNumberValue("946002053");
            $this->setNoAnswerTimeout(10);
            $this->setUser($fixture->getReference('_reference_ProviderUser1'));
            $this->setNumberCountry($fixture->getReference('_reference_ProviderCountry70'));
        })->call($item2);

        $this->addReference('_reference_ProviderCallForwardSetting2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        $item3 = $this->createEntityInstance(CallForwardSetting::class);
        (function () use ($fixture) {
            $this->setCallTypeFilter("external");
            $this->setCallForwardType("busy");
            $this->setTargetType("number");
            $this->setNumberValue("946002053");
            $this->setUser($fixture->getReference('_reference_ProviderUser1'));
            $this->setNumberCountry($fixture->getReference('_reference_ProviderCountry70'));
        })->call($item3);

        $this->addReference('_reference_ProviderCallForwardSetting3', $item3);
        $this->sanitizeEntityValues($item3);
        $manager->persist($item3);

        $item4 = $this->createEntityInstance(CallForwardSetting::class);
        (function () use ($fixture) {
            $this->setCallTypeFilter("external");
            $this->setCallForwardType("userNotRegistered");
            $this->setTargetType("number");
            $this->setNumberValue("946002054");
            $this->setUser($fixture->getReference('_reference_ProviderUser1'));
            $this->setNumberCountry($fixture->getReference('_reference_ProviderCountry70'));
        })->call($item4);

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
