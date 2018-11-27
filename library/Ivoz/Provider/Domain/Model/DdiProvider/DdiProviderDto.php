<?php

namespace Ivoz\Provider\Domain\Model\DdiProvider;

class DdiProviderDto extends DdiProviderDtoAbstract
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
                'description' => 'description',
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
