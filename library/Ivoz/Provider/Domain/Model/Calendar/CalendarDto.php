<?php

namespace Ivoz\Provider\Domain\Model\Calendar;

class CalendarDto extends CalendarDtoAbstract
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
                'name' => 'name'
            ];
        } else {
            $response = parent::getPropertyMap(...func_get_args());
        }

        return $response;
    }
}
