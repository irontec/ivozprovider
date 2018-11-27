<?php

namespace Ivoz\Provider\Domain\Model\CallAcl;

class CallAclDto extends CallAclDtoAbstract
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
                'name' => 'name',
                'defaultPolicy' => 'defaultPolicy'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
