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
use Ivoz\Core\Domain\Service\CommonLifecycleServiceCollection;
use Ivoz\Core\Domain\Service\DomainEventPublisher;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\Events as CustomEvents;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\OnCommitEventArgs;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\OnErrorEventArgs;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Ivoz\Core\Domain\Model\LoggerEntityInterface;

class DoctrineEventSubscriber implements EventSubscriber
{
    const UnaccesibleChangeset = 'Unaccesible changeset';

    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @var ContainerInterface
     */
    protected $serviceContainer;

    /**
     * @var DomainEventPublisher
     */
    protected $eventPublisher;

    /**
     * @var bool
     */
    protected $forcedEntityChangeLog;

    /**
     * @var EntityInterface[]
     */
    protected $flushedEntities = [];

    public function __construct(
        ContainerInterface $serviceContainer,
        EntityManagerInterface $em,
        DomainEventPublisher $eventPublisher,
        bool $forcedEntityChangeLog = false
    ) {
        $this->serviceContainer = $serviceContainer;
        $this->em = $em;
        $this->eventPublisher = $eventPublisher;
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

            CustomEvents::onCommit,
            CustomEvents::onError
        ];
    }

    public function postLoad(LifecycleEventArgs $args)
    {
        $object = $args->getObject();
        if ($object instanceof EntityInterface) {
            $object->initChangelog();
        }
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $this->run('pre_persist', $args, true);
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $this->run('post_persist', $args, true);
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $this->run('pre_persist', $args);
    }

    public function postUpdate(LifecycleEventArgs $args)
    {
        $this->run('post_persist', $args);
    }

    public function preRemove(LifecycleEventArgs $args)
    {
        $this->run('pre_remove', $args);
    }

    public function postRemove(LifecycleEventArgs $args)
    {
        $this->run('post_remove', $args);
    }

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

    public function onError(OnErrorEventArgs $args)
    {
        $this->handleError(
            $args->getEntity(),
            $args->getException()
        );
    }

    private function run($eventName, LifecycleEventArgs $args, bool $isNew = false)
    {
        $entity = $args->getObject();
        if (!$entity instanceof EntityInterface) {
            return;
        }

        $this->triggerDomainEvents($eventName, $args, $isNew);
        $this->runSharedServices($eventName, $args, $isNew);
        $this->runEntityServices($eventName, $args, $isNew);
    }

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

    private function runSharedServices($eventName, LifecycleEventArgs $args, bool $isNew)
    {
        $serviceName = 'lifecycle.' . $eventName . '.common';

        if (!$this->serviceContainer->has($serviceName)) {
            return;
        }

        $entity = $args->getObject();

        /**
         * @var CommonLifecycleServiceCollection $service
         */
        $service = $this->serviceContainer->get($serviceName);
        $service->execute($entity, $isNew);
    }

    private function runEntityServices($eventName, LifecycleEventArgs $args, bool $isNew)
    {
        $entity = $args->getObject();
        if ($isNew === false && $entity instanceof EntityInterface) {
            $entity->markAsPersisted();
        }

        $serviceName = LifecycleServiceHelper::getServiceNameByEntity($entity, $eventName);

        if (!$this->serviceContainer->has($serviceName)) {
            return;
        }

        /**
         * @var LifecycleServiceCollectionInterface $service
         */
        $service = $this->serviceContainer->get($serviceName);

        try {
            $service->execute($entity);
        } catch (\Exception $exception) {
            $this->handleError($entity, $exception);
        }
    }

    private function handleError(EntityInterface $entity, \Exception $exception)
    {
        $errorHandlerName = LifecycleServiceHelper::getServiceNameByEntity($entity, 'error_handler');
        if (!$this->serviceContainer->has($errorHandlerName)) {
            throw $exception;
        }

        $errorHandler = $this->serviceContainer->get($errorHandlerName);
        $errorHandler->execute($exception);
    }
}
