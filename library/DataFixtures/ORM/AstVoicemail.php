<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Ast\Domain\Model\Voicemail\Voicemail;

class AstVoicemail extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(Voicemail::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstance(Voicemail::class);
        (function () {
            $this->setContext("company1");
            $this->setMailbox("user1");
            $this->setFullname("Alice Allison");
            $this->setEmail("alice@democompany.com");
            $this->setAttach("yes");
            $this->setTz("Europe/Madrid");
        })->call($item1);
        $item1->setUser($this->getReference('_reference_ProviderUser1'));

        $this->addReference('_reference_AstVoicemail1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstance(Voicemail::class);
        (function () {
            $this->setContext("company1");
            $this->setMailbox("user2");
            $this->setFullname("Bob ");
            $this->setEmail("bob@democompany.com");
            $this->setAttach("yes");
            $this->setTz("Europe/Madrid");
        })->call($item2);
        $item2->setUser($this->getReference('_reference_ProviderUser2'));

        $this->addReference('_reference_AstVoicemail2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        $item3 = $this->createEntityInstance(Voicemail::class);
        (function () {
            $this->setContext("company1");
            $this->setMailbox("101");
            $this->setFullname("Alice ");
            $this->setEmail("alice@democompany.com");
            $this->setAttach("yes");
            $this->setTz("Europe/Madrid");
        })->call($item3);
        $item3->setUser($this->getReference('_reference_ProviderUser1'));

        $this->addReference('_reference_AstVoicemail3', $item3);
        $this->sanitizeEntityValues($item3);
        $manager->persist($item3);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderUser::class,
        );
    }
}
