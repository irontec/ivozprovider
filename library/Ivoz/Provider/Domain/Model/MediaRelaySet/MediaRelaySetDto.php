<?php

namespace Ivoz\Provider\Domain\Model\MediaRelaySet;

class MediaRelaySetDto extends MediaRelaySetDtoAbstract
{
    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'name' => 'name',
                'description' => 'description',
                'type' => 'type',
                'id' => 'id'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
