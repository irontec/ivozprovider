<?php

namespace Ivoz\Cgr\Domain\Model\DestinationRate;

use Ivoz\Core\Domain\Model\TempFileContainnerTrait;
use Ivoz\Core\Domain\Service\FileContainerInterface;

/**
 * DestinationRate
 */
class DestinationRate extends DestinationRateAbstract implements DestinationRateInterface, FileContainerInterface
{
    use DestinationRateTrait;
    use TempFileContainnerTrait;

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
     * @return array
     */
    public function getFileObjects()
    {
        return [
            'File'
        ];
    }

}

