<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\Lifecycle;

use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Event\OnFlushEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Events;
use Doctrine\ORM\PersistentCollection;
use Ivoz\Core\Application\Helper\EntityClassHelper;
use Ivoz\Core\Application\Helper\LifecycleServiceHelper;
use Ivoz\Core\Domain\Event\EntityWasCreated;
use Ivoz\Core\Domain\Event\EntityWasDeleted;
use Ivoz\Core\Domain\Event\EntityWasUpdated;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Model\LoggerEntityInterface;
use Ivoz\Core\Domain\Service\CommonLifecycleServiceCollection;
use Ivoz\Core\Domain\Service\DomainEventPublisher;
use Ivoz\Core\Domain\Service\LifecycleEventHandlerInterface;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\Events as CustomEvents;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\OnCommitEventArgs;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\OnErrorEventArgs;
use Symfony\Component\DependencyInjection\ContainerInterface;

class DoctrineEventSubscriber implements EventSubscriber
{
    const UnaccesibleChangeset = 'Unaccesible changeset';

    protected $em;
    protected $serviceContainer;
    protected $eventPublisher;
    protected $commandPersister;
    protected $forcedEntityChangeLog;

    /**
     * @var EntityInterface[]
     */
    protected $flushedEntities = [];

    public function __construct(
        ContainerInterface $serviceContainer,
        EntityManagerInterface $em,
        DomainEventPublisher $eventPublisher,
        CommandPersister $commandPersister,
        bool $forcedEntityChangeLog = false
    ) {
        $this->serviceContainer = $serviceContainer;
        $this->em = $em;
        $this->eventPublisher = $eventPublisher;
        $this->commandPersister = $commandPersister;
        $this->forcedEntityChangeLog = $forcedEntityChangeLog;
    }

    public function getSubscribedEvents()
    {
        return [
            Events::prePersist,
            Events::postPersist,

            Events::preUpdate,
            Events::postUpdate,

            Events::preRemove,
            Events::postRemove,

            Events::onFlush,
            Events::postLoad,

            CustomEvents::preCommit,
            CustomEvents::onCommit,
            CustomEvents::onError
        ];
    }

    /**
     * @return void
     */
    public function postLoad(LifecycleEventArgs $args)
    {
        $object = $args->getObject();
        if ($object instanceof EntityInterface) {
            $object->initChangelog();
        }
    }

    /**
     * @return void
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $this->run('pre_persist', $args, true);
    }

    /**
     * @return void
     */
    public function postPersist(LifecycleEventArgs $args)
    {
        $this->run('post_persist', $args, true);
    }

    /**
     * @return void
     */
    public function preUpdate(PreUpdateEventArgs $args)
    {
        $this->run('pre_persist', $args);
    }

    /**
     * @return void
     */
    public function postUpdate(LifecycleEventArgs $args)
    {
        $this->run('post_persist', $args);
    }

    /**
     * @return void
     */
    public function preRemove(LifecycleEventArgs $args)
    {
        $this->run('pre_remove', $args);
    }

    /**
     * @return void
     */
    public function postRemove(LifecycleEventArgs $args)
    {
        $this->run('post_remove', $args);
    }

    /**
     * @return void
     */
    public function onFlush(OnFlushEventArgs $eventArgs)
    {
        $em = $eventArgs->getEntityManager();
        $uow = $em->getUnitOfWork();

        foreach ($uow->getScheduledEntityInsertions() as $entity) {
            $this->flushedEntities[] = $entity;
        }

        foreach ($uow->getScheduledEntityUpdates() as $entity) {
            $this->flushedEntities[] = $entity;
        }

        foreach ($uow->getScheduledEntityDeletions() as $entity) {
            $this->flushedEntities[] = $entity;
        }

        /** @var PersistentCollection $col */
        foreach ($uow->getScheduledCollectionDeletions() as $col) {
            foreach ($col->unwrap()->toArray() as $entity) {
                $this->flushedEntities[] = $entity;
            }
        }

        /** @var PersistentCollection $col */
        foreach ($uow->getScheduledCollectionUpdates() as $col) {
            foreach ($col->unwrap()->toArray() as $entity) {
                $this->flushedEntities[] = $entity;
            }
        }
    }

