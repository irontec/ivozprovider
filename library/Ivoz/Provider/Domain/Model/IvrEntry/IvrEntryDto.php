<?php

namespace Ivoz\Provider\Domain\Model\IvrEntry;

class IvrEntryDto extends IvrEntryDtoAbstract
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
                'ivrId' => 'ivr',
                'entry' => 'entry',
                'welcomeLocutionId' => 'welcomeLocution',
                'routeType' => 'routeType',
                'numberCountryId' => 'numberCountry',
                'numberValue' => 'numberValue',
                'extensionId' => 'extension',
                'voicemailId' => 'voicemail',
                'conditionalRouteId' => 'conditionalRoute',
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
