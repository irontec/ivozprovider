<?php

namespace Ivoz\Provider\Domain\Model\HuntGroupMember;

class HuntGroupMemberDto extends HuntGroupMemberDtoAbstract
{
    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'timeoutTime' => 'timeoutTime',
                'priority' => 'priority',
                'id' => 'id',
                'huntGroupId' => 'huntGroup',
                'routeType' => 'routeType'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
