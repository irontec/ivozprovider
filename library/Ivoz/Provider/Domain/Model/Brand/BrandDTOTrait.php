<?php

namespace Ivoz\Provider\Domain\Model\Brand;

trait BrandDTOTrait
{
    private $logoPath;

    public function getFileObjects()
    {
        return [
            'logo'
        ];
    }

    /**
     * @return self
     */
    public function setLogoPath(string $path = null)
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
}

