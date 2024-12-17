<?php

namespace Tests\Provider\ApplicationServerSetRelApplicationServer;

use Ivoz\Kam\Domain\Model\Dispatcher\Dispatcher;
use Ivoz\Provider\Domain\Model\ApplicationServerSetRelApplicationServer\ApplicationServerSetRelApplicationServer;
use Ivoz\Provider\Domain\Model\ApplicationServerSetRelApplicationServer\ApplicationServerSetRelApplicationServerDto;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Tests\DbIntegrationTestHelperTrait;

class RelApplicationServerLifeCycleTest extends KernelTestCase
{
    use DbIntegrationTestHelperTrait;

    /**
     * @test
     */
    public function it_persists_relApplicationServer()
    {
        $asRepository = $this->em
            ->getRepository(ApplicationServerSetRelApplicationServer::class);
        $fixtureRelApplicationServer = $asRepository->findAll();
        $this->addApplicationServerToSet();

        $brands = $asRepository->findAll();
        $this->assertCount(count($fixtureRelApplicationServer) + 1, $brands);

        $this->it_triggers_lifecycle_services();
        $this->added_applicationServer_has_kamDispatcher();
    }

    protected function addApplicationServerToSet(): ApplicationServerSetRelApplicationServer
    {
        $relApplicationServerDto = new ApplicationServerSetRelApplicationServerDto();
        $relApplicationServerDto
            ->setApplicationServerId(4)
            ->setApplicationServerSetId(2);

        /** @var ApplicationServerSetRelApplicationServer */
        return $this->entityTools
            ->persistDto(
                $relApplicationServerDto,
                null,
                true,
            );
    }

    protected function removeApplicationServerSetRelApplicationServer(int $id)
    {
        $dispatcherRepository = $this
            ->em
            ->getRepository(
                Dispatcher::class
            );

        $relApplicationServerRepository = $this->em
            ->getRepository(ApplicationServerSetRelApplicationServer::class);

        $setRelAs = $relApplicationServerRepository->find($id);

        $this->em->remove($setRelAs);
        $this->em->flush(null);
    }

    protected function it_triggers_lifecycle_services()
    {
        $this->assetChangedEntities([
            ApplicationServerSetRelApplicationServer::class,
            Dispatcher::class,
        ]);
    }

    protected function added_applicationServer_has_kamDispatcher()
    {
        /** @var Changelog[] $changelogEntries */
        $changelogEntries = $this->getChangelogByClass(
            Dispatcher::class
        );

        $this->assertCount(1, $changelogEntries);
        $changelog = $changelogEntries[0];

        $this->assertEquals(
            $changelog->getData(),
            [
                'setid' => 2,
                'destination' => 'sip:127.1.1.4:6060',
                'flags' => 0,
                'priority' => 0,
                'attrs' => '',
                'description' => 'test004',
                'applicationServerSetRelApplicationServerId' => 7,
                'id' => 4,
            ]
        );
    }

    /**
     * @test
     */
    public function it_cascade_delete_kam_dispatcher()
    {
        $dispatcherRepository = $this
            ->em
            ->getRepository(
                Dispatcher::class
            );

        $relApplicationServerId = 5;
        $dispatcher = $dispatcherRepository->findOneBy([
            'applicationServerSetRelApplicationServer' => $relApplicationServerId
        ]);

        $this->assertNotNull($dispatcher);

        $this->removeApplicationServerSetRelApplicationServer(
            $relApplicationServerId
        );

        $dispatcher = $dispatcherRepository->findOneBy([
            'applicationServerSetRelApplicationServer' => $relApplicationServerId
        ]);

        $this->assertNull($dispatcher);
    }
}
