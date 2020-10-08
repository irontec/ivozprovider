<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\PickUpGroup\PickUpGroup;

class ProviderPickUpGroup extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(PickUpGroup::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var PickUpGroup $item1 */
        $item1 = $this->createEntityInstance(PickUpGroup::class);
        (function () use ($fixture) {
            $this->setName('pick up group');
            $this->setCompany(
                $fixture->getReference('_reference_ProviderCompany1')
            );
        })->call($item1);

        $this->addReference('_reference_ProviderPickUpGroup1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderCompany::class
        );
    }
}
