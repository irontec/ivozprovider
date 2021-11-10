<?php

namespace Ivoz\Provider\Domain\Model\PublicEntity;

class PublicEntityDto extends PublicEntityDtoAbstract
{
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'iden' => 'iden',
                'id' => 'id',
                'name' => ['en','es','ca','it']
            ];
        }

        return parent::getPropertyMap($context, $role);
    }
}
