<?php

namespace Ivoz\Provider\Domain\Model\Ddi;

class DdiDto extends DdiDtoAbstract
{
    public function denormalize(array $data, string $context, string $role = '')
    {
        $contextProperties = self::getPropertyMap($context, $role);

        if ($role === 'ROLE_BRAND_ADMIN') {
            $contextProperties['brandId'] = 'brand';
        } elseif ($role === 'ROLE_COMPANY_ADMIN') {
            $contextProperties['companyId'] = 'company';
            $data = $this->filterReadOnlyFields($data);
        }

        $this->setByContext(
            $contextProperties,
            $data
        );
    }

    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '', string $role = null)
    {
        if ($context === self::CONTEXT_COLLECTION) {
            $response = [
                'id' => 'id',
                'countryId' => 'country',
                'ddi' => 'ddi',
                'ddie164' => 'ddie164',
                'description' => 'description',
                'externalCallFilterId' => 'externalCallFilter',
                'routeType' => 'routeType',
                'friendValue' => 'friendValue',
                'conferenceRoomId' => 'conferenceRoom',
                'languageId' => 'language',
                'queueId' => 'queue',
                'userId' => 'user',
                'ivrId' => 'ivr',
                'huntGroupId' => 'huntGroup',
                'faxId' => 'fax',
                'ddiProviderId' => 'ddiProvider',
                'residentialDeviceId' => 'residentialDevice',
                'conditionalRouteId' => 'conditionalRoute',
                'retailAccountId' => 'retailAccount'
            ];
        } else {
            $response = parent::getPropertyMap(...func_get_args());
        }

        if ($role === 'ROLE_BRAND_ADMIN') {
            return self::filterFieldsForBrandAdmin($response);
        }

        if ($role === 'ROLE_COMPANY_ADMIN') {
            return self::filterFieldsForCompanyAdmin($response);
        }

        return $response;
    }

    /**
     * @param array $data
     */
    private function filterReadOnlyFields(array $data): array
    {
        //TODO only for company admin
        $readOnlyFlds = [
            'ddi164',
            'country'
        ];

        foreach ($readOnlyFlds as $readOnlyFld) {
            if (!isset($data[$readOnlyFld])) {
                continue;
            }

            unset($data[$readOnlyFld]);
        }

        return $data;
    }

    private static function filterFieldsForBrandAdmin(array $response): array
    {
        $allowedFields = [
            'ddi',
            'ddie164',
            'description',
            'id',
            'companyId',
            'ddiProviderId',
            'countryId'
        ];

        return self::filterFields($response, $allowedFields);
    }

    private static function filterFieldsForCompanyAdmin(array $response): array
    {
        $allowedFields = [
            'ddi',
            'ddie164',
            'description',
            'recordCalls',
            'displayName',
            'routeType',
            'friendValue',
            'id',
            'conferenceRoomId',
            'languageId',
            'queueId',
            'externalCallFilterId',
            'userId',
            'ivrId',
            'huntGroupId',
            'faxId',
            'countryId',
            'residentialDeviceId',
            'conditionalRouteId',
            'retailAccountId'
        ];

        return self::filterFields($response, $allowedFields);
    }

    private static function filterFields(array $response, array $allowedFields): array
    {
        return array_filter(
            $response,
            function ($key) use ($allowedFields) {
                return in_array($key, $allowedFields, true);
            },
            ARRAY_FILTER_USE_KEY
        );
    }
}
