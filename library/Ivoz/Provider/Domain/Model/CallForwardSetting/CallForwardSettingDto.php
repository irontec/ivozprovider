<?php

namespace Ivoz\Provider\Domain\Model\CallForwardSetting;

class CallForwardSettingDto extends CallForwardSettingDtoAbstract
{
    public const CONTEXT_DETAILED_COLLECTION = 'detailedCollection';

    public const CONTEXT_TYPES = [
        self::CONTEXT_COLLECTION,
        self::CONTEXT_SIMPLE,
        self::CONTEXT_DETAILED,
        self::CONTEXT_DETAILED_COLLECTION
    ];

    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'callTypeFilter' => 'callTypeFilter',
                'callForwardType' => 'callForwardType',
                'targetType' => 'targetType',
                'id' => 'id',
                'enabled' => 'enabled',
                'numberValue' => 'numberValue',
                'numberCountryId' => 'numberCountry',
                'userId' => 'user',
                'voiceMailUserId' => 'voiceMailUser',
                'extensionId' => 'extension',
                'residentialDeviceId' => 'residentialDevice',
                'retailAccountId' => 'retailAccount',
                'cfwToRetailAccountId' => 'cfwToRetailAccount',
                'ddiId' => 'ddi',
            ];
        }

        if ($context === self::CONTEXT_DETAILED_COLLECTION) {
            return [
                'callTypeFilter' => 'callTypeFilter',
                'callForwardType' => 'callForwardType',
                'targetType' => 'targetType',
                'numberValue' => 'numberValue',
                'noAnswerTimeout' => 'noAnswerTimeout',
                'id' => 'id',
                'enabled' => 'enabled',
                'userId' => 'user',
                'extensionId' => 'extension',
                'voicemailId' => 'voicemail',
                'numberCountryId' => 'numberCountry'
            ];
        }

        return parent::getPropertyMap($context);
    }
}
