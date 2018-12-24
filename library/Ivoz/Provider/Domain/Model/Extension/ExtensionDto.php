<?php

namespace Ivoz\Provider\Domain\Model\Extension;

class ExtensionDto extends ExtensionDtoAbstract
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
                'number' => 'number'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
