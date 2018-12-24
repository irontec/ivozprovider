<?php

namespace Ivoz\Provider\Domain\Model\QueueMember;

class QueueMemberDto extends QueueMemberDtoAbstract
{
    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'penalty' => 'penalty',
                'id' => 'id',
                'queueId' => 'queue',
                'userId' => 'user'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
