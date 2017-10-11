<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\Lifecycle;

use Ivoz\Core\Domain\Service\CommonLifecycleServiceCollection;
use Ivoz\Core\Domain\Service\LifecycleServiceCollectionInterface;
use Ivoz\Core\Domain\Service\LifecycleSubscriber;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;

class DoctrineEventSubscriber implements EventSubscriber
{
    use EntityClassToServiceNameTrait;

    /**
     * @var EntityManagerInterface
     */
    protected $em;

    protected $serviceContainer;

    public function __construct(
        ContainerInterface $serviceContainer,
        EntityManagerInterface $em
    ) {
        $this->serviceContainer = $serviceContainer;
        $this->em = $em;
    }

    public function getSubscribedEvents()
    {
        return array(
            'prePersist',
            'postPersist',
            'preUpdate',
            'postUpdate',

            'preRemove',
            'postRemove',
        );
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

    protected function run($eventName, LifecycleEventArgs $args, bool $isNew = false)
    {
        $this->runSharedServices($eventName, $args, $isNew);
        $this->runEntityServices($eventName, $args, $isNew);

        $isTheEndOfTheEntityLifecycle = substr($eventName, 0, strlen('post')) === 'post';
        if (!$isTheEndOfTheEntityLifecycle) {
            return;
        }

        $scheduledEntityInsertions = count(
            $this->em->getUnitOfWork()->getScheduledEntityInsertions()
        );

        if ($scheduledEntityInsertions > 0) {
            $this->em->flush();
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
        $entityClass = get_class($entity);
        $serviceName = $this->getServiceName($entityClass, $eventName);

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

            $errorHandlerName = $this->getServiceName($entityClass, 'error_handler');
            if (!$this->serviceContainer->has($errorHandlerName)) {
                throw $exception;
            }

            $errorHandler = $this->serviceContainer->get($errorHandlerName);
            $errorHandler->execute($exception);
        }
    }
}