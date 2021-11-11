<?php

namespace Ivoz\Provider\Domain\Model\IvrEntry;

use Ivoz\Provider\Domain\Traits\RoutableTrait;

/**
 * IvrEntry
 */
class IvrEntry extends IvrEntryAbstract implements IvrEntryInterface
{
    use IvrEntryTrait;
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
    public function getId(): ?int
    {
        return $this->id;
    }

    protected function sanitizeValues(): void
    {
        // Set Routable options to avoid naming collision
        $this->routeTypes = [
            'voicemail',
            'conditional',
            'number',
            'extension'
        ];

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
