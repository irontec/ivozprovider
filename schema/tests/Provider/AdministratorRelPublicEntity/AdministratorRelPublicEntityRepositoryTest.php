<?php

namespace Tests\Provider\AdministratorRelPublicEntity;

use Ivoz\Provider\Domain\Model\Administrator\Administrator;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorInterface;
use Ivoz\Provider\Domain\Model\Administrator\AdministratorRepository;
use Ivoz\Provider\Domain\Model\AdministratorRelPublicEntity\AdministratorRelPublicEntity;
use Ivoz\Provider\Domain\Model\AdministratorRelPublicEntity\AdministratorRelPublicEntityRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;

class AdministratorRelPublicEntityRepositoryTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait {
        enableChangelog as _enableChangelog;
    }

    /**
     * @test
     */
    public function test_runner()
    {
        $this->its_instantiable();
        $this->it_sets_write_permissions();
        $this->it_sets_readOnly_permissions();
        $this->it_finds_by_admin_id();
    }

    /**
     * @return self
     */
    protected function enableChangelog(string $commandName = null)
    {
        if (!$commandName) {
            $commandName = 'AdminRelPublicEntityRepositoryTest';
        }

        $this->_enableChangelog($commandName);
    }

    public function its_instantiable()
    {
        /** @var AdministratorRelPublicEntityRepository $administratorRelPublicEntityRepository */
        $administratorRelPublicEntityRepository = $this
            ->em
            ->getRepository(AdministratorRelPublicEntity::class);

        $this->assertInstanceOf(
            AdministratorRelPublicEntityRepository::class,
            $administratorRelPublicEntityRepository
        );
    }

    public function it_sets_write_permissions()
    {
        /** @var AdministratorRelPublicEntityRepository $administratorRelPublicEntityRepository */
        $administratorRelPublicEntityRepository = $this
            ->em
            ->getRepository(AdministratorRelPublicEntity::class);

        $admin = $this->getAdmin();

        $administratorRelPublicEntityRepository
            ->setReadOnlyPermissions($admin);
        $this
            ->resetChangelog();

        $affectedRows = $administratorRelPublicEntityRepository
            ->setWritePermissions($admin);

        $this->assertGreaterThan(
            1,
            $affectedRows
        );

        $changes = $this->getChangelogByClass(
            AdministratorRelPublicEntity::class
        );

        $this->assertNotEmpty($changes);
    }

    public function it_sets_readOnly_permissions()
    {
        /** @var AdministratorRelPublicEntityRepository $administratorRelPublicEntityRepository */
        $administratorRelPublicEntityRepository = $this
            ->em
            ->getRepository(AdministratorRelPublicEntity::class);

        $admin = $this->getAdmin();

        $administratorRelPublicEntityRepository
            ->setWritePermissions($admin);
        $this
            ->resetChangelog();

        $affectedRows = $administratorRelPublicEntityRepository
            ->setReadOnlyPermissions($admin);

        $this->assertGreaterThan(
            1,
            $affectedRows
        );

        $changes = $this->getChangelogByClass(
            AdministratorRelPublicEntity::class
        );

        $this->assertNotEmpty($changes);
    }

    public function it_finds_by_admin_id()
    {
        /** @var AdministratorRelPublicEntityRepository $administratorRelPublicEntityRepository */
        $administratorRelPublicEntityRepository = $this
            ->em
            ->getRepository(AdministratorRelPublicEntity::class);

        $response = $administratorRelPublicEntityRepository->getByAdministratorId(7);

        $this->assertIsArray(
            $response
        );

        $this->assertGreaterThanOrEqual(
            1,
            count($response)
        );

        $this->assertInstanceOf(
            AdministratorRelPublicEntity::class,
            $response[0]
        );
    }

    private function getAdmin(int $id = 5): AdministratorInterface
    {
        /** @var AdministratorRepository $administratorRepository */
        $administratorRepository = $this
            ->em
            ->getRepository(Administrator::class);

        return $administratorRepository->find($id);
    }
}
