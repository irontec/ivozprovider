<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\Contact\Contact;

class ProviderContact extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(Contact::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $item1 = $this->createEntityInstance(Contact::class);
        (function () use ($fixture) {
            $this->setName("Test Contact name");
            $this->setLastname("Test Contact Lastname");
            $this->setEmail("testcontact@email.com");
            $this->setWorkPhone("456123");
            $this->setWorkPhoneE164("+34456123");
            $this->setWorkPhoneCountry($fixture->getReference('_reference_ProviderCountry70'));
            $this->setMobilePhone("111222");
            $this->setMobilePhoneE164("+34111222");
            $this->setMobilePhoneCountry($fixture->getReference('_reference_ProviderCountry70'));
            $this->setOtherPhone("4001");
            $this->setCompany($fixture->getReference('_reference_ProviderCompany1'));
        })->call($item1);

        $this->addReference('_reference_ProviderContact1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstance(Contact::class);
        (function () use ($fixture) {
            $this->setName("Alice");
            $this->setLastname("Allison");
            $this->setEmail("alice@democompany.com");
            $this->setOtherPhone("101");
            $this->setCompany($fixture->getReference('_reference_ProviderCompany1'));
            $this->setUser($fixture->getReference('_reference_ProviderUser1'));
        })->call($item2);

        $this->addReference('_reference_ProviderContact2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        $item3 = $this->createEntityInstance(Contact::class);
        (function () use ($fixture) {
            $this->setName("Bob");
            $this->setLastname("Bobson");
            $this->setEmail("bob@democompany.com");
            $this->setOtherPhone("102");
            $this->setMobilePhone("678876102");
            $this->setWorkPhoneE164("+34678876102");
            $this->setWorkPhoneCountry($fixture->getReference('_reference_ProviderCountry70'));
            $this->setCompany($fixture->getReference('_reference_ProviderCompany1'));
            $this->setUser($fixture->getReference('_reference_ProviderUser2'));
        })->call($item3);

        $this->addReference('_reference_ProviderContact3', $item3);
        $this->sanitizeEntityValues($item3);
        $manager->persist($item3);
        
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderCompany::class,
            ProviderUser::class,
            ProviderCountry::class,
        );
    }
}
