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
        $this->mockInfraestructureServices();
    }

    protected function mockInfraestructureServices($expectedCallNumber = null)
    {
        $kernel = self::$kernel;
        $serviceContainer = $kernel->getContainer();

        $sendUsersDispatcherReloadRequest = $this
            ->getMockBuilder(SendUsersDispatcherReloadRequest::class)
            ->disableOriginalConstructor()
            ->getMock();

        $expectedUsersCallMatcher = $expectedCallNumber
            ? $this->exactly($expectedCallNumber)
            : $this->any();

        $sendUsersDispatcherReloadRequest
            ->expects($expectedUsersCallMatcher)
            ->method('execute');

        $sendTrunksDispatcherReloadRequest = $this
            ->getMockBuilder(SendTrunksDispatcherReloadRequest::class)
            ->disableOriginalConstructor()
            ->getMock();

        $expectedTrunksCallMatcher = $expectedCallNumber
            ? $this->exactly($expectedCallNumber)
            : $this->any();

        $sendTrunksDispatcherReloadRequest
            ->expects($expectedTrunksCallMatcher)
            ->method('execute');

        $onCommitService = $serviceContainer->get('provider.lifecycle.application_server.on_commit');
        $onCommitServiceRef = new \ReflectionClass($onCommitService);
        $serviceProperty = $onCommitServiceRef->getProperty('services');
        $serviceProperty->setAccessible(true);

        $serviceProperty->setValue(
            $onCommitService,
            [
                $sendUsersDispatcherReloadRequest,
                $sendTrunksDispatcherReloadRequest
            ]
        );
        $serviceProperty->setAccessible(false);
        $serviceContainer->set('provider.lifecycle.application_server.on_commit', $onCommitService);

        return $this;
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
        $as = $this->entityTools
            ->persistDto($asDto, null, true);

        return $as;
    }

    /**
     * @test
     */
    public function it_persists_applicationServers()
    {
        $asRepository = $this->em
            ->getRepository(ApplicationServer::class);
        $fixtureApplicationServers = $asRepository->findAll();
        $this->assertCount(2, $fixtureApplicationServers);

        $this
            ->addApplicationServer();

        $brands = $asRepository->findAll();
        $this->assertCount(3, $brands);
    }

    /**
     * @test
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
                'flags' => '0',
                'priority' => '0',
                'description' => 'test002',
                'applicationServerId' => 3,
                'id' => 3,
            ]
        );
    }

    /**
     * @test
     */
    public function updating_applicationServer_updates_kamDispatcher()
    {
        $as = $this->addApplicationServer();
        $as->setName('UpdatedName')
            ->setIp('127.2.2.127');

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
     */
    public function creating_applicationServer_fires_dispatcherReloadRequest()
    {
        $this->mockInfraestructureServices(2);

        $as = $this->addApplicationServer();
        $as->setName('UpdatedName')
            ->setIp('127.2.2.127');

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
     */
    public function updating_applicationServer_fires_dispatcherReloadRequest()
    {
        $this->mockInfraestructureServices(1);

        $applicationServerRepository = $this->em->getRepository(ApplicationServer::class);
        /** @var ApplicationServer $as */
        $as = $applicationServerRepository->find(1);
        $as->setName('Something');

        $this->entityTools->persist($as, true);
    }

    /**
     * @test
     */
    public function deleting_applicationServer_fires_dispatcherReloadRequest()
    {
        $this->mockInfraestructureServices(1);

        $applicationServerRepository = $this->em->getRepository(ApplicationServer::class);
        $as = $applicationServerRepository->find(1);
        $this->entityTools->remove($as);
    }
}