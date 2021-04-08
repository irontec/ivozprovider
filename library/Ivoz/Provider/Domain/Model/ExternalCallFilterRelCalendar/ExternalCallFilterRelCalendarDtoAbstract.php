<?php

namespace Ivoz\Provider\Domain\Model\ExternalCallFilterRelCalendar;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterDto;
use Ivoz\Provider\Domain\Model\Calendar\CalendarDto;

/**
* ExternalCallFilterRelCalendarDtoAbstract
* @codeCoverageIgnore
*/
abstract class ExternalCallFilterRelCalendarDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var int
     */
    private $id;

    /**
     * @var ExternalCallFilterDto | null
     */
    private $filter;

    /**
     * @var CalendarDto | null
     */
    private $calendar;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
    * @inheritdoc
    */
    public static function getPropertyMap(string $context = '', string $role = null)
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'id' => 'id',
            'filterId' => 'filter',
            'calendarId' => 'calendar'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'id' => $this->getId(),
            'filter' => $this->getFilter(),
            'calendar' => $this->getCalendar()
        ];

        if (!$hideSensitiveData) {
            return $response;
        }

        foreach ($this->sensitiveFields as $sensitiveField) {
            if (!array_key_exists($sensitiveField, $response)) {
                throw new \Exception($sensitiveField . ' field was not found');
            }
            $response[$sensitiveField] = '*****';
        }

        return $response;
    }

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setFilter(?ExternalCallFilterDto $filter): static
    {
        $this->filter = $filter;

        return $this;
    }

    public function getFilter(): ?ExternalCallFilterDto
    {
        return $this->filter;
    }

    public function setFilterId($id): static
    {
        $value = !is_null($id)
            ? new ExternalCallFilterDto($id)
            : null;

        return $this->setFilter($value);
    }

    public function getFilterId()
    {
        if ($dto = $this->getFilter()) {
            return $dto->getId();
        }

        return null;
    }

    public function setCalendar(?CalendarDto $calendar): static
    {
        $this->calendar = $calendar;

        return $this;
    }

    public function getCalendar(): ?CalendarDto
    {
        return $this->calendar;
    }

    public function setCalendarId($id): static
    {
        $value = !is_null($id)
            ? new CalendarDto($id)
            : null;

        return $this->setCalendar($value);
    }

    public function getCalendarId()
    {
        if ($dto = $this->getCalendar()) {
            return $dto->getId();
        }

        return null;
    }
}
