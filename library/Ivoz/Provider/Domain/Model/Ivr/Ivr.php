<?php

namespace Ivoz\Provider\Domain\Model\Ivr;

use Ivoz\Provider\Domain\Traits\RoutableTrait;

/**
 * Ivr
 */
class Ivr extends IvrAbstract implements IvrInterface
{
    use IvrTrait;

    use RoutableTrait {
        getTarget as protected;
    }

    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
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
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Return string representation of this entity
     * @return string
     */
    public function __toString(): string
    {
        return sprintf(
            "%s [%s]",
            $this->getName(),
            parent::__toString()
        );
    }

    protected function sanitizeValues(): void
    {
        $this->sanitizeRouteValues('NoInput');
        $this->sanitizeRouteValues('Error');
    }

    /**
     * @return (\Ivoz\Provider\Domain\Model\Locution\LocutionInterface|null)[] with key=>value
     *
     * @psalm-return array{welcome: \Ivoz\Provider\Domain\Model\Locution\LocutionInterface|null, noanswer: \Ivoz\Provider\Domain\Model\Locution\LocutionInterface|null, error: \Ivoz\Provider\Domain\Model\Locution\LocutionInterface|null, success: \Ivoz\Provider\Domain\Model\Locution\LocutionInterface|null}
     */
    public function getAllLocutions(): array
    {
        return [
            'welcome' => $this->getWelcomeLocution(),
            'noanswer' => $this->getNoInputLocution(),
            'error' => $this->getErrorLocution(),
            'success' => $this->getSuccessLocution()
        ];
    }

    /**
     * Get the timeout numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getNoInputNumberValueE164()
    {
        if (!$this->getNoInputNumberCountry()) {
            return "";
        }

        return
            $this->getNoInputNumberCountry()->getCountryCode() .
            $this->getNoInputNumberValue();
    }

    /**
     * Get the error numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getErrorNumberValueE164()
    {
        if (!$this->getErrorNumberCountry()) {
            return "";
        }

        return
            $this->getErrorNumberCountry()->getCountryCode() .
            $this->getErrorNumberValue();
    }

    /**
     * @return null|string
     */
    public function getNoInputTarget(): ?string
    {
        return $this->getTarget("NoInput");
    }

    /**
     * @return null|string
     */
    public function getErrorTarget(): ?string
    {
        return $this->getTarget("Error");
    }
}
