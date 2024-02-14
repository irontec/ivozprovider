<?php

namespace Ivoz\Kam\Domain\Service\UsersCdr;

use Ivoz\Core\Domain\Service\EntityTools;
use Ivoz\Kam\Domain\Model\UsersCdr\UsersCdrDto;
use Ivoz\Kam\Domain\Model\UsersCdr\UsersCdrInterface;

class SetParsed
{
    public function __construct(
        private EntityTools $entityTools
    ) {
    }

    public function execute(
        UsersCdrInterface $usersCdr,
        bool $dispatchImmediately = false
    ): void {
        /**
         * @var UsersCdrDto $usersCdrDto
         */
        $usersCdrDto = $this->entityTools->entityToDto(
            $usersCdr
        );
        $usersCdrDto->setParsed(true);
        $this->entityTools->persistDto(
            $usersCdrDto,
            $usersCdr,
            $dispatchImmediately
        );
    }
}
