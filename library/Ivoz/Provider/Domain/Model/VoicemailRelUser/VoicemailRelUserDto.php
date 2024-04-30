<?php

namespace Ivoz\Provider\Domain\Model\VoicemailRelUser;

class VoicemailRelUserDto extends VoicemailRelUserDtoAbstract
{
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'userId' => 'user',
                'voicemailId' => 'voicemail'
            ];
        }

        return parent::getPropertyMap($context, $role);
    }
}
