<?php

namespace Ivoz\Provider\Domain\Model\FeaturesRelCompany;

class FeaturesRelCompanyDto extends FeaturesRelCompanyDtoAbstract
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
                'companyId' => 'company',
                'featureId' => 'feature'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
