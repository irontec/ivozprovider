<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Ast\Domain\Model\PsEndpoint\PsEndpoint;

class AstPsEndpoint extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(PsEndpoint::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstanceWithPublicMethods(PsEndpoint::class);
        $item1->setSorceryId("b1c1t1_alice");
        $item1->setAors("b1c1t1_alice");
        $item1->setCallerid("Alice  <101>");
        $item1->setAllow("alaw");
        $item1->setDirectMedia(NULL);
        $item1->setDirectMediaMethod("invite");
        $item1->setMailboxes("101@company1");
        $item1->setNamedPickupGroup("");
        $item1->setTerminal($this->getReference('_reference_IvozProviderDomainModelTerminalTerminal1'));
        $this->addReference('_reference_IvozAstDomainModelPsEndpointPsEndpoint1', $item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstanceWithPublicMethods(PsEndpoint::class);
        $item2->setSorceryId("b1c1t2_bob");
        $item2->setAors("b1c1t2_bob");
        $item2->setCallerid("Bob  <102>");
        $item2->setAllow("alaw");
        $item2->setDirectMedia(NULL);
        $item2->setDirectMediaMethod("invite");
        $item2->setMailboxes("102@company1");
        $item2->setNamedPickupGroup("");
        $item2->setTerminal($this->getReference('_reference_IvozProviderDomainModelTerminalTerminal2'));
        $this->addReference('_reference_IvozAstDomainModelPsEndpointPsEndpoint2', $item2);
        $manager->persist($item2);

        $item3 = $this->createEntityInstanceWithPublicMethods(PsEndpoint::class);
        $item3->setSorceryId("b1c1t3_testTerminal");
        $item3->setFromDomain("127.0.0.1");
        $item3->setAors("b1c1t3_testTerminal");
        $item3->setAllow("alaw");
        $item3->setDirectMediaMethod("invite");
        $item3->setOutboundProxy("sip:users.ivozprovider.local^3Blr");
        $item3->setTerminal($this->getReference('_reference_IvozProviderDomainModelTerminalTerminal3'));
        $this->addReference('_reference_IvozAstDomainModelPsEndpointPsEndpoint3', $item3);
        $manager->persist($item3);

        $item4 = $this->createEntityInstanceWithPublicMethods(PsEndpoint::class);
        $item4->setSorceryId("b1c1f1_testFriend");
        $item4->setFromDomain("127.0.0.1");
        $item4->setAors("b1c1f1_testFriend");
        $item4->setContext("friends");
        $item4->setAllow("alaw");
        $item4->setDirectMediaMethod("invite");
        $item4->setOutboundProxy("sip:users.ivozprovider.local^3Blr");
        $item4->setTrustIdInbound("yes");
        $item4->setFriend($this->getReference('_reference_IvozProviderDomainModelFriendFriend1'));
        $this->addReference('_reference_IvozAstDomainModelPsEndpointPsEndpoint4', $item4);
        $manager->persist($item4);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderFriend::class,
        );
    }
}
