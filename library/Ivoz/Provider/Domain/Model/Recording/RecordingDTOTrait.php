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
    public function setRecordedFilePath(string $path = null)
    {
        $this->recordedFile = $path;

        return $this;
    }

    /**
     * @return string
     */
    public function getRecordedFile()
    {
        return $this->recordedFile;
    }
}

