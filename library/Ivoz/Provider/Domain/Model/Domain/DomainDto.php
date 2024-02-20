<?php

namespace Ivoz\Provider\Domain\Model\Domain;

class DomainDto extends DomainDtoAbstract
{
    private string $brandName = '';
    private string $companyName = '';

    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            $response = [
                'id' => 'id',
                'domain' => 'domain',
                'pointsTo' => 'pointsTo',
                'brandName' => 'brandName',
                'companyName' => 'companyName'
            ];
        } else {
            $response = parent::getPropertyMap(...func_get_args());
        }

        if ($role === 'ROLE_BRAND_ADMIN') {
            return self::filterFieldsForBrandAdmin(
                $response,
            );
        }

        if ($role === 'ROLE_COMPANY_ADMIN') {
            return self::filterFieldsForCompanyAdmin(
                $response,
            );
        }

        return $response;
    }

    public function setBrandName(string $name): void
    {
        $this->brandName = $name;
    }

    public function setCompanyName(string $name): void
    {
        $this->companyName = $name;
    }

    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = parent::toArray($hideSensitiveData);
        $response['brandName'] = $this->brandName;
        $response['companyName'] = $this->companyName;

        return $response;
    }

    /**
     * @param array<array-key, mixed> $response
     * @return array<array-key, mixed>
     */
    private static function filterFieldsForBrandAdmin(array $response): array
    {
        return self::filterFieldsForCompanyAdmin($response);
    }

    /**
     * @param array<array-key, mixed> $response
     * @return array<array-key, mixed>
     */
    private static function filterFieldsForCompanyAdmin(array $response): array
    {
        $allowedFields = [
            'id',
            'domain',
        ];

        return array_filter(
            $response,
            function ($key) use ($allowedFields): bool {
                return in_array($key, $allowedFields, true);
            },
            ARRAY_FILTER_USE_KEY
        );
    }
}
