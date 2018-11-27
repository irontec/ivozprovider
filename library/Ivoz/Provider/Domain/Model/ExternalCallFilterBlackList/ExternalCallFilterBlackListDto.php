<?php

namespace Ivoz\Provider\Domain\Model\ExternalCallFilterBlackList;

class ExternalCallFilterBlackListDto extends ExternalCallFilterBlackListDtoAbstract
{

    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return  [
                'id' => 'id',
                'filterId' => 'filter',
                'matchlistId' => 'matchlist'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
