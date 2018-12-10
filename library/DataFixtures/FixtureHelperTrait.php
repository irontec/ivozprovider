<?php

namespace DataFixtures;

use Doctrine\Common\EventManager;
use Doctrine\ORM\EntityManagerInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Infrastructure\Domain\Service\Lifecycle\DoctrineEventSubscriber;

trait FixtureHelperTrait
{
    /**
     * @param string $className
     * @return EntityInterface
     */
    protected function createEntityInstance(string $className)
    {
        $reflectionClass = new \ReflectionClass($className);
        return $reflectionClass->newInstanceWithoutConstructor();
    }

    protected function sanitizeEntityValues(EntityInterface $entity)
    {
        $sanitizer = function () {
            $this->sanitizeValues();
        };

        $sanitizer->call($entity);

        return $entity;
    }

    protected function disableLifecycleEvents(EntityManagerInterface $em)
    {
        $eventManager = $em->getEventManager();
        $doctrineEventSubscriber = $this->filterDoctrineEventSubscriber($eventManager);

        if (!$doctrineEventSubscriber) {
            return;
        }

        $eventManager->removeEventSubscriber($doctrineEventSubscriber);
    }

    protected function filterDoctrineEventSubscriber(EventManager $eventManager)
    {
        $listenersByEvent = $eventManager->getListeners();

        foreach ($listenersByEvent as $event => $listeners) {
            foreach ($listeners as $listener) {
                if ($listener instanceof DoctrineEventSubscriber) {
                    return $listener;
                }
            }
        }

        return null;
    }
}
