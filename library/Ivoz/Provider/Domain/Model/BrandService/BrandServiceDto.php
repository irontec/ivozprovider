<?php

namespace Ivoz\Provider\Domain\Model\BrandService;

class BrandServiceDto extends BrandServiceDtoAbstract
{

    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'code' => 'code'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
