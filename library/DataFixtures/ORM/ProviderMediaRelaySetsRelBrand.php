<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\Persistence\ObjectManager;
use Ivoz\Provider\Domain\Model\MediaRelaySetsRelBrand\MediaRelaySetsRelBrand;

class ProviderMediaRelaySetsRelBrand extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(MediaRelaySetsRelBrand::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);
        $manager->getConnection()->exec(
            'INSERT INTO MediaRelaySetsRelBrands (brandId, mediaRelaySetId) 
                SELECT id, 0 as mediaRelaySetId FROM brands'
        );

        $item1 = $this->createEntityInstance(MediaRelaySetsRelBrand::class);
        (function () use ($fixture) {
            $this->setBrand($fixture->getReference('_reference_ProviderBrand1'));
            $this->setMediaRelaySet($fixture->getReference('_reference_ProviderMediaRelaySet1'));
        })->call($item1);

        $this->addReference('_reference_ProviderMediaRelaySetsRelBrand1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProviderBrand::class,
            ProviderMediaRelaySet::class,
        ];
    }
}
