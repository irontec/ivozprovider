<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\Voicemail\Voicemail;

class ProviderVoicemail extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(Voicemail::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $item1 = $this->createEntityInstance(Voicemail::class);
        (function () use ($fixture) {
            $this->setName("Voicemail For User1");
            $this->setEmail("alice@democompany.com");
            $this->setSendMail(true);
            $this->setAttachSound(true);
            $this->setCompany($fixture->getReference('_reference_ProviderCompany1'));
            $this->setUser($fixture->getReference('_reference_ProviderUser1'));
            $this->setLocution($fixture->getReference('_reference_ProviderLocution1'));
        })->call($item1);

        $this->addReference('_reference_ProviderVoicemail1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstance(Voicemail::class);
        (function () use ($fixture) {
            $this->setName("Voicemail For Residential 1");
            $this->setEmail("");
            $this->setSendMail(false);
            $this->setAttachSound(false);
            $this->setCompany($fixture->getReference('_reference_ProviderCompany1'));
            $this->setResidentialDevice($fixture->getReference('_reference_ProviderResidentialDevice1'));
        })->call($item2);

        $this->addReference('_reference_ProviderVoicemail2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        $item3 = $this->createEntityInstance(Voicemail::class);
        (function () use ($fixture) {
            $this->setName("Voicemail Generic 1");
            $this->setEmail("generic@voicemail.com");
            $this->setSendMail(true);
            $this->setAttachSound(false);
            $this->setCompany($fixture->getReference('_reference_ProviderCompany1'));
        })->call($item3);

        $this->addReference('_reference_ProviderVoicemail3', $item3);
        $this->sanitizeEntityValues($item3);
        $manager->persist($item3);

        $item4 = $this->createEntityInstance(Voicemail::class);
        (function () use ($fixture) {
            $this->setName("Voicemail For User2");
            $this->setEmail("bob@voicemail.com");
            $this->setSendMail(true);
            $this->setAttachSound(false);
            $this->setCompany($fixture->getReference('_reference_ProviderCompany1'));
            $this->setUser($fixture->getReference('_reference_ProviderUser2'));
        })->call($item4);

        $this->addReference('_reference_ProviderVoicemail4', $item4);
        $this->sanitizeEntityValues($item4);
        $manager->persist($item4);


        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderCompany::class,
            ProviderUser::class,
            ProviderResidentialDevice::class,
            ProviderLocution::class,
        );
    }
}
