<?php

namespace Ivoz\Kam\Domain\Model\Rtpengine;

class RtpengineDto extends RtpengineDtoAbstract
{
    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'url' => 'url',
                'weight' => 'weight',
                'disabled' => 'disabled',
                'description' => 'description',
                'id' => 'id'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
