<?php

namespace Ivoz\Provider\Domain\Model\SurvivalDevice;

class SurvivalDeviceDto extends SurvivalDeviceDtoAbstract
{
  public static function getPropertyMap(string $context = '', string $role = null): array
  {
      if ($context === self::CONTEXT_COLLECTION) {
        return [
            'name' => 'name',
            'proxy' => 'proxy',
            'description' => 'description',
            'id' => 'id',
        ];
      }

      return parent::getPropertyMap($context, $role);
  }
}
