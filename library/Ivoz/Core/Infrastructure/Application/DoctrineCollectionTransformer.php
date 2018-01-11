<?php

namespace Ivoz\Core\Infrastructure\Application;

use Doctrine\ORM\EntityManager;
use Doctrine\Common\Collections\ArrayCollection;
use Ivoz\Core\Application\CollectionTransformerInterface;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\EntityInterface;

class DoctrineCollectionTransformer implements CollectionTransformerInterface
{
    /**
     * @var EntityManager
     */
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param string $entityName
     * @param DataTransferObjectInterface[] | null $elements
     * @return \IteratorAggregate
     */
    public function transform(string $entityName, array $elements = null)
    {
        if (is_null($elements)) {
            return null;
        }

        $entities = new ArrayCollection();
        $entityReflectionClass = new \ReflectionClass($entityName);
        $entityReflection = $entityReflectionClass->newInstanceWithoutConstructor();

        foreach ($elements as $element) {

            $entity = $element instanceof EntityInterface
                ? $element
                : $this->getEntity($entityReflection, $element);

            $entities->add($entity);
        }

        return $entities;
    }

    /**
     * @param EntityInterface $entityReflection
     * @param DataTransferObjectInterface $dto
     *
     * @return EntityInterface
     */
    private function getEntity(EntityInterface $entityReflection, DataTransferObjectInterface $dto)
    {
        if ($dto->getId()) {
            $entity = $this->em->getReference(
                get_class($entityReflection), $dto->getId()
            );

            return $entity;
        }

        return $entityReflection->fromDto($dto);
    }
}