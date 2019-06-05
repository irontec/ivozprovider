<?php

namespace Ivoz\Provider\Domain\Model\Destination;

use Assert\Assertion;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * Name
 * @codeCoverageIgnore
 */
class Name
{
    /**
     * column: name_en
     * @var string | null
     */
    protected $en;

    /**
     * column: name_es
     * @var string | null
     */
    protected $es;

    /**
     * column: name_ca
     * @var string | null
     */
    protected $ca;


    /**
     * Constructor
     */
    public function __construct($en, $es, $ca)
    {
        $this->setEn($en);
        $this->setEs($es);
        $this->setCa($ca);
    }

    // @codeCoverageIgnoreStart

    /**
     * Set en
     *
     * @param string $en
     *
     * @return static
     */
    protected function setEn($en = null)
    {
        if (!is_null($en)) {
            Assertion::maxLength($en, 100, 'en value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->en = $en;

        return $this;
    }

    /**
     * Get en
     *
     * @return string | null
     */
    public function getEn()
    {
        return $this->en;
    }

    /**
     * Set es
     *
     * @param string $es
     *
     * @return static
     */
    protected function setEs($es = null)
    {
        if (!is_null($es)) {
            Assertion::maxLength($es, 100, 'es value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->es = $es;

        return $this;
    }

    /**
     * Get es
     *
     * @return string | null
     */
    public function getEs()
    {
        return $this->es;
    }

    /**
     * Set ca
     *
     * @param string $ca
     *
     * @return static
     */
    protected function setCa($ca = null)
    {
        if (!is_null($ca)) {
            Assertion::maxLength($ca, 100, 'ca value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->ca = $ca;

        return $this;
    }

    /**
     * Get ca
     *
     * @return string | null
     */
    public function getCa()
    {
        return $this->ca;
    }

    // @codeCoverageIgnoreEnd
}
