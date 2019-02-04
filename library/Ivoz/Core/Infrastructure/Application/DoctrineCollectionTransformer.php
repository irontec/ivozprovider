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

        if (empty($elements)) {
            return new ArrayCollection();
        }


        $entities = new ArrayCollection();
        $entityClass = substr(get_class($elements), 0, -3);
        $entityReflectionClass = new \ReflectionClass($entityClass);
        $entityReflection = $entityReflectionClass->newInstanceWithoutConstructor();

        foreach ($elements as $element) {
            $entity = $element instanceof EntityInterface
                ? $element
                : $this->getEntity($entityClass, $element);

            $entities->add($entity);
        }

        return $entities;
    }

    /**
     * @param string $entityClass
     * @param DataTransferObjectInterface $dto
     *
     * @return EntityInterface
     */
    private function getEntity(string $entityClass, DataTransferObjectInterface $dto)
    {
        if ($dto->getId()) {
            $entity = $this->em->getReference(
                $entityClass,
                $dto->getId()
            );

            return $entity;
        }

        return $entityClass->fromDto($dto);
    }
}
