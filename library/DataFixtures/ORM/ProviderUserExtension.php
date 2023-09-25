<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\User\User;
use Ivoz\Provider\Domain\Model\User\UserInterface;

class ProviderUserExtension extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);

        $userRepository = $manager->getRepository(User::class);
        /** @var UserInterface $bob */
        $bob = $userRepository->find(3);

        $bob->setExtension(
            $this->getReference('_reference_ProviderExtension2')
        );

        $manager->persist($bob);
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderUser::class,
            ProviderExtension::class,
        );
    }
}
