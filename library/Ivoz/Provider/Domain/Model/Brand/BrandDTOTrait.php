<?php

namespace Ivoz\Provider\Domain\Model\Brand;

trait BrandDTOTrait
{
    private $logoPath;

    /**
     * @return self
     */
    public function setLogoPath(string $path)
    {
        $this->logoPath = $path;

        return $this;
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

