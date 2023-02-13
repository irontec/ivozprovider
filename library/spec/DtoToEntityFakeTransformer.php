<?php

namespace spec;

use Doctrine\Common\Collections\ArrayCollection;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;

class DtoToEntityFakeTransformer implements ForeignKeyTransformerInterface
{
    private $fixedTransforms;
    public function __construct(array $fixedTransforms = [])
    {
        $this->fixedTransforms = $fixedTransforms;
    }

    public function appendFixedTransforms(array $fixedTransforms)
    {
        foreach ($fixedTransforms as $fixedTransform) {
            $this->fixedTransforms[] = $fixedTransform;
        }
    }

    /**
     * @param string $entityName
     * @param DataTransferObjectInterface|mixed $element
     * @return EntityInterface
     */
    public function transform($element, $persist = true)
    {
        foreach ($this->fixedTransforms as $fixedTransformation) {
            if ($element === $fixedTransformation[0]) {
                return $fixedTransformation[1];
            }
        }

        return $element;
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
