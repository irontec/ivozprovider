<?php

namespace Ivoz\Provider\Domain\Model\ConferenceRoom;

class ConferenceRoomDto extends ConferenceRoomDtoAbstract
{
    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '', string $role = null)
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'name' => 'name',
                'pinProtected' => 'pinProtected',
                'maxMembers' => 'maxMembers'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
