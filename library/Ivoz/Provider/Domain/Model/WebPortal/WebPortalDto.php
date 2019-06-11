<?php

namespace Ivoz\Provider\Domain\Model\WebPortal;

class WebPortalDto extends WebPortalDtoAbstract
{
    private $logoPath;

    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '', string $role = null)
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'url' => 'url',
                'name' => 'name'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }

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
