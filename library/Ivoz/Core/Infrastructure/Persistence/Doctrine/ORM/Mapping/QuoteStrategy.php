<?php

namespace Ivoz\Core\Infrastructure\Persistence\Doctrine\ORM\Mapping;

use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Mapping\DefaultQuoteStrategy;
use Doctrine\DBAL\Platforms\AbstractPlatform;

class QuoteStrategy extends DefaultQuoteStrategy
{
    /**
     * {@inheritdoc}
     */
    public function getColumnAlias($columnName, $counter, AbstractPlatform $platform, ClassMetadata $class = null)
    {
        $columnName = parent::getColumnAlias(...func_get_args());
        $columnName = is_numeric($columnName{0}) ? '_' . $columnName : $columnName;

        return $platform->getSQLResultCasing($columnName);
    }
}
