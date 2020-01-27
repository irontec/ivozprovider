<?php

namespace Ivoz\Provider\Domain\Model\RoutingPattern;

use Assert\Assertion;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * Description
 * @codeCoverageIgnore
 */
class Description
{
    /**
     * column: description_en
     * @var string | null
     */
    protected $en;

    /**
     * column: description_es
     * @var string | null
     */
    protected $es;

    /**
     * column: description_ca
     * @var string | null
     */
    protected $ca;

    /**
     * column: description_it
     * @var string | null
     */
    protected $it;


    /**
     * Constructor
     */
    public function __construct($en, $es, $ca, $it)
    {
        $this->setEn($en);
        $this->setEs($es);
        $this->setCa($ca);
        $this->setIt($it);
    }

    /**
     * Equals
     */
    public function equals(self $description)
    {
        return
            $this->getEn() === $description->getEn() &&
            $this->getEs() === $description->getEs() &&
            $this->getCa() === $description->getCa() &&
            $this->getIt() === $description->getIt();
    }


    // @codeCoverageIgnoreStart

    /**
     * Set en
     *
     * @param string $en | null
     *
     * @return static
     */
    protected function setEn($en = null)
    {
        if (!is_null($en)) {
            Assertion::maxLength($en, 55, 'en value "%s" is too long, it should have no more than %d characters, but has %d characters.');
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
     * @param string $es | null
     *
     * @return static
     */
    protected function setEs($es = null)
    {
        if (!is_null($es)) {
            Assertion::maxLength($es, 55, 'es value "%s" is too long, it should have no more than %d characters, but has %d characters.');
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
     * @param string $ca | null
     *
     * @return static
     */
    protected function setCa($ca = null)
    {
        if (!is_null($ca)) {
            Assertion::maxLength($ca, 55, 'ca value "%s" is too long, it should have no more than %d characters, but has %d characters.');
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

    /**
     * Set it
     *
     * @param string $it | null
     *
     * @return static
     */
    protected function setIt($it = null)
    {
        if (!is_null($it)) {
            Assertion::maxLength($it, 55, 'it value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->it = $it;

        return $this;
    }

    /**
     * Get it
     *
     * @return string | null
     */
    public function getIt()
    {
        return $this->it;
    }

    // @codeCoverageIgnoreEnd
}
