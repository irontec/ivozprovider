<?php

namespace Ivoz\Api\EventListener;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;

final class WriteListener
{
    private $entityPersister;

    public function __construct(
        EntityPersisterInterface $entityPersister
    ) {
        $this->entityPersister = $entityPersister;
    }

    /**
     * Persists, updates or delete data return by the controller if applicable.
     *
     * @param GetResponseForControllerResultEvent $event
     */
    public function onKernelView(GetResponseForControllerResultEvent $event)
    {
        $request = $event->getRequest();
        if ($request->isMethodSafe(false)) {
            return;
        }

        $resourceClass = $request->attributes->get('_api_resource_class');
        if (null === $resourceClass) {
            return;
        }

        $controllerResult = $event->getControllerResult();

        switch ($request->getMethod()) {
            case Request::METHOD_PUT:
            case Request::METHOD_POST:
                $this->entityPersister->persist(
                    $controllerResult,
                    true
                );
                break;
            case Request::METHOD_DELETE:
                $this->entityPersister->remove($controllerResult);
                $event->setControllerResult(null);
                break;
        }
    }
}
