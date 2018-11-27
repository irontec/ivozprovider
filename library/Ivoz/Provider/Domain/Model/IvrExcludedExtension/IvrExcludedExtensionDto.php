<?php

namespace Ivoz\Provider\Domain\Model\IvrExcludedExtension;

class IvrExcludedExtensionDto extends IvrExcludedExtensionDtoAbstract
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
                'ivrId' => 'ivr',
                'extensionId' => 'extension'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
