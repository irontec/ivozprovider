<?php

namespace Ivoz\Cgr\Domain\Model\DestinationRate;

use Ivoz\Core\Domain\Model\TempFileContainnerTrait;
use Ivoz\Core\Domain\Service\FileContainerInterface;
use Ivoz\Core\Domain\Service\TempFile;

/**
 * DestinationRate
 */
class DestinationRate extends DestinationRateAbstract implements DestinationRateInterface, FileContainerInterface
{
    use DestinationRateTrait;
    use TempFileContainnerTrait { addTmpFile as protected _addTmpFile; }

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

    /**
     * Add TempFile and set status to pending
     *
     * @param $fldName
     * @param TempFile $file
     */
    public function addTmpFile($fldName, TempFile $file)
    {
        if ($fldName == 'File') {
            $this->setStatus('waiting');
        }
        $this->_addTmpFile($fldName, $file);
    }
}
