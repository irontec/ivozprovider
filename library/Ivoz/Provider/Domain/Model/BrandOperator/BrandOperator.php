<?php

namespace Ivoz\Provider\Domain\Model\BrandOperator;

/**
 * BrandOperator
 */
class BrandOperator extends BrandOperatorAbstract implements BrandOperatorInterface
{
    use BrandOperatorTrait;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

