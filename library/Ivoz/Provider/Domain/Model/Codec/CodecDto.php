<?php

namespace Ivoz\Provider\Domain\Model\Codec;

class CodecDto extends CodecDtoAbstract
{
    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'iden' => 'iden',
                'id' => 'id'
            ];
        }

        return parent::getPropertyMap($context, $role);
    }
}
