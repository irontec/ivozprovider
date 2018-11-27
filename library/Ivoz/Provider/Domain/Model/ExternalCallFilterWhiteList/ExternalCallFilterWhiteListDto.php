<?php

namespace Ivoz\Provider\Domain\Model\ExternalCallFilterWhiteList;

class ExternalCallFilterWhiteListDto extends ExternalCallFilterWhiteListDtoAbstract
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
                'filterId' => 'filter',
                'matchlistId' => 'matchlist'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
