<?php

namespace Ivoz\Provider\Domain\Model\DestinationRateGroup;

use Ivoz\Core\Domain\Model\TempFileContainnerTrait;
use Ivoz\Provider\Domain\Model\DestinationRate\DestinationRateTrait;
use Ivoz\Core\Domain\Service\FileContainerInterface;
use Ivoz\Core\Domain\Service\TempFile;

/**
 * DestinationRateGroup
 */
class DestinationRateGroup extends DestinationRateGroupAbstract implements DestinationRateGroupInterface, FileContainerInterface
{
    use DestinationRateGroupTrait;

    use TempFileContainnerTrait { addTmpFile as protected _addTmpFile; }

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

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

