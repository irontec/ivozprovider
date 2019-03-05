<?php

namespace Ivoz\Provider\Domain\Model\DestinationRateGroup;

class DestinationRateGroupDto extends DestinationRateGroupDtoAbstract
{
    private $filePath;

    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'status' => 'status',
                'id' => 'id',
                'name' => ['en', 'es'],
                'file' => ['fileSize', 'mimeType', 'baseName', 'importerArguments'],
                'brandId' => 'brand',
                'currencyId' => 'currency'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }

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
