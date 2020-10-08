<?php

namespace DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Ivoz\Provider\Domain\Model\Administrator\Administrator;

class ProviderAdministratorRelPublicEntities extends Fixture implements DependentFixtureInterface
{
    use \DataFixtures\FixtureHelperTrait;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $fixture = $this;
        $this->disableLifecycleEvents($manager);
        $manager->getClassMetadata(Administrator::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $manager
            ->getConnection()
            ->exec(
                'INSERT INTO AdministratorRelPublicEntities (administratorId, publicEntityId, `create`, `read`, `update`, `delete`) '
                . 'SELECT A.id, P.id, 0, 1, 0, 0 FROM Administrators A INNER JOIN PublicEntities P '
                . 'WHERE A.companyId IS NOT NULL AND A.restricted = 1 AND P.client = 1'
            );

        $manager
            ->getConnection()
            ->exec(
                'INSERT INTO AdministratorRelPublicEntities (administratorId, publicEntityId, `create`, `read`, `update`, `delete`) '
                . 'SELECT A.id, P.id, 0, 1, 0, 0 FROM Administrators A INNER JOIN PublicEntities P '
                . 'WHERE A.brandId IS NOT NULL AND A.companyId IS NULL AND A.restricted = 1 AND P.brand = 1'
            );

        $manager
            ->getConnection()
            ->exec(
                'INSERT INTO AdministratorRelPublicEntities (administratorId, publicEntityId, `create`, `read`, `update`, `delete`) '
                . 'SELECT A.id, P.id, 0, 1, 0, 0 FROM Administrators A INNER JOIN PublicEntities P '
                . 'WHERE A.brandId IS NULL AND A.companyId IS NULL AND A.restricted = 1 AND P.platform = 1'
            );
    }

    public function getDependencies()
    {
        return [
            ProviderAdministrator::class,
            ProviderPublicEntities::class
        ];
    }
}
