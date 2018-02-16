<?php

namespace Ivoz\Provider\Domain\Model\Timezone;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

class TimezoneDto extends TimezoneDtoAbstract
{
      /**
       * @inheritdoc
       */
      public static function getPropertyMap(string $context = '')
      {
          if ($context === self::CONTEXT_COLLECTION) {
              return ['id' => 'id', 'tz' => 'tz'];
          }

          return parent::getPropertyMap(...func_get_args());
      }
}
