<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
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
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(Dispatcher::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
    
        $item1 = $this->createEntityInstanceWithPublicMethods(Dispatcher::class);
        $item1->setSetid(1);
        $item1->setDestination("sip:127.0.0.1:6060");
        $item1->setFlags(0);
        $item1->setPriority(0);
        $item1->setDescription("as001");
        $item1->setApplicationServer($this->getReference('_reference_ProviderApplicationServer1'));
        $this->addReference('_reference_KamDispatcher1', $item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstanceWithPublicMethods(Dispatcher::class);
        $item2->setSetid(1);
        $item2->setDestination("sip:127.1.1.1:6060");
        $item2->setFlags(0);
        $item2->setPriority(0);
        $item2->setDescription("test001");
        $item2->setApplicationServer($this->getReference('_reference_ProviderApplicationServer2'));
        $this->addReference('_reference_KamDispatcher2', $item2);
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
