<?php

namespace Ivoz\Kam\Domain\Model\UsersCdr;

class UsersCdrDto extends UsersCdrDtoAbstract
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
                'startTime' => 'startTime',
                'endTime' => 'endTime',
                'duration' => 'duration',
                'direction' => 'direction',
                'caller' => 'caller',
                'callee' => 'callee'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
