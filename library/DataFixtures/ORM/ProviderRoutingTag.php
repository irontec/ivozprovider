<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\RoutingTag\RoutingTag;

class ProviderRoutingTag extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager
            ->getClassMetadata(RoutingTag::class)
            ->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $item1 = $this->createEntityInstance(RoutingTag::class);
        (function () use ($fixture) {
            $this->setName("TagName");
            $this->setTag('123#');
            $this->setBrand(
                $fixture->getReference('_reference_ProviderBrand1')
            );
        })->call($item1);

        $this->addReference('_reference_ProviderRoutingTag1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $item2 = $this->createEntityInstance(RoutingTag::class);
        (function () use ($fixture) {
            $this->setName("Routing Tag Two");
            $this->setTag('234#');
            $this->setBrand(
                $fixture->getReference('_reference_ProviderBrand1')
            );
        })->call($item2);

        $this->addReference('_reference_ProviderRoutingTag2', $item2);
        $this->sanitizeEntityValues($item2);
        $manager->persist($item2);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderBrand::class
        );
    }
}
