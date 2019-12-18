<?php

namespace Ivoz\Core\Infrastructure\Application;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\Helper\EntityClassHelper;
use Ivoz\Core\Domain\Model\EntityInterface;

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
     * @param mixed $element
     * @param bool $persist
     */
    public function transform($element, $persist = true)
    {
        if (is_null($element)) {
            return null;
        }

        if ($element instanceof EntityInterface) {
            if ($persist) {
                $this->em->persist($element);
            }

            return $element;
        }

        $isDto = $element instanceof DataTransferObjectInterface;
        if (!$isDto) {
            throw new \RuntimeException("Error: DataTransferObject was expected");
        }

        $entityClass = EntityClassHelper::getEntityClassByDto($element);
        if (!is_null($element->getId())) {
            return $this->em->getReference(
                $entityClass,
                $element->getId()
            );
        }

        $entity = call_user_func(
            [$entityClass, 'fromDto'],
            $element,
            $this
        );

        if ($persist) {
            $this->em->persist($entity);
        }

        return $entity;
    }

    /**
     * @param array | null $elements
     * @return ArrayCollection | null
     */
    public function transformCollection(array $elements = null)
    {
        if (is_null($elements)) {
            return null;
        }

        if (empty($elements)) {
            return new ArrayCollection();
        }

        $collection = new ArrayCollection();
        foreach ($elements as $element) {
            $collection->add(
                $this->transform($element, false)
            );
        }

        return $collection;
    }
}
