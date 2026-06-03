<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\FeaturesRelCompany\FeaturesRelCompany;

class ProviderFeaturesRelCompany extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(FeaturesRelCompany::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $item1 = $this->createEntityInstance(FeaturesRelCompany::class);
        (function () use ($fixture) {
            $this->setCompany($fixture->getReference('_reference_ProviderCompany1'));
            $this->setFeature($fixture->getReference('_reference_ProviderFeature1'));
        })->call($item1);

        $this->addReference('_reference_ProviderFeaturesRelCompany1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstance(FeaturesRelCompany::class);
        (function () use ($fixture) {
            $this->setCompany($fixture->getReference('_reference_ProviderCompany1'));
            $this->setFeature($fixture->getReference('_reference_ProviderFeature2'));
        })->call($item2);

        $this->addReference('_reference_ProviderFeaturesRelCompany2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        $item3 = $this->createEntityInstance(FeaturesRelCompany::class);
        (function () use ($fixture) {
            $this->setCompany($fixture->getReference('_reference_ProviderCompany1'));
            $this->setFeature($fixture->getReference('_reference_ProviderFeature3'));
        })->call($item3);

        $this->addReference('_reference_ProviderFeaturesRelCompany3', $item3);
        $this->sanitizeEntityValues($item3);
        $manager->persist($item3);

        $item4 = $this->createEntityInstance(FeaturesRelCompany::class);
        (function () use ($fixture) {
            $this->setCompany($fixture->getReference('_reference_ProviderCompany1'));
            $this->setFeature($fixture->getReference('_reference_ProviderFeature4'));
        })->call($item4);

        $this->addReference('_reference_ProviderFeaturesRelCompany4', $item4);
        $this->sanitizeEntityValues($item4);
        $manager->persist($item4);

        $item5 = $this->createEntityInstance(FeaturesRelCompany::class);
        (function () use ($fixture) {
            $this->setCompany($fixture->getReference('_reference_ProviderCompany1'));
            $this->setFeature($fixture->getReference('_reference_ProviderFeature5'));
        })->call($item5);

        $this->addReference('_reference_ProviderFeaturesRelCompany5', $item5);
        $this->sanitizeEntityValues($item5);
        $manager->persist($item5);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderCompany::class,
            ProviderFeature::class
        );
    }
}
