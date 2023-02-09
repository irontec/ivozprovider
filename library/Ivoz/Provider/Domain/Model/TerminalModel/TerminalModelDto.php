<?php

namespace Ivoz\Provider\Domain\Model\TerminalModel;

class TerminalModelDto extends TerminalModelDtoAbstract
{
    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'iden' => 'iden',
                'name' => 'name'
            ];
        }

        $response = parent::getPropertyMap(...func_get_args());

        if ($role === 'ROLE_COMPANY_ADMIN') {
            return self::filterFieldsForCompanyAdmin($response);
        }

        return $response;
    }

    private static function filterFieldsForCompanyAdmin(array $response): array
    {
        $allowedFields = [
            'id' => 'id',
            'iden' => 'iden',
            'name' => 'name',
            'description' => 'description',
            'terminalManufacturerId' => 'terminalManufacturer'
        ];

        return self::filterFields($response, $allowedFields);
    }

    private static function filterFields(array $response, array $allowedFields): array
    {
        return array_filter(
            $response,
            function ($key) use ($allowedFields): bool {
                return in_array($key, $allowedFields, true);
            },
            ARRAY_FILTER_USE_KEY
        );
    }
}
