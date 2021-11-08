<?php

namespace Ivoz\Kam\Domain\Service\TrunksCdr;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrDto;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrInterface;

class SetParsed
{
    public function __construct(
        private EntityTools $entityTools
    ) {
    }

    /**
     * @return void
     *
     * @param false $dispatchImmediately
     */
    public function execute(
        TrunksCdrInterface $trunksCdr,
        bool $dispatchImmediately = false
    ) {
        /**
         * @var TrunksCdrDto $trunksCdrDto
         */
        $trunksCdrDto = $this->entityTools->entityToDto(
            $trunksCdr
        );
        $trunksCdrDto->setParsed(true);
        $this->entityTools->persistDto(
            $trunksCdrDto,
            $trunksCdr,
            $dispatchImmediately
        );
    }
}
