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
    
        $item1 = $this->createEntityInstance(PsEndpoint::class);
        (function () {
            $this->setSorceryId("b1c1t1_alice");
            $this->setAors("b1c1t1_alice");
            $this->setCallerid("Alice  <101>");
            $this->setAllow("alaw");
            $this->setDirectMedia(null);
            $this->setDirectMediaMethod("invite");
            $this->setMailboxes("101@company1");
            $this->setNamedPickupGroup("");
        })->call($item1);

        $item1->setTerminal($this->getReference('_reference_ProviderTerminal1'));
        $this->addReference('_reference_AstPsEndpoint1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstance(PsEndpoint::class);
        (function () {
            $this->setSorceryId("b1c1t2_bob");
            $this->setAors("b1c1t2_bob");
            $this->setCallerid("Bob  <102>");
            $this->setAllow("alaw");
            $this->setDirectMedia(null);
            $this->setDirectMediaMethod("invite");
            $this->setMailboxes("102@company1");
            $this->setNamedPickupGroup("");
        })->call($item2);
        $item2->setTerminal($this->getReference('_reference_ProviderTerminal2'));

        $this->addReference('_reference_AstPsEndpoint2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        $item3 = $this->createEntityInstance(PsEndpoint::class);
        (function () {
            $this->setSorceryId("b1c1t3_testTerminal");
            $this->setFromDomain("127.0.0.1");
            $this->setAors("b1c1t3_testTerminal");
            $this->setAllow("alaw");
            $this->setDirectMediaMethod("invite");
            $this->setOutboundProxy("sip:users.ivozprovider.local^3Blr");
        })->call($item3);
        $item3->setTerminal($this->getReference('_reference_ProviderTerminal3'));

        $this->addReference('_reference_AstPsEndpoint3', $item3);
        $this->sanitizeEntityValues($item3);
        $manager->persist($item3);

        $item4 = $this->createEntityInstance(PsEndpoint::class);
        (function () {
            $this->setSorceryId("b1c1f1_testFriend");
            $this->setFromDomain("127.0.0.1");
            $this->setAors("b1c1f1_testFriend");
            $this->setContext("friends");
            $this->setAllow("alaw");
            $this->setDirectMediaMethod("invite");
            $this->setOutboundProxy("sip:users.ivozprovider.local^3Blr");
            $this->setTrustIdInbound("yes");
        })->call($item4);
        $item4->setFriend($this->getReference('_reference_ProviderFriend1'));

        $this->addReference('_reference_AstPsEndpoint4', $item4);
        $this->sanitizeEntityValues($item4);
        $manager->persist($item4);


        /** @var PsEndpoint $item5 */
        $item5 = $this->createEntityInstance(PsEndpoint::class);
        (function () {
            $this->setSorceryId("b1c1f1_testResidential");
            $this->setFromDomain("127.0.0.1");
            $this->setAors("b1c1f1_testResidential");
            $this->setContext("friends");
            $this->setAllow("alaw");
            $this->setDirectMediaMethod("invite");
            $this->setOutboundProxy("sip:users.ivozprovider.local^3Blr");
            $this->setTrustIdInbound("yes");
        })->call($item5);
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
