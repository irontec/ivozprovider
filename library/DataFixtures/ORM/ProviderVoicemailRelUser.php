<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\VoicemailRelUser\VoicemailRelUser;

class ProviderVoicemailRelUser extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(VoicemailRelUser::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $item1 = $this->createEntityInstance(VoicemailRelUser::class);
        (function () use ($fixture) {
            $this->setUser($fixture->getReference('_reference_ProviderUser1'));
            $this->setVoicemail($fixture->getReference('_reference_ProviderVoicemail3'));
        })->call($item1);

        $this->addReference('_reference_ProviderVoicemailRelUser1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProviderVoicemail::class,
            ProviderUser::class
        ];
    }
}
