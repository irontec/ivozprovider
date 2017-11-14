<?php

namespace Ivoz\Provider\Domain\Model\BrandUrl;

trait FaxesInOutDTOTrait
{
    private $filePath;

    public function getFileObjects()
    {
        return [
            'file'
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

