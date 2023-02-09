<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\Feature\Feature;
use Ivoz\Provider\Domain\Model\Feature\Name;

class ProviderFeature extends Fixture
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(Feature::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $item1 = $this->createEntityInstance(Feature::class);
        (function () use ($fixture) {
            $this->setIden("queues");
            $this->name = new Name('en', 'es', 'ca', 'it');
        })->call($item1);

        $this->addReference('_reference_ProviderFeature1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstance(Feature::class);
        (function () use ($fixture) {
            $this->setIden("recordings");
            $this->name = new Name('en', 'es', 'ca', 'it');
        })->call($item2);

        $this->addReference('_reference_ProviderFeature2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        $item3 = $this->createEntityInstance(Feature::class);
        (function () use ($fixture) {
            $this->setIden("faxes");
            $this->name = new Name('en', 'es', 'ca', 'it');
        })->call($item3);

        $this->addReference('_reference_ProviderFeature3', $item3);
        $this->sanitizeEntityValues($item3);
        $manager->persist($item3);

        $item4 = $this->createEntityInstance(Feature::class);
        (function () use ($fixture) {
            $this->setIden("friends");
            $this->name = new Name('en', 'es', 'ca', 'it');
        })->call($item4);

        $this->addReference('_reference_ProviderFeature4', $item4);
        $this->sanitizeEntityValues($item4);
        $manager->persist($item4);

        $item5 = $this->createEntityInstance(Feature::class);
        (function () use ($fixture) {
            $this->setIden("conferences");
            $this->name = new Name('en', 'es', 'ca', 'it');
        })->call($item5);

        $this->addReference('_reference_ProviderFeature5', $item5);
        $this->sanitizeEntityValues($item5);
        $manager->persist($item5);

        $item6 = $this->createEntityInstance(Feature::class);
        (function () use ($fixture) {
            $this->setIden("billing");
            $this->name = new Name('en', 'es', 'ca', 'it');
        })->call($item6);

        $this->addReference('_reference_ProviderFeature6', $item6);
        $this->sanitizeEntityValues($item6);
        $manager->persist($item6);

        $item7 = $this->createEntityInstance(Feature::class);
        (function () use ($fixture) {
            $this->setIden("invoices");
            $this->name = new Name('en', 'es', 'ca', 'it');
        })->call($item7);

        $this->addReference('_reference_ProviderFeature7', $item7);
        $this->sanitizeEntityValues($item7);
        $manager->persist($item7);

        $item8 = $this->createEntityInstance(Feature::class);
        (function () use ($fixture) {
            $this->setIden("progress");
            $this->name = new Name('en', 'es', 'ca', 'it');
        })->call($item8);

        $this->addReference('_reference_ProviderFeature8', $item8);
        $this->sanitizeEntityValues($item8);
        $manager->persist($item8);

        $item9 = $this->createEntityInstance(Feature::class);
        (function () use ($fixture) {
            $this->setIden("retail");
            $this->name = new Name('en', 'es', 'ca', 'it');
        })->call($item9);

        $this->addReference('_reference_ProviderFeature9', $item9);
        $this->sanitizeEntityValues($item9);
        $manager->persist($item9);


        $manager->flush();
    }
}
