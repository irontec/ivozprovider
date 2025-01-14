<?php

namespace Tests\Provider\ApplicationServer;

use Ivoz\Kam\Domain\Model\Dispatcher\Dispatcher;
use Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServer;
use Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServerDto;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;

class ApplicationServerLifeCycleTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    protected function updateApplicationServer()
    {
        $applicationServerRepository = $this->em
            ->getRepository(ApplicationServer::class);

        $applicationServer = $applicationServerRepository->find(1);

        /** @var ApplicationServerDto $applicationServerDto */
        $applicationServerDto = $this->entityTools->entityToDto($applicationServer);

        $applicationServerDto
            ->setIp('127.3.3.3')
            ->setName('updated-name');

        return $this
            ->entityTools
            ->persistDto(
                $applicationServerDto,
                $applicationServer,
                true
            );
    }

    /**
     * @test
     */
    public function it_triggers_update_lifecycle_services()
    {
        $this->updateApplicationServer();
        $this->assetChangedEntities([
            ApplicationServer::class,
            Dispatcher::class,
        ]);
    }
}
