<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
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
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(User::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $item1 = $this->createEntityInstance(User::class);
        (function () {
            $this->setName("Alice");
            $this->setLastname("Allison");
            $this->setEmail("alice@democompany.com");
            $this->setPass("changeme");
            $this->setDoNotDisturb(false);
            $this->setIsBoss(false);
            $this->setActive(true);
            $this->setMaxCalls(1);
            $this->setVoicemailEnabled(true);
            $this->setVoicemailSendMail(true);
            $this->setVoicemailAttachSound(true);
            $this->setTokenKey("4c18027290f0c1ed517680bb4bcf2402");
            $this->setGsQRCode(false);
        })->call($item1);

        $item1->setCompany($this->getReference('_reference_ProviderCompany1'));
        $item1->setTransformationRuleSet($this->getReference('_reference_ProviderTransformationRuleSet70'));
        $item1->setTerminal($this->getReference('_reference_ProviderTerminal1'));
//        $item1->setExtension($this->getReference('_reference_ProviderExtension1'));
        $item1->setTimezone($this->getReference('_reference_ProviderTimezone145'));
        $this->addReference('_reference_ProviderUser1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstance(User::class);
        (function () {
            $this->setName("Bob");
            $this->setLastname("Bobson");
            $this->setEmail("bob@democompany.com");
            $this->setPass("changeme");
            $this->setDoNotDisturb(false);
            $this->setIsBoss(true);
            $this->setActive(true);
            $this->setMaxCalls(1);
            $this->setVoicemailEnabled(true);
            $this->setVoicemailSendMail(true);
            $this->setVoicemailAttachSound(true);
            $this->setTokenKey("10fd9fbe1c6861fb0a14a57e78f871c5");
            $this->setGsQRCode(false);
        })->call($item2);

        $item2->setBossAssistant(
            $this->getReference('_reference_ProviderUser1', $item1)
        );
        $item2->setCompany($this->getReference('_reference_ProviderCompany1'));
        $item2->setTransformationRuleSet($this->getReference('_reference_ProviderTransformationRuleSet70'));
        $item2->setTerminal($this->getReference('_reference_ProviderTerminal2'));
//        $item2->setExtension($this->getReference('_reference_ProviderExtension2'));
        $item2->setTimezone($this->getReference('_reference_ProviderTimezone145'));
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
            ProviderTimezone::class,
            ProviderCompany::class
        );
    }
}