    /**
     * @return void
     */
    public function preCommit()
    {
        $this
            ->commandPersister
            ->persistEvents();
    }

    /**
     * @return void
     */
    public function onCommit(OnCommitEventArgs $args)
    {
        foreach ($this->flushedEntities as $entity) {
            $this->run(
                'on_commit',
                new LifecycleEventArgs($entity, $args->getEntityManager()),
                $entity->isNew()
            );
        }

        foreach ($this->flushedEntities as $entity) {
            if (!$entity->__isInitialized__) {
                continue;
            }
            $entity->initChangelog();
        }

        $this->flushedEntities = [];
    }

    /**
     * @return void
     */
    public function onError(OnErrorEventArgs $args)
    {
        $this->handleError(
            $args->getEntity(),
            $args->getException()
        );
    }

    /**
     * @return void
     */
    private function run($eventName, LifecycleEventArgs $args, bool $isNew = false)
    {
        $entity = $args->getObject();
        if (!$entity instanceof EntityInterface) {
            return;
        }

        $this->triggerDomainEvents($eventName, $args, $isNew);
        $this->runSharedServices($eventName, $args);
        $this->runEntityServices($eventName, $args, $isNew);
    }

    /**
     * @return void
     */
    private function triggerDomainEvents($eventName, LifecycleEventArgs $args, bool $isNew)
    {
        $entity = $args->getObject();

        if ($entity instanceof LoggerEntityInterface) {
            return;
        }

        if (!$entity instanceof LoggableEntityInterface
            && !$this->forcedEntityChangeLog
        ) {
            return;
        }

        $event = null;

        switch ($eventName) {
            case 'pre_remove':
                // We use pre_remove because Id value is gone on post_remove
                $event = new EntityWasDeleted(
                    EntityClassHelper::getEntityClass($entity),
                    $entity->getId(),
                    null
                );

                break;
            case 'post_persist':
                $changeSet =  $entity instanceof LoggableEntityInterface
                    ? $entity->getChangeSet()
                    : [self::UnaccesibleChangeset];

                if (empty($changeSet)) {
                    return;
                }

                $eventClass = $isNew
                    ? EntityWasCreated::class
                    : EntityWasUpdated::class;

                $event = new $eventClass(
                    EntityClassHelper::getEntityClass($entity),
                    $entity->getId(),
                    $changeSet
                );

                break;
        }

        if (!is_null($event)) {
            $this->eventPublisher->publish($event);
        }
    }

    /**
     * @return void
     */
    private function runSharedServices($eventName, LifecycleEventArgs $args)
    {
        /** @var EntityInterface $entity */
        $entity = $args->getObject();

        /**
         * @var CommonLifecycleServiceCollection $service
         */
        $service = $this->serviceContainer->get(
            CommonLifecycleServiceCollection::class
        );
        $service->execute($eventName, $entity);
    }

    /**
     * @return void
     */
    private function runEntityServices($eventName, LifecycleEventArgs $args, bool $isNew)
    {
        $entity = $args->getObject();
        if ($isNew === false && $entity instanceof EntityInterface) {
            $entity->markAsPersisted();
        }

        $serviceName = LifecycleServiceHelper::getServiceNameByEntity($entity);

        if (!$this->serviceContainer->has($serviceName)) {
            return;
        }

        /**
         * @var LifecycleServiceCollectionInterface $service
         */
        $service = $this->serviceContainer->get($serviceName);

        try {
            $service->execute($eventName, $entity);
        } catch (\Exception $exception) {
            $this->handleError($entity, $exception);
        }
    }

    /**
     * @return void
     */
    private function handleError(EntityInterface $entity, \Exception $exception)
    {
        $event = LifecycleEventHandlerInterface::EVENT_ON_ERROR;
        $serviceCollection = LifecycleServiceHelper::getServiceNameByEntity($entity);
        if ($this->serviceContainer->has($serviceCollection)) {
            $errorHandler = $this->serviceContainer->get($serviceCollection);
            $errorHandler->handle($exception);
        }

        $commonErrorHandler = $this->serviceContainer->get(
            CommonLifecycleServiceCollection::class
        );
        $commonErrorHandler->handle($exception);

        throw $exception;
    }
}
