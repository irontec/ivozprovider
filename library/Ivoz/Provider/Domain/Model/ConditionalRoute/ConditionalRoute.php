<?php

namespace Ivoz\Provider\Domain\Model\ConditionalRoute;

use Ivoz\Provider\Domain\Traits\RoutableTrait;

/**
 * ConditionalRoute
 * @codeCoverageIgnore
 */
class ConditionalRoute extends ConditionalRouteAbstract implements ConditionalRouteInterface
{
    use ConditionalRouteTrait;
    use RoutableTrait;

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet(): array
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Return string representation of this entity
     * @return string
     */
    public function __toString()
    {
        return sprintf(
            "%s [%s]",
            $this->getName(),
            parent::__toString()
        );
    }

    /**
     * {@inheritDoc}
     */
    protected function sanitizeValues()
    {
        $this->sanitizeRouteValues();
    }

    /**
     * Get the numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getNumberValueE164()
    {
        if (!$this->getNumberCountry()) {
            return "";
        }

        return
            $this->getNumberCountry()->getCountryCode() .
            $this->getNumberValue();
    }
}
