<?php

namespace Ivoz\Provider\Domain\Model\Changelog;

use Ivoz\Core\Domain\Event\EntityEventInterface;

/**
 * Changelog
 */
class Changelog extends ChangelogAbstract implements ChangelogInterface
{
    use ChangelogTrait;

    /**
     * @param EntityEventInterface $event
     * @return Changelog
     */
    public static function fromEvent(EntityEventInterface $event)
    {
        $entity = new static(
            $event->getEntityClass(),
            (string) $event->getEntityId(),
            $event->getOccurredOn(),
            $event->getMicrotime()
        );

        $entity->id = $event->getId();
        $entity->setData(
            $event->getData()
        );

        return $entity;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

