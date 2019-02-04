<?php

namespace spec;

use Doctrine\Common\Collections\ArrayCollection;

class DtoToEntityFakeTransformer implements \Ivoz\Core\Application\ForeignKeyTransformerInterface
{
    /**
     * @param string $entityName
     * @param DataTransferObjectInterface|mixed $element
     * @return EntityInterface
     */
    public function transform($element, $persist = true)
    {
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
