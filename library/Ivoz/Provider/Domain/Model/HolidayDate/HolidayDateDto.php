<?php

namespace Ivoz\Provider\Domain\Model\HolidayDate;

class HolidayDateDto extends HolidayDateDtoAbstract
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
                'name' => 'name',
                'eventDate' => 'eventDate'
            ];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
