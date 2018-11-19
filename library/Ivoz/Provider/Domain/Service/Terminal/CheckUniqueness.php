<?php

namespace Ivoz\Provider\Domain\Service\Terminal;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Terminal\TerminalInterface;
use Ivoz\Provider\Domain\Model\Friend\FriendRepository;
use Zend\EventManager\Exception\DomainException;

/**
 * Class CheckUniqueness
 * @package Ivoz\Provider\Domain\Service\Terminal
 */
class CheckUniqueness implements TerminalLifecycleEventHandlerInterface
{
    const PRE_PERSIST_PRIORITY = self::PRIORITY_NORMAL;

    /**
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * @var FriendRepository
     */
    protected $friendRepository;

    public function __construct(
        FriendRepository $friendRepository
    ) {
        $this->friendRepository = $friendRepository;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_PRE_PERSIST => self::PRE_PERSIST_PRIORITY
        ];
    }

    /**
     * Check username and domain is unique in the whole platform
     *
     * @param TerminalInterface $terminal
     */
    public function execute(TerminalInterface $terminal)
    {
        $friend = $this->friendRepository
            ->findOneByNameAndDomain(
                $terminal->getName(),
                $terminal->getDomain()
            );

        if ($friend) {
            throw new DomainException("There is already a friend with that name.", 30007);
        }
    }
}
