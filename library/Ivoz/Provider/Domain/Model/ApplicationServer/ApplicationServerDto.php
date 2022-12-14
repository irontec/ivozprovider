<?php

namespace Ivoz\Provider\Domain\Model\ApplicationServer;

class ApplicationServerDto extends ApplicationServerDtoAbstract
{
    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'name' => 'name',
                'ip' => 'ip'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
