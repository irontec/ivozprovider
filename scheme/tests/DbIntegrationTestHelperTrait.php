<?php

namespace Tests;

use Doctrine\ORM\EntityManager;
use Ivoz\Core\Application\Event\CommandWasExecuted;
use Ivoz\Core\Application\RequestId;
use Ivoz\Core\Domain\Service\DomainEventPublisher;
use Ivoz\Core\Domain\Service\EntityEventSubscriber;
use Ivoz\Provider\Domain\Model\Changelog\Changelog;
use Ivoz\Provider\Domain\Model\Changelog\ChangelogRepository;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpKernel\KernelInterface;
use Ivoz\Core\Application\Service\EntityTools;

trait DbIntegrationTestHelperTrait
{
    /**
     * @var KernelInterface
     */
    protected static $kernel;

    /**
     * @var ContainerInterface
     */
    protected $serviceContainer;

    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * @var DomainEventPublisher
     */
    protected $eventPublisher;

    /**
     * @var EntityEventSubscriber
     */
    protected $entityEventSubscriber;

    /**
     * @var string
     */
    protected $commandId;

    /**
     * @var ChangelogRepository|null
     */
    protected $changelogRepository;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $kernel = self::bootKernel();
        $this->serviceContainer = $kernel->getContainer();

        $this->em = $this
            ->serviceContainer
            ->get('doctrine')
            ->getManager();

        $this->eventPublisher = $this
            ->serviceContainer
            ->get(DomainEventPublisher::class);

        $this->entityTools = $this
            ->serviceContainer
            ->get(EntityTools::class);

        $this->entityEventSubscriber = $this
            ->serviceContainer
            ->get(EntityEventSubscriber::class);

        $this->resetDatabase();
        $this->enableChangelog();
    }

    /**
     * @return self
     */
    protected function enableChangelog()
    {
        $classSegments = explode('\\', self::class);

        $event = new CommandWasExecuted(
            (new RequestId)->toString(),
            end($classSegments),
            'setUp',
            []
        );

        $this->commandId = $event->getId();

        $this->eventPublisher
            ->publish($event);

        $this->changelogRepository = $this->em
            ->getRepository(Changelog::class);

        return $this;
    }

    /**
     * @param string $entityClass
     * @return Changelog[]
     */
    protected function getChangelog()
    {
        return $this
            ->changelogRepository
            ->findBy(['command' => $this->commandId]);
    }

    protected function resetChangelog()
    {
        //Reset changelog
        $this->resetEvents();

        // Register a new Command
        $this->enableChangelog();
    }

    protected function getChangedEntities()
    {
        $entities = [];
        $changelog = $this->getChangelog();

        foreach ($changelog as $item) {
            $entities[] = $item->getEntity();
        }

        return array_values(
            array_unique($entities)
        );
    }

    protected function assetChangedEntities(array $expected)
    {
        $changedEntities = $this->getChangedEntities();

        $this->assertEquals(
            $expected,
            $changedEntities
        );
    }

    /**
     * @param string $entityClass
     * @return Changelog[]
     */
    protected function getChangelogByClass(string $entityClass)
    {
        return $this
            ->changelogRepository
            ->findBy([
                'command' => $this->commandId,
                'entity' => $entityClass
            ]);
    }

    protected function resetDatabase()
    {
        $cacheDir = self::$kernel->getCacheDir();
        $fs = new Filesystem();

        $dbFile = $cacheDir . DIRECTORY_SEPARATOR . 'db.sqlite';

        if ($fs->exists($dbFile)) {
            $fs->remove($dbFile);
        }

        $fs->copy(
            $dbFile . '.back',
            $dbFile
        );
    }

    protected function resetEvents()
    {
        $this->entityEventSubscriber->clearEvents();
    }

    protected function assertSubset(
        Changelog $changelog,
        array $expectedSubset,
        array $excludedSubsetKeys = []
    ) {
        $diff = $changelog->getData();

        $this->assertArraySubset(
            $expectedSubset,
            $diff
        );

        $this->assertEquals(
            count(
                array_keys($diff)
            ),
            count(
                array_merge(
                    array_keys($expectedSubset),
                    $excludedSubsetKeys
                )
            )
        );
    }
}