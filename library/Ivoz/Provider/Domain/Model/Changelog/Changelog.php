<?php

namespace Ivoz\Provider\Domain\Model\Changelog;

use Ivoz\Core\Domain\Event\EntityEventInterface;
use Ivoz\Core\Domain\Model\LoggerEntityInterface;
use Ivoz\Provider\Domain\Model\Commandlog\CommandlogInterface;

/**
 * Changelog
 */
class Changelog extends ChangelogAbstract implements LoggerEntityInterface, ChangelogInterface
{
    use ChangelogTrait;

    /**
     * @param \Ivoz\Core\Domain\Event\EntityEventInterface $event
     * @return self
     */
    public static function fromEvent(
        EntityEventInterface $event,
        CommandlogInterface $command
    ) {
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

        $entity->setCommand($command);

        $entity->sanitizeValues();
        $entity->initChangelog();

        return $entity;
    }

    /**
     * @param array $data | null
     * @return static
     */
    public function replaceData($data = null)
    {
        $this->setData($data);
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }
}
