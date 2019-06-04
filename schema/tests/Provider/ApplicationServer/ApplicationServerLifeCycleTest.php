<?php

namespace Tests\Provider\ApplicationServer;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;
use Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServer;
use Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServerDto;
use Ivoz\Kam\Domain\Model\Dispatcher\Dispatcher;
use Ivoz\Provider\Infrastructure\Domain\Service\ApplicationServer\SendUsersDispatcherReloadRequest;
use Ivoz\Provider\Infrastructure\Domain\Service\ApplicationServer\SendTrunksDispatcherReloadRequest;

class ApplicationServerLifeCycleTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait {
        setUp as protected _setUp;
    }

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->_setUp(...func_get_args());
        $this->mockInfraestructureServices(
            'provider.lifecycle.application_server.on_commit',
            [
                SendUsersDispatcherReloadRequest::class,
                SendTrunksDispatcherReloadRequest::class
            ]
        );
    }

    /**
     * @return ApplicationServer
     */
    protected function addApplicationServer()
    {
        $asDto = new ApplicationServerDto();
        $asDto
            ->setIp('127.2.2.2')
            ->setName('test002');

        /** @var ApplicationServer $as */
        $as = $this
            ->entityTools
            ->persistDto($asDto, null, true);

        return $as;
    }

    protected function updateApplicationServer()
    {
        $applicationServerRepository = $this->em
            ->getRepository(ApplicationServer::class);

        $applicationServer = $applicationServerRepository->find(1);

        /** @var ApplicationServerDto $applicationServerDto */
        $applicationServerDto = $this->entityTools->entityToDto($applicationServer);

        $applicationServerDto
            ->setIp('127.3.3.3');

        return $this
            ->entityTools
            ->persistDto($applicationServerDto, $applicationServer, true);
    }

    protected function removeApplicationServer()
    {
        $applicationServerRepository = $this->em
            ->getRepository(ApplicationServer::class);

        $applicationServer = $applicationServerRepository->find(1);

        $this
            ->entityTools
            ->remove($applicationServer);
    }

    /**
     * @test
     */
    public function it_persists_applicationServers()
    {
        $asRepository = $this->em
            ->getRepository(ApplicationServer::class);
        $fixtureApplicationServers = $asRepository->findAll();
        $this->addApplicationServer();

        $brands = $asRepository->findAll();
        $this->assertCount(count($fixtureApplicationServers) + 1, $brands);
    }

    /**
     * @test
     */
    public function it_triggers_lifecycle_services()
    {
        $this->addApplicationServer();
        $this->assetChangedEntities([
            ApplicationServer::class,
            Dispatcher::class,
        ]);
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

    /**
     * @test
     */
    public function it_triggers_remove_lifecycle_services()
    {
        $this->removeApplicationServer();
        $this->assetChangedEntities([
            ApplicationServer::class
        ]);
    }

    //////////////////////////////////////////
    //
    //////////////////////////////////////////

    /**
     * @test
     * @deprecated
     */
    public function added_applicationServer_has_kamDispatcher()
    {
        $this->addApplicationServer();

        /** @var Changelog[] $changelogEntries */
        $changelogEntries = $this->getChangelogByClass(
            Dispatcher::class
        );

        $this->assertCount(1, $changelogEntries);
        $changelog = $changelogEntries[0];

        $this->assertEquals(
            $changelog->getData(),
            [
                'setid' => 1,
                'destination' => 'sip:127.2.2.2:6060',
                'flags' => 0,
                'priority' => 0,
                'attrs' => '',
                'description' => 'test002',
                'applicationServerId' => 3,
                'id' => 3,
            ]
        );
    }

    /**
     * @test
     * @deprecated
     */
    public function updating_applicationServer_updates_kamDispatcher()
    {
        $as = $this->addApplicationServer();
        (function () {
            $this
                ->setName('UpdatedName')
                ->setIp('127.2.2.127');
        })->call($as);

        $kamDispatcherRepository = $this->em->getRepository(Dispatcher::class);
        $kamDispatcher = $kamDispatcherRepository->findOneBy([
            'applicationServer' => $as->getId()
        ]);
        $this->assertInstanceOf(
            Dispatcher::class,
            $kamDispatcher
        );

        $this->entityTools->persist($as, true);

        $this->assertEquals(
            $kamDispatcher->getDestination(),
            'sip:' . $as->getIp() . ":6060"
        );

        $this->assertEquals(
            $kamDispatcher->getDescription(),
            $as->getName()
        );

        $this->assertEquals(
            $kamDispatcher->getSetid(),
            1
        );
    }

    /**
     * @test
     * @deprecated
     */
    public function creating_applicationServer_fires_dispatcherReloadRequest()
    {
        $this->mockInfraestructureServices(
            'provider.lifecycle.application_server.on_commit',
            [
                SendUsersDispatcherReloadRequest::class,
                SendTrunksDispatcherReloadRequest::class
            ],
            2
        );

        $as = $this->addApplicationServer();
        (function () {
            $this->setName('UpdatedName')
                 ->setIp('127.2.2.127');
        })->call($as);

        $kamDispatcherRepository = $this->em->getRepository(Dispatcher::class);
        $kamDispatcher = $kamDispatcherRepository->findOneBy([
            'applicationServer' => $as->getId()
        ]);
        $this->assertInstanceOf(
            Dispatcher::class,
            $kamDispatcher
        );

        $this->entityTools->persist($as, true);
    }

    /**
     * @test
     * @deprecated
     */
    public function updating_applicationServer_fires_dispatcherReloadRequest()
    {
        $this->mockInfraestructureServices(
            'provider.lifecycle.application_server.on_commit',
            [
                SendUsersDispatcherReloadRequest::class,
                SendTrunksDispatcherReloadRequest::class
            ],
            1
        );

        $applicationServerRepository = $this->em->getRepository(ApplicationServer::class);
        /** @var ApplicationServer $as */
        $as = $applicationServerRepository->find(1);
        (function () {
            $this->setName('Something');
        })->call($as);

        $this->entityTools->persist($as, true);
    }

    /**
     * @test
     * @deprecated
     */
    public function deleting_applicationServer_fires_dispatcherReloadRequest()
    {
        $this->mockInfraestructureServices(
            'provider.lifecycle.application_server.on_commit',
            [
                SendUsersDispatcherReloadRequest::class,
                SendTrunksDispatcherReloadRequest::class
            ],
            1
        );

        $applicationServerRepository = $this->em->getRepository(ApplicationServer::class);
        $as = $applicationServerRepository->find(1);
        $this->entityTools->remove($as);
    }
}
