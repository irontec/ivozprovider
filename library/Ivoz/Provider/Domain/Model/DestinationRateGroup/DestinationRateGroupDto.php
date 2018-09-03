<?php

namespace Ivoz\Provider\Domain\Model\DestinationRateGroup;

class DestinationRateGroupDto extends DestinationRateGroupDtoAbstract
{
    private $filePath;

    public function getFileObjects()
    {
        return [
            'File'
        ];
    }

    /**
     * @return self
     */
    public function setFilePath(string $path = null)
    {
        $this->filePath = $path;

        return $this;
    }

    /**
     * @return string
     */
    public function getFilePath()
    {
        return $this->filePath;
    }
}
