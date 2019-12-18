<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\Lifecycle;

use Ivoz\Core\Application\Event\CommandWasExecuted;
use Ivoz\Core\Application\Service\CommandEventSubscriber;
use Ivoz\Core\Domain\Service\EntityEventSubscriber;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\Changelog\Changelog;
use Ivoz\Provider\Domain\Model\Commandlog\Commandlog;
use Psr\Log\LoggerInterface;

class CommandPersister
{
    protected $commandEventSubscriber;
    protected $entityEventSubscriber;
    protected $entityPersister;
    protected $logger;

    protected $latestCommandlog;

    public function __construct(
        CommandEventSubscriber $commandEventSubscriber,
        EntityEventSubscriber $entityEventSubscriber,
        EntityPersisterInterface $entityPersister,
        LoggerInterface $logger
    ) {
        $this->commandEventSubscriber = $commandEventSubscriber;
        $this->entityEventSubscriber = $entityEventSubscriber;
        $this->entityPersister = $entityPersister;
        $this->logger = $logger;
    }

    /**
     * @return void
     */
    public function persistEvents()
    {
        $entityEvents = $this
            ->entityEventSubscriber
            ->getEvents();

        if (empty($entityEvents)) {
            return;
        }

        $commandNum = $this
            ->commandEventSubscriber
            ->countEvents();

        if (!$this->latestCommandlog && !$commandNum) {
            $this->registerFallbackCommand();
        }

        $command = $this
            ->commandEventSubscriber
            ->popEvent();

        if ($command) {
            $commandlog = Commandlog::fromEvent($command);
            $this->latestCommandlog = $commandlog;
            $this->entityPersister->persist($commandlog);

            $this->logger->info(
                sprintf(
                    '%s > %s::%s(%s)',
                    (new \ReflectionClass($command))->getShortName(),
                    $commandlog->getClass(),
                    $commandlog->getMethod(),
                    json_encode($commandlog->getArguments())
                )
            );
        } else {
            /**
             * Command is null when first persisted entity comes from pre_persist event:
             * changelog will require to hit db twice
             */
            $command = $this
                ->commandEventSubscriber
                ->getLatest();

            $commandlog = $this->latestCommandlog;
        }

        $this
            ->entityEventSubscriber
            ->clearEvents();

        foreach ($entityEvents as $event) {
            $changeLog = Changelog::fromEvent($event);
            $changeLog->setCommand($commandlog);
            $this->entityPersister->persist($changeLog);

            $data = json_encode($changeLog->getData());
            if (strlen($data) > 140) {
                $data = substr($data, 0, 140) . '...';
            }

            $this->logger->info(
                sprintf(
                    '%s > %s#%s > %s',
                    (new \ReflectionClass($event))->getShortName(),
                    $changeLog->getEntity(),
                    $changeLog->getEntityId(),
                    $data
                )
            );
        }

        $this->entityPersister->dispatchQueued();
    }

    /**
     * @return CommandWasExecuted
     * @throws \Exception
     */
    private function registerFallbackCommand(): CommandWasExecuted
    {
        $command = new CommandWasExecuted(
            0,
            'Unregistered',
            'Unregistered',
            [],
            []
        );

        $this
            ->commandEventSubscriber
            ->handle($command);

        return $command;
    }
}
