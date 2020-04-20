<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\ProxyTrunksRelBrand\ProxyTrunksRelBrand;

class ProviderProxyTrunkRelBrand extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(ProxyTrunksRelBrand::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $item1 = $this->createEntityInstance(ProxyTrunksRelBrand::class);
        (function () use ($fixture) {
            $this->setBrand(
                $fixture->getReference('_reference_ProviderBrand1')
            );
            $this->setProxyTrunk(
                $fixture->getReference('_reference_ProviderProxyTrunk1')
            );
        })->call($item1);

        $this->addReference('_reference_ProviderProxyTrunksRelBrand1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderProxyTrunk::class,
            ProviderBrand::class,
        );
    }
}
