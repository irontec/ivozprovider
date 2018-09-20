<?php
namespace Ivoz\Core\Application;

interface CollectionTransformerInterface
{
    /**
     * @param string $entityName
     * @param \Ivoz\Core\Application\DataTransferObjectInterface[] $elements
     * @return \Ivoz\Core\Domain\Model\EntityInterface[]
     */
    public function transform(string $entityName, array $elements = null);
}
