<?php

namespace Tests;

use Doctrine\ORM\EntityManager;
use Ivoz\Core\Application\Event\CommandWasExecuted;
use Ivoz\Core\Application\RequestId;
use Ivoz\Core\Domain\Service\DomainEventPublisher;
use Ivoz\Core\Infrastructure\Domain\Service\DoctrineEntityPersister;
use Ivoz\Provider\Domain\Model\Changelog\Changelog;
use Ivoz\Provider\Domain\Model\Changelog\ChangelogRepository;
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
        $serviceContainer = $kernel->getContainer();

        $this->em = $serviceContainer
            ->get('doctrine')
            ->getManager();

        $this->eventPublisher = $serviceContainer
            ->get(DomainEventPublisher::class);

        $this->entityTools = $serviceContainer
            ->get(EntityTools::class);

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
}