<?php

namespace Ivoz\Provider\Domain\Model\FaxesInOut;

/**
 * FaxesInOut
 */
class FaxesInOut extends FaxesInOutAbstract implements FaxesInOutInterface
{
    use FaxesInOutTrait;

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

