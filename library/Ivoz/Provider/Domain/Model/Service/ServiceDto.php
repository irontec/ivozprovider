<?php

namespace Ivoz\Provider\Domain\Model\Service;

class ServiceDto extends ServiceDtoAbstract
{
    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'iden' => 'iden',
                'defaultCode' => 'defaultCode',
                'extraArgs' => 'extraArgs',
                'name' => ['en','es','ca','it'],
                'id' => 'id'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
