<?php

namespace Ivoz\Provider\Domain\Model\DestinationRateGroup;

class DestinationRateGroupDto extends DestinationRateGroupDtoAbstract
{
    private $filePath;

    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '', string $role = null)
    {
        if ($context === self::CONTEXT_COLLECTION) {
            $response = [
                'status' => 'status',
                'id' => 'id',
                'name' => ['en', 'es'],
                'file' => ['fileSize', 'mimeType', 'baseName', 'importerArguments'],
                'brandId' => 'brand',
                'currencyId' => 'currency'
            ];
        } else {
            $response = parent::getPropertyMap(...func_get_args());
        }

        if ($role === 'ROLE_BRAND_ADMIN') {
            unset($response['brandId']);
        }

        return $response;
    }

    public function denormalize(array $data, string $context, string $role = '')
    {
        $contextProperties = self::getPropertyMap($context, $role);
        if ($role === 'ROLE_BRAND_ADMIN') {
            $contextProperties['brandId'] = 'brand';
        }

        $this->setByContext(
            $contextProperties,
            $data
        );
    }

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
