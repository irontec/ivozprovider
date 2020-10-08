<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Kam\Domain\Model\Rtpengine\Rtpengine;

class KamRtpengine extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager
            ->getClassMetadata(Rtpengine::class)
            ->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstance(Rtpengine::class);
        (function () use ($fixture) {
            $this
                ->setSetid(0)
                ->setUrl('udp:127.0.0.1:22223')
                ->setWeight(1)
                ->setDisabled(false)
                ->setStamp('2000-01-01 00:00:00')
                ->setDescription('rtpengine01')
                ->setMediaRelaySet(
                    $fixture->getReference('_reference_ProviderMediaRelaySet1')
                );
        })->call($item1);

        $this->addReference('_reference_KamRtpengine1', $item1);
        $this->sanitizeEntityValues($item1);
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
