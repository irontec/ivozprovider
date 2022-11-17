<?php

namespace Ivoz\Kam\Domain\Model\Trusted;

class TrustedDto extends TrustedDtoAbstract
{
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'srcIp' => 'srcIp',
                'description' => 'description',
            ];
        }

        return parent::getPropertyMap($context, $role);
    }
}
