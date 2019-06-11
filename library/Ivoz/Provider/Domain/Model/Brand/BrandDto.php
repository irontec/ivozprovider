<?php

namespace Ivoz\Provider\Domain\Model\Brand;

class BrandDto extends BrandDtoAbstract
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

    /**
     * @return array
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = self::CONTEXT_COLLECTION, string $role = null)
    {
        if ($role === 'ROLE_COMPANY_ADMIN') {
            return [];
        }

        if ($context === self::CONTEXT_COLLECTION) {
            $response = [
                'id' => 'id',
                'name' => 'name'
            ];
        } else {
            $response = parent::getPropertyMap($context);
        }

        if ($role === 'ROLE_BRAND_ADMIN') {
            $response = self::filterFieldsForBrandAdmin($response);
        }

        unset($response['recordingsLimitMB']);
        unset($response['recordingsLimitEmail']);
        unset($response['domainId']);

        return $response;
    }

    /**
     * @param array $response
     * @return array
     */
    private static function filterFieldsForBrandAdmin(array $response): array
    {
        $allowedFields = [
            'id',
            'name',
            'logo',
            'invoice',
            'languageId',
            'defaultTimezoneId',
            'currencyId',
        ];

        $response = array_filter(
            $response,
            function ($key) use ($allowedFields) {
                return in_array($key, $allowedFields, true);
            },
            ARRAY_FILTER_USE_KEY
        );

        return $response;
    }
}
