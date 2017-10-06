<?php

namespace Ivoz\Provider\Domain\Model\Brand;

trait BrandDTOTrait
{
    private $logoPath;

    /**
     * @return string
     */
    public function setLogoPath($path)
    {
        return $this->logoPath = $path;
    }

    /**
     * @return string
     */
    public function getLogoPath()
    {
        return $this->logoPath;
    }

    public function getFileObjects()
    {
        return [
            'logo'
        ];
    }
}

