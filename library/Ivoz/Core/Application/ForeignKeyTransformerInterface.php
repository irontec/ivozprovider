<?php

namespace Ivoz\Core\Application;

use Doctrine\Common\Collections\ArrayCollection;

interface ForeignKeyTransformerInterface
{
    /**
     * @param mixed $element
     * @param bool $persist
     */
    public function transform($element, $persist = true);


    /**
     * @param array | null $elements
     * @return ArrayCollection | null
     */
    public function transformCollection(array $elements = null);
}
