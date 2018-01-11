<?php

namespace Ivoz\Provider\Domain\Model\Company;

class CompanyDto extends CompanyDtoAbstract
{

    /**
     * @return array
     */
    public static function getPropertyMap(string $context = self::CONTEXT_SIMPLE)
    {
        return parent::getPropertyMap($context);
    }
}


