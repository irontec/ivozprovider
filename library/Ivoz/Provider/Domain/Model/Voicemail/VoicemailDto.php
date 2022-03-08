<?php

namespace Ivoz\Provider\Domain\Model\Voicemail;

class VoicemailDto extends VoicemailDtoAbstract
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
                'enabled' => 'enabled',
                'name' => 'name',
                'email' => 'email',
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
