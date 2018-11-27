<?php

namespace Ivoz\Provider\Domain\Model\Timezone;

class TimezoneDto extends TimezoneDtoAbstract
{
      /**
       * @inheritdoc
       * @codeCoverageIgnore
       */
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id', 'tz' => 'tz'];
        }

        return parent::getPropertyMap(...func_get_args());
    }
}
