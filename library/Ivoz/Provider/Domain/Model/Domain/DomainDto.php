<?php

namespace Ivoz\Provider\Domain\Model\Domain;

class DomainDto extends DomainDtoAbstract
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
                'domain' => 'domain',
                'pointsTo' => 'pointsTo'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
