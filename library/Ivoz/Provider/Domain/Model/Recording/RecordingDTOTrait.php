<?php

namespace Ivoz\Provider\Domain\Model\Recording;

trait RecordingDTOTrait
{
    private $recordedFile;

    public function getFileObjects()
    {
        return [
            'recordedFile'
        ];
    }

    /**
     * @return self
     */
    public function setRecordedFilePath(string $recordedFilePath = null)
    {
        $this->recordedFile = $recordedFilePath;

        return $this;
    }

    /**
     * @return string
     */
    public function getRecordedFilePath()
    {
        return $this->recordedFile;
    }
}

