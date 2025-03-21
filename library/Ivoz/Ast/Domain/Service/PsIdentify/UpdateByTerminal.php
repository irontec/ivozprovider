<?php

namespace Ivoz\Ast\Domain\Service\PsIdentify;

use Ivoz\Ast\Domain\Model\PsIdentify\PsIdentify;
use Ivoz\Ast\Domain\Model\PsIdentify\PsIdentifyDto;
use Ivoz\Ast\Domain\Model\PsIdentify\PsIdentifyInterface;
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
        $identify = $terminal->getPsIdentify();

        /** @var PsIdentifyDto $identifyDto */
        $identifyDto = is_null($identify)
            ? PsIdentify::createDto()
            : $this->entityTools->entityToDto($identify);

        // Get sorcery identifier
        $sorceryId = $terminal->getSorcery();

        // Insert Identify data
        $identifyDto
            ->setSorceryId($sorceryId)
            ->setEndpoint($sorceryId)
            ->setMatchHeader($sorceryId)
            ->setTerminalId($terminal->getId());

        /** @var PsIdentifyInterface $identify */
        $identify = $this->entityTools
            ->persistDto($identifyDto, $identify);

        $terminal->setPsIdentify($identify);
    }
}
