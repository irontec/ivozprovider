<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\ApplicationServerSetRelApplicationServer\ApplicationServerSetRelApplicationServer;

class ProviderApplicationServerSetRelApplicationServers extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(ApplicationServerSetRelApplicationServer::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
        $manager->getConnection()->exec(
            'INSERT INTO ApplicationServerSetRelApplicationServers(applicationServerId, applicationServerSetId ) SELECT id, 0 FROM ApplicationServers WHERE id NOT IN(3,4)'
        );
        $item1 = $this->createEntityInstance(ApplicationServerSetRelApplicationServer::class);
        (function () use ($fixture) {
            $this->setApplicationServer($fixture->getReference('_reference_ProviderApplicationServer1'));
            $this->setApplicationServerSet($fixture->getReference('_reference_ProviderApplicationServerSet1'));
        })->call($item1);
        $this->addReference('_reference_ApplicationServerSetRelApplicationServer1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstance(ApplicationServerSetRelApplicationServer::class);
        (function () use ($fixture) {
            $this->setApplicationServer($fixture->getReference('_reference_ProviderApplicationServer2'));
            $this->setApplicationServerSet($fixture->getReference('_reference_ProviderApplicationServerSet1'));
        })->call($item2);
        $this->addReference('_reference_ApplicationServerSetRelApplicationServer2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        $item3 = $this->createEntityInstance(ApplicationServerSetRelApplicationServer::class);
        (function () use ($fixture) {
            $this->setApplicationServer($fixture->getReference('_reference_ProviderApplicationServer1'));
            $this->setApplicationServerSet($fixture->getReference('_reference_ProviderApplicationServerSet2'));
        })->call($item3);
        $this->addReference('_reference_ApplicationServerSetRelApplicationServer3', $item3);
        $this->sanitizeEntityValues($item3);
        $manager->persist($item3);

        $item4 = $this->createEntityInstance(ApplicationServerSetRelApplicationServer::class);
        (function () use ($fixture) {
            $this->setApplicationServer($fixture->getReference('_reference_ProviderApplicationServer3'));
            $this->setApplicationServerSet($fixture->getReference('_reference_ProviderApplicationServerSet2'));
        })->call($item4);
        $this->addReference('_reference_ApplicationServerSetRelApplicationServer4', $item4);
        $this->sanitizeEntityValues($item4);
        $manager->persist($item4);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderApplicationServer::class,
        );
    }
}
