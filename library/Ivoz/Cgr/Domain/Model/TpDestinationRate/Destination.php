<?php

namespace Ivoz\Cgr\Domain\Model\TpDestinationRate;

use Assert\Assertion;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * Destination
 * @codeCoverageIgnore
 */
class Destination
{
    /**
     * @var string
     */
    protected $prefix;

    /**
     * column: prefix_name
     * @var string
     */
    protected $prefixName;


    /**
     * Constructor
     */
    public function __construct($prefix, $prefixName)
    {
        $this->setPrefix($prefix);
        $this->setPrefixName($prefixName);
    }

    // @codeCoverageIgnoreStart

    /**
     * Set prefix
     *
     * @param string $prefix
     *
     * @return self
     */
    protected function setPrefix($prefix)
    {
        Assertion::notNull($prefix, 'prefix value "%s" is null, but non null value was expected.');
        Assertion::maxLength($prefix, 24, 'prefix value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->prefix = $prefix;

        return $this;
    }

    /**
     * Get prefix
     *
     * @return string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * Set prefixName
     *
     * @param string $prefixName
     *
     * @return self
     */
    protected function setPrefixName($prefixName)
    {
        Assertion::notNull($prefixName, 'prefixName value "%s" is null, but non null value was expected.');
        Assertion::maxLength($prefixName, 60, 'prefixName value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->prefixName = $prefixName;

        return $this;
    }

    /**
     * Get prefixName
     *
     * @return string
     */
    public function getPrefixName()
    {
        return $this->prefixName;
    }



    // @codeCoverageIgnoreEnd
}

