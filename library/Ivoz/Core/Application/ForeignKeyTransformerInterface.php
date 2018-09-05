<?php

namespace Ivoz\Core\Application;

use Ivoz\Core\Domain\Model\EntityInterface;

interface ForeignKeyTransformerInterface
{
    /**
     * @param string $entityName
     * @param DataTransferObjectInterface|mixed $element
     * @return EntityInterface
     */
    public function transform(string $entityName, $element);
}
