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
        $item1->setTerminal($this->getReference('_reference_ProviderTerminal1'));
        $this->addReference('_reference_AstPsEndpoint1', $item1);
        $this->sanitizeEntityValues($item1);
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
        $item2->setTerminal($this->getReference('_reference_ProviderTerminal2'));
        $this->addReference('_reference_AstPsEndpoint2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        $item3 = $this->createEntityInstanceWithPublicMethods(PsEndpoint::class);
        $item3->setSorceryId("b1c1t3_testTerminal");
        $item3->setFromDomain("127.0.0.1");
        $item3->setAors("b1c1t3_testTerminal");
        $item3->setAllow("alaw");
        $item3->setDirectMediaMethod("invite");
        $item3->setOutboundProxy("sip:users.ivozprovider.local^3Blr");
        $item3->setTerminal($this->getReference('_reference_ProviderTerminal3'));
        $this->addReference('_reference_AstPsEndpoint3', $item3);
        $this->sanitizeEntityValues($item3);
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
        $item4->setFriend($this->getReference('_reference_ProviderFriend1'));
        $this->addReference('_reference_AstPsEndpoint4', $item4);
        $this->sanitizeEntityValues($item4);
        $manager->persist($item4);


        /** @var PsEndpoint $item5 */
        $item5 = $this->createEntityInstanceWithPublicMethods(PsEndpoint::class);
        $item5->setSorceryId("b1c1f1_testResidential");
        $item5->setFromDomain("127.0.0.1");
        $item5->setAors("b1c1f1_testResidential");
        $item5->setContext("friends");
        $item5->setAllow("alaw");
        $item5->setDirectMediaMethod("invite");
        $item5->setOutboundProxy("sip:users.ivozprovider.local^3Blr");
        $item5->setTrustIdInbound("yes");
        $item5->setResidentialDevice($this->getReference('_reference_ProviderResidentialDevice1'));
        $this->addReference('_reference_AstPsEndpoint5', $item5);
        $this->sanitizeEntityValues($item5);
        $manager->persist($item5);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderFriend::class,
            ProviderResidentialDevice::class
        );
    }
}
