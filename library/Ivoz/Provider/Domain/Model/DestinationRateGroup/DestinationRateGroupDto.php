<?php

namespace Ivoz\Provider\Domain\Model\DestinationRateGroup;

class DestinationRateGroupDto extends DestinationRateGroupDtoAbstract
{
    private $filePath;

    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            $response = [
                'status' => 'status',
                'id' => 'id',
                'name' => ['en', 'es','ca','it'],
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

    public function denormalize(array $data, string $context, string $role = ''): void
    {
        $contextProperties = self::getPropertyMap($context, $role);
        if ($role === 'ROLE_BRAND_ADMIN') {
            $contextProperties['brandId'] = 'brand';
        }

        if ($context === self::CONTEXT_SIMPLE) {
            $contextProperties['file'][] = 'path';
        }

        $this->setByContext(
            $contextProperties,
            $data
        );
    }

    /**
     * @return string[]
     *
     * @psalm-return array{0: string}
     */
    public function getFileObjects(): array
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
