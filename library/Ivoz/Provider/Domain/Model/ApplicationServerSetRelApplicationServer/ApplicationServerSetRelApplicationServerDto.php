<?php

namespace Ivoz\Provider\Domain\Model\ApplicationServerSetRelApplicationServer;

class ApplicationServerSetRelApplicationServerDto extends ApplicationServerSetRelApplicationServerDtoAbstract
{
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'applicationServer' => 'applicationServer',
                'applicationServerSet' => 'applicationServerSet'
            ];
        }

        return parent::getPropertyMap($context, $role);
    }
}
