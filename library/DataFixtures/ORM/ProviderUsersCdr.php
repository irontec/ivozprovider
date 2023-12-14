<?php

namespace DataFixtures\ORM;

use DataFixtures\Stub\Provider\UsersCdrStub;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\UsersCdr\UsersCdr;

class ProviderUsersCdr extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    public function __construct(
        private UsersCdrStub $usersCdrStub,
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $this->disableLifecycleEvents($manager);
        $manager
            ->getClassMetadata(UsersCdr::class)
            ->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $entities = $this->usersCdrStub->getAll();
        foreach ($entities as $entity) {
            $this->addReference(
                '_reference_UsersCdr' . $entity->getId(),
                $entity
            );
            $manager->persist($entity);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            ProviderBrand::class,
            ProviderCompany::class,
            ProviderExtension::class,
            ProviderUser::class,
        );
    }
}
