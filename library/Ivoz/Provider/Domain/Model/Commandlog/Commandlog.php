<?php

namespace Ivoz\Provider\Domain\Model\Commandlog;

use Ivoz\Core\Application\Event\CommandEventInterface;

class Commandlog extends CommandlogAbstract implements CommandlogInterface
{
    use CommandlogTrait;

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param CommandEventInterface $event
     * @return Commandlog
     */
    public static function fromEvent(CommandEventInterface $event)
    {
        $entity = new static(
            $event->getRequestId(),
            $event->getService(),
            $event->getOccurredOn(),
            $event->getMicrotime()
        );

        $entity->id = $event->getId();
        $entity->setMethod(
            $event->getMethod()
        );
        $entity->setArguments($event->getArguments());

        return $entity;
    }
}