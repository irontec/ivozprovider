<?php
namespace Ivoz\Core\Domain\Service;

use Ivoz\Core\Domain\Model\EntityInterface;

abstract class AvoidEntityUpdatesAbstract
{
    const PRE_PERSIST_PRIORITY = LifecycleEventHandlerInterface::PRIORITY_HIGH;

    /**
     * @param EntityInterface $entity
     * @param array $ignoredFields
     * @return void
     * @throws \DomainException
     */
    protected function assertUnchanged(EntityInterface $entity, array $ignoredFields = [])
    {
        if (!$entity->getId()) {
            return;
        }

        $changes = array_diff(
            $entity->getChangedFields(),
            $ignoredFields
        );

        if (count($changes) > 0) {
            $fqdnSegments = explode('\\', get_class($this));
            $classNamePosition = count($fqdnSegments) - 2;
            $className = $fqdnSegments[$classNamePosition];

            throw new \DomainException(
                'Update operation is not allowed on ' . $className,
                403
            );
        }
    }
}
