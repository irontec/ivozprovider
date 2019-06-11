<?php

namespace Ivoz\Provider\Domain\Model\MatchList;

class MatchListDto extends MatchListDtoAbstract
{
    /**
     * @inheritdoc
     * @codeCoverageIgnore
     */
    public static function getPropertyMap(string $context = '', string $role = null)
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return [
                'id' => 'id',
                'name' => 'name'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
