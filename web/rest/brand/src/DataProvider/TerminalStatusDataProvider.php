<?php

namespace DataProvider;

use ApiPlatform\Core\DataProvider\CollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use Ivoz\Provider\Domain\Model\Terminal\Terminal;
use Ivoz\Provider\Domain\Model\Terminal\TerminalRepository;
use Ivoz\Provider\Domain\Model\Terminal\TerminalInterface;
use Ivoz\Provider\Domain\Assembler\Terminal\TerminalDtoAssembler;
use Symfony\Component\HttpFoundation\RequestStack;

class TerminalStatusDataProvider implements CollectionDataProviderInterface, RestrictedDataProviderInterface
{
    public function __construct(
        private TerminalRepository $terminalRepository,
        private TerminalDtoAssembler $terminalDtoAssembler,
        private RequestStack $requestStack
    ) {
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        if (Terminal::class !== $resourceClass || 'get_status_collection' !== $operationName) {
            return false;
        }

        $request = $this->requestStack->getCurrentRequest();
        return $request && $request->query->get('_pagination') === 'false';
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): iterable
    {
        /** @var TerminalInterface[] $terminals */
        $terminals = $this->terminalRepository->findAll();
        $terminalDtos = [];

        foreach ($terminals as $terminal) {
            $terminalDto = $this->terminalDtoAssembler->toDto(
                $terminal,
                0,
                'status'
            );
            $terminalDtos[] = $terminalDto;
        }

        return $terminalDtos;
    }
}
