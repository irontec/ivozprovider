<?php

namespace Ivoz\Provider\Domain\Service\Terminal;

use Ivoz\Provider\Domain\Model\Terminal\TerminalInterface;


/**
 * Class SanitizeValues
 * @package Ivoz\Provider\Domain\Service\Terminal
 * @lifecycle pre_persist
 */
class SanitizeValues implements TerminalLifecycleEventHandlerInterface
{
    public function __construct() {}

    public function execute(TerminalInterface $entity, $isNew)
    {
        $mac = $entity->getMac();
        $mac = strtolower($mac);
        $mac = preg_replace(
            '/[^A-Za-z0-9]/',
            '',
            $mac
        );

        if(!preg_match('/^[a-f0-9]*$/', $mac)){
            throw new \Exception('Invalid mac', 417);
        }

        $entity->setMac($mac);

        // Set terminal domain to its company user domain
        $entity->setDomain(
            $entity
                ->getCompany()
                ->getDomain()
        );
    }
}