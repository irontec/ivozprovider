<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\ApplicationServerSet\ApplicationServerSet;

class ProviderApplicationServerSet extends Fixture implements FixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(ApplicationServerSet::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
        $manager->getConnection()->exec(
            'INSERT INTO ApplicationServerSets (id, name, distributeMethod, description) VALUES (0, "default", "hash", "Default application server set")'
        );

        $item1 = $this->createEntityInstance(ApplicationServerSet::class);
        (function () use ($fixture) {
            $this->setName('BlueApSet');
            $this->setDistributeMethod('hash');
            $this->setDescription('An Application Server Set');
        })->call($item1);

        $this->addReference('_reference_ProviderApplicationServerSet1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstance(ApplicationServerSet::class);
        (function () use ($fixture) {
            $this->setName('GreenApSet');
            $this->setDistributeMethod('rr');
            $this->setDescription('Another Application Server Set');
        })->call($item2);

        $this->addReference('_reference_ProviderApplicationServerSet2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        $manager->flush();
    }
}
