<?php

namespace Ivoz\Provider\Domain\Model\AdministratorRelPublicEntity;

class AdministratorRelPublicEntityDto extends AdministratorRelPublicEntityDtoAbstract
{
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'create' => 'create',
                'read' => 'read',
                'update' => 'update',
                'delete' => 'delete',
                'id' => 'id',
                'administratorId' => 'administrator',
                'publicEntityId' => 'publicEntity'
            ];
        }

        return parent::getPropertyMap($context, $role);
    }
}
