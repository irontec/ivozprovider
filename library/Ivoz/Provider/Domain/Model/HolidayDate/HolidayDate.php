<?php

namespace Ivoz\Provider\Domain\Model\HolidayDate;

use Ivoz\Provider\Domain\Traits\RoutableTrait;

/**
 * HolidayDate
 */
class HolidayDate extends HolidayDateAbstract implements HolidayDateInterface
{
    use HolidayDateTrait;
    use RoutableTrait;

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

    protected function sanitizeValues(): void
    {
        if (!$this->getWholeDayEvent()) {
            $timeIn = $this->getTimeIn();
            $timeOut = $this->getTimeOut();

            if ($timeOut < $timeIn) {
                throw new \DomainException('Time out must be later than time in.');
            }
        } else {
            $this->setTimeIn(null);
            $this->setTimeOut(null);
        }

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
