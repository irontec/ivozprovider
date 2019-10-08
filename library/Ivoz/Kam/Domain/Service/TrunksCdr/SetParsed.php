<?php

namespace Ivoz\Kam\Domain\Service\TrunksCdr;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrDto;
use Ivoz\Kam\Domain\Model\TrunksCdr\TrunksCdrInterface;

class SetParsed
{
    protected $entityTools;

    public function __construct(
        EntityTools $entityTools
    ) {
        $this->entityTools = $entityTools;
    }

    /**
     * @return void
     */
    public function execute(
        TrunksCdrInterface $trunksCdr,
        $dispatchImmediately = false
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
