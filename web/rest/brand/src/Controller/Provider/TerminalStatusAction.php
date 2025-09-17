<?php

namespace Controller\Provider;

use Ivoz\Provider\Domain\Model\Terminal\TerminalRepository;
use Ivoz\Provider\Domain\Assembler\Terminal\TerminalDtoAssembler;
use Ivoz\Provider\Domain\Model\Terminal\TerminalInterface;

class TerminalStatusAction
{
    public function __construct(
        private TerminalRepository $terminalRepository,
        private TerminalDtoAssembler $terminalDtoAssembler
    ) {
    }

    public function __invoke()
    {
        $terminals = $this->terminalRepository->findAll();

        return array_map(
            fn(TerminalInterface $terminal) => $this->terminalDtoAssembler->toDto($terminal, 0, 'status'),
            $terminals
        );
    }
}
