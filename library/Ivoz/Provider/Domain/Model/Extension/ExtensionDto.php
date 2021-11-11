<?php

namespace Ivoz\Provider\Domain\Model\Extension;

class ExtensionDto extends ExtensionDtoAbstract
{
    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION && $role === 'ROLE_COMPANY_USER') {
            return [
                'id' => 'id',
                'number' => 'number'
            ];
        }

        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'number' => 'number',
                'routeType' => 'routeType',
                'numberValue' => 'numberValue',
                'friendValue' => 'friendValue',
                'ivrId' => 'ivr',
                'huntGroupId' => 'huntGroup',
                'conferenceRoomId' => 'conferenceRoom',
                'userId' => 'user',
                'queueId' => 'queue',
                'conditionalRouteId' => 'conditionalRoute',
                'numberCountryId' => 'numberCountry'
            ];
        }

        $response = parent::getPropertyMap(...func_get_args());
        if ($role === 'ROLE_COMPANY_ADMIN') {
            unset($response['companyId']);
        }

        return $response;
    }

    public function denormalize(array $data, string $context, string $role = ''): void
    {
        $contextProperties = self::getPropertyMap($context, $role);
        if ($role === 'ROLE_COMPANY_ADMIN') {
            $contextProperties['companyId'] = 'company';
        }

        $this->setByContext(
            $contextProperties,
            $data
        );
    }
}
