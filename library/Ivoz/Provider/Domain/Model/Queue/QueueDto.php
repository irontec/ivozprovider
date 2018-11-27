<?php

namespace Ivoz\Provider\Domain\Model\Queue;

class QueueDto extends QueueDtoAbstract
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
                'weight' => 'weight'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
