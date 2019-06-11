<?php

namespace Ivoz\Provider\Domain\Model\Fax;

class FaxDto extends FaxDtoAbstract
{
    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '', string $role = null)
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'name' => 'name',
                'email' => 'email',
                'sendByEmail' => 'sendByEmail'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
