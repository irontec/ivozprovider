<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\User\User;

class ProviderUser extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(User::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $item1 = $this->createEntityInstance(User::class);
        (function () use ($fixture) {
            $this->setName("Alice");
            $this->setLastname("Allison");
            $this->setEmail("alice@democompany.com");
            $this->setPass("changeme");
            $this->setDoNotDisturb(false);
            $this->setIsBoss(false);
            $this->setActive(true);
            $this->setMaxCalls(1);
            $this->setGsQRCode(false);
            $this->setCompany($fixture->getReference('_reference_ProviderCompany1'));
            $this->setTransformationRuleSet($fixture->getReference('_reference_ProviderTransformationRuleSet70'));
            $this->setTerminal($fixture->getReference('_reference_ProviderTerminal1'));
//        $this->setExtension($fixture->getReference('_reference_ProviderExtension1'));
//        $this->setVoicemail($fixture->getReference('_reference_ProviderVoicemail1'));
            $this->setTimezone($fixture->getReference('_reference_ProviderTimezone145'));
        })->call($item1);

        $this->addReference('_reference_ProviderUser1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstance(User::class);
        (function () use ($fixture) {
            $this->setName("Bob");
            $this->setLastname("Bobson");
            $this->setEmail("bob@democompany.com");
            $this->setPass("changeme");
            $this->setDoNotDisturb(false);
            $this->setIsBoss(true);
            $this->setActive(true);
            $this->setMaxCalls(1);
            $this->setGsQRCode(false);
            $this->setBossAssistant(
                $fixture->getReference('_reference_ProviderUser1')
            );
            $this->setCompany($fixture->getReference('_reference_ProviderCompany1'));
            $this->setTransformationRuleSet($fixture->getReference('_reference_ProviderTransformationRuleSet70'));
            $this->setTerminal($fixture->getReference('_reference_ProviderTerminal2'));
//        $this->setExtension($fixture->getReference('_reference_ProviderExtension2'));
//        $this->setVoicemail($fixture->getReference('_reference_ProviderVoicemail2'));
            $this->setTimezone($fixture->getReference('_reference_ProviderTimezone145'));
        })->call($item2);

        $this->addReference('_reference_ProviderUser2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderTransformationRuleSet::class,
            ProviderTerminal::class,
//            ProviderExtension::class,
//            ProviderVoicemail::class,
            ProviderTimezone::class,
            ProviderCompany::class
        );
    }
}
