<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\Lifecycle;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Core\Domain\Service\CommonLifecycleServiceCollection;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleSubscriber;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Ivoz\Core\Domain\Event\EntityWasCreated;
use Ivoz\Core\Domain\Event\EntityWasUpdated;
use Ivoz\Core\Domain\Event\EntityWasDeleted;
use Ivoz\Core\Domain\Service\DomainEventPublisher;
use Doctrine\ORM\Events;
use Ivoz\Core\Application\Helper\EntityClassHelper;
use Ivoz\Core\Application\Helper\LifecycleServiceHelper;


class DoctrineEventSubscriber implements EventSubscriber
{
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

    public function __construct(
        ContainerInterface $serviceContainer,
        EntityManagerInterface $em,
        DomainEventPublisher $eventPublisher
    ) {
        $this->serviceContainer = $serviceContainer;
        $this->em = $em;
        $this->eventPublisher = $eventPublisher;
    }

    public function getSubscribedEvents()
    {
        return [
            Events::prePersist,
            Events::postPersist,

            Events::preUpdate,
            Events::postUpdate,

            Events::preRemove,
            Events::postRemove
        ];
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

    private function run($eventName, LifecycleEventArgs $args, bool $isNew = false)
    {
        $this->triggerDomainEvents($eventName, $args, $isNew);
        $this->runSharedServices($eventName, $args, $isNew);
        $this->runEntityServices($eventName, $args, $isNew);
    }

    private function triggerDomainEvents($eventName, LifecycleEventArgs $args, bool $isNew)
    {
        $entity = $args->getObject();
        if (!$entity instanceof LoggableEntityInterface) {

            return;
        }

        $event = null;

        switch($eventName) {
            case 'pre_remove':
                // We use pre_remove because Id value is gone on post_persist
                $event = new EntityWasDeleted(
                    EntityClassHelper::getEntityClass($entity),
                    $entity->getId(),
                    null
                );

                break;
            case 'post_persist':

                $changeSet = $entity->getChangeSet();
                if (empty($changeSet)) {

                    return;
                }

                $eventClass = $isNew
                    ? EntityWasCreated::class
                    : EntityWasUpdated::class;

                $event = new $eventClass(
                    EntityClassHelper::getEntityClass($entity),
                    $entity->getId(),
                    $entity->getChangeSet()
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
        $serviceName = LifecycleServiceHelper::getServiceName($entity, $eventName);

        if (!$this->serviceContainer->has($serviceName)) {
            return;
        }

        /**
         * @var LifecycleServiceCollectionInterface $service
         */
        $service = $this->serviceContainer->get($serviceName);

        try {
            $service->execute($entity, $isNew);
        } catch (\Exception $exception) {

            $errorHandlerName = LifecycleServiceHelper::getServiceName($entity, 'error_handler');
            if (!$this->serviceContainer->has($errorHandlerName)) {
                throw $exception;
            }

            $errorHandler = $this->serviceContainer->get($errorHandlerName);
            $errorHandler->execute($exception);
        }
    }
}