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
     * Set loading order.
     *
     * @return int
     */
    public function getOrder()
    {
        return 9;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $manager->getClassMetadata(User::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstanceWithPublicMethods(User::class);
        $item1->setName("Alice");
        $item1->setLastname("Allison");
        $item1->setEmail("alice@democompany.com");
        $item1->setPass("\$5\$rounds=5000\$a73b96fd\$XGSEyikkLGgFNo8/TV4.IrnkfN6UecTusCVQX6Qjbl8");
        $item1->setDoNotDisturb(false);
        $item1->setIsBoss(false);
        $item1->setActive(true);
        $item1->setMaxCalls(1);
        $item1->setVoicemailEnabled(true);
        $item1->setVoicemailSendMail(true);
        $item1->setVoicemailAttachSound(true);
        $item1->setTokenKey("4c18027290f0c1ed517680bb4bcf2402");
        $item1->setGsQRCode(false);
        $item1->setCompany($this->getReference('_reference_IvozProviderDomainModelCompanyCompany1'));
        $item1->setTransformationRuleSet($this->getReference('_reference_IvozProviderDomainModelTransformationRuleSetTransformationRuleSet70'));
        $item1->setTerminal($this->getReference('_reference_IvozProviderDomainModelTerminalTerminal1'));
//        $item1->setExtension($this->getReference('_reference_IvozProviderDomainModelExtensionExtension1'));
        $item1->setTimezone($this->getReference('_reference_IvozProviderDomainModelTimezoneTimezone145'));
        $this->addReference('_reference_IvozProviderDomainModelUserUser1', $item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstanceWithPublicMethods(User::class);
        $item2->setName("Bob");
        $item2->setLastname("Bobson");
        $item2->setEmail("bob@democompany.com");
        $item2->setPass("\$5\$rounds=5000\$b1e18dba\$71SpUyDy6TCqe3vg/zeZJPiV.MmF6Ip2Lc0sLeZW8u2");
        $item2->setDoNotDisturb(false);
        $item2->setIsBoss(false);
        $item2->setActive(true);
        $item2->setMaxCalls(1);
        $item2->setVoicemailEnabled(true);
        $item2->setVoicemailSendMail(true);
        $item2->setVoicemailAttachSound(true);
        $item2->setTokenKey("10fd9fbe1c6861fb0a14a57e78f871c5");
        $item2->setGsQRCode(false);
        $item2->setCompany($this->getReference('_reference_IvozProviderDomainModelCompanyCompany1'));
        $item2->setTransformationRuleSet($this->getReference('_reference_IvozProviderDomainModelTransformationRuleSetTransformationRuleSet70'));
        $item2->setTerminal($this->getReference('_reference_IvozProviderDomainModelTerminalTerminal2'));
//        $item2->setExtension($this->getReference('_reference_IvozProviderDomainModelExtensionExtension2'));
        $item2->setTimezone($this->getReference('_reference_IvozProviderDomainModelTimezoneTimezone145'));
        $this->addReference('_reference_IvozProviderDomainModelUserUser2', $item2);
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
