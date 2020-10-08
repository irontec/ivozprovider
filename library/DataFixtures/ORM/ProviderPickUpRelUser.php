<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\PickUpRelUser\PickUpRelUser;

class ProviderPickUpRelUser extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(PickUpRelUser::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var PickUpRelUser $item1 */
        $item1 = $this->createEntityInstance(PickUpRelUser::class);
        (function () use ($fixture) {
            $this->setPickUpGroup(
                $fixture->getReference('_reference_ProviderPickUpGroup1')
            );
            $this->setUser(
                $fixture->getReference('_reference_ProviderUser1')
            );
        })->call($item1);

        $this->addReference('_reference_ProviderPickUpRelUser1', $item1);
        $this->sanitizeEntityValues($item1);
        $manager->persist($item1);
    
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderPickUpGroup::class,
            ProviderUser::class,
        );
    }
}
