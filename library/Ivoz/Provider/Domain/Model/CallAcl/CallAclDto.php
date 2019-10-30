<?php

namespace Ivoz\Provider\Domain\Model\CallAcl;

class CallAclDto extends CallAclDtoAbstract
{
    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '', string $role = null)
    {
        if ($context === self::CONTEXT_COLLECTION) {
            $response = [
                'id' => 'id',
                'name' => 'name',
                'defaultPolicy' => 'defaultPolicy'
            ];
        } else {
            $response = parent::getPropertyMap(...func_get_args());
        }

        return $response;
    }
}
