<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\Ivr\Ivr;

class ProviderIvr extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(Ivr::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $item1 = $this->createEntityInstance(Ivr::class);
        (function () use ($fixture) {
            $this->setName("testIvrCustom");
            $this->setTimeout(6);
            $this->setMaxDigits(0);
            $this->setAllowExtensions(false);
            $this->setNoInputRouteType("number");
            $this->setNoInputNumberValue("946002020");
            $this->setErrorRouteType("voicemail");

            $this->setErrorVoicemail($fixture->getReference('_reference_ProviderVoicemail1'));
            $this->setCompany($fixture->getReference('_reference_ProviderCompany1'));
            $this->setWelcomeLocution($fixture->getReference('_reference_ProviderLocution1'));
            $this->setSuccessLocution($fixture->getReference('_reference_ProviderLocution1'));
            $this->setNoInputNumberCountry($fixture->getReference('_reference_ProviderCountry70'));
            $this->setErrorNumberCountry($fixture->getReference('_reference_ProviderCountry70'));
        })->call($item1);

        $this->addReference('_reference_ProviderIvr1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstance(Ivr::class);
        (function () use ($fixture) {
            $this->setName("testIvrCustom2");
            $this->setTimeout(6);
            $this->setMaxDigits(0);
            $this->setAllowExtensions(false);
            $this->setNoInputRouteType("extension");
            $this->setErrorRouteType("voicemail");
            $this->setNoInputExtension(
                $fixture->getReference('_reference_ProviderExtension1')
            );

            $this->setErrorVoicemail($fixture->getReference('_reference_ProviderVoicemail1'));
            $this->setCompany($fixture->getReference('_reference_ProviderCompany1'));
            $this->setWelcomeLocution($fixture->getReference('_reference_ProviderLocution1'));
            $this->setSuccessLocution($fixture->getReference('_reference_ProviderLocution1'));
            $this->setNoInputNumberCountry($fixture->getReference('_reference_ProviderCountry70'));
            $this->setErrorNumberCountry($fixture->getReference('_reference_ProviderCountry70'));
        })->call($item2);

        $this->addReference('_reference_ProviderIvr2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderCompany::class,
            ProviderUser::class,
            ProviderVoicemail::class,
            ProviderExtension::class,
            ProviderLocution::class,
            ProviderCountry::class
        );
    }
}
