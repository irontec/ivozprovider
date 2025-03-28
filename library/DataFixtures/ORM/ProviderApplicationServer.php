<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServer;

class ProviderApplicationServer extends Fixture
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(ApplicationServer::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $item1 = $this->createEntityInstance(ApplicationServer::class);
        (function () use ($fixture) {
            $this->setIp("127.0.0.1");
            $this->setName("as001");
        })->call($item1);

        $this->addReference('_reference_ProviderApplicationServer1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstance(ApplicationServer::class);
        (function () use ($fixture) {
            $this->setIp("127.1.1.1");
            $this->setName("test001");
        })->call($item2);

        $this->addReference('_reference_ProviderApplicationServer2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        $item3 = $this->createEntityInstance(ApplicationServer::class);
        (function () use ($fixture) {
            $this->setIp("127.1.1.2");
            $this->setName("test002");
        })->call($item3);

        $this->addReference('_reference_ProviderApplicationServer3', $item3);
        $this->sanitizeEntityValues($item3);
        $manager->persist($item3);

        $item4 = $this->createEntityInstance(ApplicationServer::class);
        (function () use ($fixture) {
            $this->setIp("127.1.1.4");
            $this->setName("test004");
        })->call($item4);

        $this->addReference('_reference_ProviderApplicationServer4', $item4);
        $this->sanitizeEntityValues($item4);
        $manager->persist($item4);

        $manager->flush();
    }
}
