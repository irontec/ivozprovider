<?php

namespace Ivoz\Ast\Domain\Service\PsIdentify;

use Ivoz\Ast\Domain\Model\PsIdentify\PsIdentifyDto;
use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Provider\Domain\Model\Terminal\TerminalInterface;
use Ivoz\Provider\Domain\Service\Terminal\TerminalLifecycleEventHandlerInterface;

class UpdateByTerminal implements TerminalLifecycleEventHandlerInterface
{
    public function __construct(
        private EntityTools $entityTools
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => self::PRIORITY_NORMAL
        ];
    }

    /**
     * @param TerminalInterface $terminal
     * @return void
     */
    public function execute(TerminalInterface $terminal)
    {
        $isNew = $terminal->isNew();
        if (!$isNew) {
            return;
        }

        // Get sorcery identifier
        $sorceryId = $terminal->getSorcery();

        // Insert Identify data
        $identifyDto = new PsIdentifyDto();
        $identifyDto
            ->setSorceryId($sorceryId)
            ->setEndpoint($sorceryId)
            ->setMatchHeader($sorceryId)
            ->setTerminalId($terminal->getId());

        $this->entityTools
            ->persistDto($identifyDto);
    }
}
