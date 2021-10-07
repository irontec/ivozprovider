<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\ProxyTrunk\ProxyTrunk;

class ProviderProxyTrunk extends Fixture
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(ProxyTrunk::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $item1 = $this->createEntityInstance(ProxyTrunk::class);
        (function () use ($fixture) {
            $this->setName("proxytrunks");
            $this->setIp("127.0.0.1");
        })->call($item1);

        $this->addReference('_reference_ProviderProxyTrunk1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstance(ProxyTrunk::class);
        (function () use ($fixture) {
            $this->setName("ExtraIP");
            $this->setIp("127.0.0.3");
        })->call($item2);

        $this->addReference('_reference_ProviderProxyTrunk2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        $manager->flush();
    }
}
