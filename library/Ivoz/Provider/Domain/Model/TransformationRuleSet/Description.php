<?php

namespace Ivoz\Provider\Domain\Model\TransformationRuleSet;

use Assert\Assertion;

/**
 * Description
 * @codeCoverageIgnore
 */
final class Description
{
    /**
     * @column description_en
     * @var string
     */
    private $en;

    /**
     * @column description_es
     * @var string
     */
    private $es;


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
        Assertion::notNull($en);
        Assertion::maxLength($en, 250);

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
        Assertion::notNull($es);
        Assertion::maxLength($es, 250);

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
