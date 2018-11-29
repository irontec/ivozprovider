<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
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
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(PickUpGroup::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var PickUpGroup $item1 */
        $item1 = $this->createEntityInstance(PickUpGroup::class);
        (function () {
            $this->setName('pick up group');
        })->call($item1);

        $item1->setCompany(
            $this->getReference('_reference_ProviderCompany1')
        );
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
