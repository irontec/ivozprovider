<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Kam\Domain\Model\Dispatcher\Dispatcher;

class KamDispatcher extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(Dispatcher::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstance(Dispatcher::class);
        (function () use ($fixture) {
            $this->setSetid(1);
            $this->setDestination("sip:127.0.0.1:6060");
            $this->setFlags(0);
            $this->setPriority(0);
            $this->setDescription("as001");
            $this->setApplicationServer($fixture->getReference('_reference_ProviderApplicationServer1'));
        })->call($item1);

        $this->addReference('_reference_KamDispatcher1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstance(Dispatcher::class);
        (function () use ($fixture) {
            $this->setSetid(1);
            $this->setDestination("sip:127.1.1.1:6060");
            $this->setFlags(0);
            $this->setPriority(0);
            $this->setDescription("test001");
            $this->setApplicationServer($fixture->getReference('_reference_ProviderApplicationServer2'));
        })->call($item2);

        $this->addReference('_reference_KamDispatcher2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

    
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderApplicationServer::class,
        );
    }
}
