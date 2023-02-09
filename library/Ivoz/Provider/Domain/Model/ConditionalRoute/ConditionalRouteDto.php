<?php

namespace Ivoz\Provider\Domain\Model\ConditionalRoute;

class ConditionalRouteDto extends ConditionalRouteDtoAbstract
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
                'name' => 'name',
                'locutionId' => 'locution',
                'routetype' => 'routetype',
                'numbervalue' => 'numbervalue',
                'friendvalue' => 'friendvalue',
                'ivrId' => 'ivr',
                'huntGroupId' => 'huntGroup',
                'voicemailId' => 'voicemail',
                'userId' => 'user',
                'queueId' => 'queue',
                'conferenceRoomId' => 'conferenceRoom',
                'extensionId' => 'extension',
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
