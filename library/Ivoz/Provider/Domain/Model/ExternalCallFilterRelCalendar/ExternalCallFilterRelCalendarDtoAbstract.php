<?php

namespace Ivoz\Provider\Domain\Model\ExternalCallFilterRelCalendar;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Calendar\CalendarDto;
use Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterDto;

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
     * @var CalendarDto | null
     */
    private $calendar;

    /**
     * @var ExternalCallFilterDto | null
     */
    private $filter;

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
            'calendarId' => 'calendar',
            'filterId' => 'filter'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'id' => $this->getId(),
            'calendar' => $this->getCalendar(),
            'filter' => $this->getFilter()
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

    /**
     * @param int $id | null
     *
     * @return static
     */
    public function setId(?int $id = null): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param CalendarDto | null
     *
     * @return static
     */
    public function setCalendar(?CalendarDto $calendar = null): self
    {
        $this->calendar = $calendar;

        return $this;
    }

    /**
     * @return CalendarDto | null
     */
    public function getCalendar(): ?CalendarDto
    {
        return $this->calendar;
    }

    /**
     * @return static
     */
    public function setCalendarId($id): self
    {
        $value = !is_null($id)
            ? new CalendarDto($id)
            : null;

        return $this->setCalendar($value);
    }

    /**
     * @return mixed | null
     */
    public function getCalendarId()
    {
        if ($dto = $this->getCalendar()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param ExternalCallFilterDto | null
     *
     * @return static
     */
    public function setFilter(?ExternalCallFilterDto $filter = null): self
    {
        $this->filter = $filter;

        return $this;
    }

    /**
     * @return ExternalCallFilterDto | null
     */
    public function getFilter(): ?ExternalCallFilterDto
    {
        return $this->filter;
    }

    /**
     * @return static
     */
    public function setFilterId($id): self
    {
        $value = !is_null($id)
            ? new ExternalCallFilterDto($id)
            : null;

        return $this->setFilter($value);
    }

    /**
     * @return mixed | null
     */
    public function getFilterId()
    {
        if ($dto = $this->getFilter()) {
            return $dto->getId();
        }

        return null;
    }

}
