<?php

namespace Ivoz\Provider\Domain\Model\CompanyService;

class CompanyServiceDto extends CompanyServiceDtoAbstract
{
    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '', string $role = null)
    {
        if ($context === self::CONTEXT_COLLECTION) {
            $response = [
                'id' => 'id',
                'code' => 'code'
            ];
        } else {
            $response = parent::getPropertyMap(...func_get_args());
        }

        return $response;
    }
}
