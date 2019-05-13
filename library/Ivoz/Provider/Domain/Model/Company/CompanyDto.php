<?php

namespace Ivoz\Provider\Domain\Model\Company;

class CompanyDto extends CompanyDtoAbstract
{

    /**
     * @codeCoverageIgnore
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = self::CONTEXT_SIMPLE, string $rol = null)
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'name' => 'name',
                'nif' => 'nif'
            ];
        }

        return parent::getPropertyMap($context);
    }
}
