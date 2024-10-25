<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\Persistence\ObjectManager;
use Ivoz\Provider\Domain\Model\ApplicationServerSet\ApplicationServerSet;
use Ivoz\Provider\Domain\Model\ApplicationServerSetsRelBrand\ApplicationServerSetsRelBrand;

class ProviderApplicationServerSetsRelBrand extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(ApplicationServerSetsRelBrand::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $item1 = $this->createEntityInstance(ApplicationServerSetsRelBrand::class);
        (function () use ($fixture) {
            $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
            $this->setApplicationServerSet($fixture->getReference('_reference_ProviderApplicationServerSet0'));
        })->call($item1);

        $this->addReference('_reference_ProviderApplicationServerSetsRelBrand1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstance(ApplicationServerSetsRelBrand::class);
        (function () use ($fixture) {
            $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
            $this->setApplicationServerSet($fixture->getReference('_reference_ProviderApplicationServerSet1'));
        })->call($item2);

        $this->addReference('_reference_ProviderApplicationServerSetsRelBrand2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        $item3 = $this->createEntityInstance(ApplicationServerSetsRelBrand::class);
        (function () use ($fixture) {
            $this->setBrand($fixture->getReference('_reference_ProviderBrand2'));
            $this->setApplicationServerSet($fixture->getReference('_reference_ProviderApplicationServerSet0'));
        })->call($item3);

        $this->addReference('_reference_ProviderApplicationServerSetsRelBrand3', $item3);
        $this->sanitizeEntityValues($item3);
        $manager->persist($item3);

        $item4 = $this->createEntityInstance(ApplicationServerSetsRelBrand::class);
        (function () use ($fixture) {
            $this->setBrand($fixture->getReference('_reference_ProviderBrand3'));
            $this->setApplicationServerSet($fixture->getReference('_reference_ProviderApplicationServerSet0'));
        })->call($item4);

        $this->addReference('_reference_ProviderApplicationServerSetsRelBrand4', $item4);
        $this->sanitizeEntityValues($item4);
        $manager->persist($item4);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProviderBrand::class,
            ProviderApplicationServerSet::class,
        ];
    }
}
