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
    
        $item1 = $this->createEntityInstanceWithPublicMethods(Voicemail::class);
        $item1->setContext("company1");
        $item1->setMailbox("");
        $item1->setFullname("Alice Allison");
        $item1->setEmail("alice@democompany.com");
        $item1->setAttach("yes");
        $item1->setTz("Europe/Madrid");
        $item1->setUser($this->getReference('_reference_ProviderUser1'));
        $this->addReference('_reference_AstVoicemail1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstanceWithPublicMethods(Voicemail::class);
        $item2->setContext("company1");
        $item2->setMailbox("102");
        $item2->setFullname("Bob ");
        $item2->setEmail("bob@democompany.com");
        $item2->setAttach("yes");
        $item2->setTz("Europe/Madrid");
        $item2->setUser($this->getReference('_reference_ProviderUser2'));
        $this->addReference('_reference_AstVoicemail2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        $item3 = $this->createEntityInstanceWithPublicMethods(Voicemail::class);
        $item3->setContext("company1");
        $item3->setMailbox("101");
        $item3->setFullname("Alice ");
        $item3->setEmail("alice@democompany.com");
        $item3->setAttach("yes");
        $item3->setTz("Europe/Madrid");
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
