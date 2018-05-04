<?php

namespace Ivoz\Cgr\Domain\Model\DestinationRate;


class DestinationRateDto extends DestinationRateDtoAbstract
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


