<?php

namespace Ivoz\Provider\Domain\Model\CallAclRelMatchList;

class CallAclRelMatchListDto extends CallAclRelMatchListDtoAbstract
{
    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'priority' => 'priority',
                'policy' => 'policy'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
