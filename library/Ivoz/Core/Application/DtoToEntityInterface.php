<?php
namespace Ivoz\Core\Application;

interface DtoTransformerInterface
{
    /**
     * @param string $entityName
     * @param \Ivoz\Core\Application\DataTransferObjectInterface[] $elements
     * @return \Ivoz\Core\Domain\Model\EntityInterface[]
     */
    public function transform(string $entityName, array $elements = null);
}
