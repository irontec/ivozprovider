<?php

namespace Ivoz\Provider\Domain\Model\MusicOnHold;

use Ivoz\Core\Domain\Model\TempFileContainnerTrait;
use Ivoz\Core\Domain\Service\FileContainerInterface;
use Ivoz\Core\Domain\Service\TempFile;

/**
 * MusicOnHold
 */
class MusicOnHold extends MusicOnHoldAbstract implements FileContainerInterface, MusicOnHoldInterface
{
    use MusicOnHoldTrait;
    use TempFileContainnerTrait {
        addTmpFile as protected _addTmpFile;
    }

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

    /**
     * @return array
     */
    public function getFileObjects(int $filter = null)
    {
        $fileObjects = [
            'OriginalFile' => [
                FileContainerInterface::DOWNLOADABLE_FILE,
                FileContainerInterface::UPDALOADABLE_FILE,
            ],
            'EncodedFile' => [
                FileContainerInterface::DOWNLOADABLE_FILE,
            ]
        ];

        return $this->filterFileObjects(
            $fileObjects,
            $filter
        );
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

    protected function sanitizeValues()
    {
        foreach ($this->getTempFiles() as $tmpFile) {
            $tmpPath = $tmpFile->getTmpPath();
            if (!is_null($tmpPath)) {
                $this->setStatus('pending');
            }
        }
    }

    /**
     * @return string
     */
    public function getOwner()
    {
        if ($this->getBrand()) {
            return 'brand' . $this->getBrand()->getId();
        }

        if ($this->getCompany()) {
            return 'company' . $this->getCompany()->getId();
        }

        return '';
    }


    /**
     * Add TempFile and set status to pending
     *
     * @param string $fldName
     * @param \Ivoz\Core\Domain\Service\TempFile $file
     */
    public function addTmpFile(string $fldName, TempFile $file)
    {
        if ($fldName === 'OriginalFile') {
            $this->setStatus('pending');
        }
        $this->_addTmpFile($fldName, $file);
    }
}
