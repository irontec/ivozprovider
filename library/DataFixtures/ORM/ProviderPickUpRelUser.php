<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
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
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(PickUpRelUser::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        /** @var PickUpRelUser $item1 */
        $item1 = $this->createEntityInstance(PickUpRelUser::class);
        $item1->setPickUpGroup(
            $this->getReference('_reference_ProviderPickUpGroup1')
        );
        $item1->setUser(
            $this->getReference('_reference_ProviderUser1')
        );
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
