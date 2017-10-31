<?php

namespace Ivoz\Provider\Domain\Model\FaxesInOut;

/**
 * FaxesInOut
 */
class FaxesInOut extends FaxesInOutAbstract implements FaxesInOutInterface
{
    use FaxesInOutTrait;

    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getDstE164()
    {
        return
            $this->getDstCountry()->getCountryCode() .
            $this->getDst();
    }
}

