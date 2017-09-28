<?php

namespace Ivoz\Core\Infrastructure\Application;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Doctrine\ORM\EntityManager;

class DoctrineForeignKeyTransformer implements ForeignKeyTransformerInterface
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
     * @param mixed $element
     * @return EntityInterface
     */
    public function transform(string $entityName, $element)
    {
        if (is_null($element)) {
            return null;
        }

        if ($element instanceof EntityInterface) {
            $this->em->persist($element);
            return $element;
        }

        if ($element instanceof DataTransferObjectInterface) {
            $element->transformForeignKeys($this);
            return $element;
        }

        return $this->em->getReference($entityName, $element);
    }
}