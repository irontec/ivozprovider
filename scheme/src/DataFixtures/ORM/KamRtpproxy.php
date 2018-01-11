<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Kam\Domain\Model\Rtpproxy\Rtpproxy;

class KamRtpproxy extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $manager->getClassMetadata(Rtpproxy::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item0 = $this->createEntityInstanceWithPublicMethods(Rtpproxy::class);
        $item0->setUrl("udp:127.0.0.1:22222");
        $item0->setFlags(0);
        $item0->setWeight(1);
        $item0->setDescription("Local media relay");
        $item0->setMediaRelaySet($this->getReference('_reference_IvozProviderDomainModelMediaRelaySetMediaRelaySet0'));
        $this->addReference('_reference_IvozKamDomainModelRtpproxyRtpproxy0', $item0);
        $manager->persist($item0);

        $item1 = $this->createEntityInstanceWithPublicMethods(Rtpproxy::class);
        $item1->setUrl("udp:127.0.0.1:22222");
        $item1->setFlags(0);
        $item1->setWeight(1);
        $item1->setDescription("Local media relay");
        $item1->setMediaRelaySet($this->getReference('_reference_IvozProviderDomainModelMediaRelaySetMediaRelaySet0'));
        $this->addReference('_reference_IvozKamDomainModelRtpproxyRtpproxy1', $item1);
        $manager->persist($item1);

    
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderMediaRelaySet::class,
        );
    }
}
