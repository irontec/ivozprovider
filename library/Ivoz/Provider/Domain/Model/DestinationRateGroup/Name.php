<?php

namespace Ivoz\Provider\Domain\Model\DestinationRateGroup;

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
     * @var string
     */
    protected $en;

    /**
     * column: name_es
     * @var string
     */
    protected $es;


    /**
     * Constructor
     */
    public function __construct($en, $es)
    {
        $this->setEn($en);
        $this->setEs($es);
    }

    // @codeCoverageIgnoreStart

    /**
     * Set en
     *
     * @param string $en
     *
     * @return self
     */
    protected function setEn($en)
    {
        Assertion::notNull($en, 'en value "%s" is null, but non null value was expected.');
        Assertion::maxLength($en, 55, 'en value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->en = $en;

        return $this;
    }

    /**
     * Get en
     *
     * @return string
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
     * @return self
     */
    protected function setEs($es)
    {
        Assertion::notNull($es, 'es value "%s" is null, but non null value was expected.');
        Assertion::maxLength($es, 55, 'es value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->es = $es;

        return $this;
    }

    /**
     * Get es
     *
     * @return string
     */
    public function getEs()
    {
        return $this->es;
    }

    // @codeCoverageIgnoreEnd
}
