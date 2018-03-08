<?php

namespace Ivoz\Provider\Domain\Model\Language;

class LanguageDto extends LanguageDtoAbstract
{

    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'iden' => 'iden',
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}


