<?php

namespace Ivoz\Core\Infrastructure\Persistence\Doctrine\Model\DBAL\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\DecimalType;

class NumericDecimalType extends DecimalType
{
    /**
     * {@inheritdoc}
     *
     * @return null|float
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return (null === $value) ? null : floatval($value);
    }
}
