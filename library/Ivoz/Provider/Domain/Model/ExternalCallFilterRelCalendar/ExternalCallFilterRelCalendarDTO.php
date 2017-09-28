<?php

namespace Ivoz\Provider\Domain\Model\ExternalCallFilterRelCalendar;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class ExternalCallFilterRelCalendarDTO implements DataTransferObjectInterface
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var mixed
     */
    private $filterId;

    /**
     * @var mixed
     */
    private $calendarId;

    /**
     * @var mixed
     */
    private $filter;

    /**
     * @var mixed
     */
    private $calendar;

    /**
     * @return array
     */
    public function __toArray()
    {
        return [
            'id' => $this->getId(),
            'filterId' => $this->getFilterId(),
            'calendarId' => $this->getCalendarId()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {
        $this->filter = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\ExternalCallFilter\\ExternalCallFilter', $this->getFilterId());
        $this->calendar = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Calendar\\Calendar', $this->getCalendarId());
    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {

    }

    /**
     * @param integer $id
     *
     * @return ExternalCallFilterRelCalendarDTO
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param integer $filterId
     *
     * @return ExternalCallFilterRelCalendarDTO
     */
    public function setFilterId($filterId)
    {
        $this->filterId = $filterId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getFilterId()
    {
        return $this->filterId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilter
     */
    public function getFilter()
    {
        return $this->filter;
    }

    /**
     * @param integer $calendarId
     *
     * @return ExternalCallFilterRelCalendarDTO
     */
    public function setCalendarId($calendarId)
    {
        $this->calendarId = $calendarId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getCalendarId()
    {
        return $this->calendarId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Calendar\Calendar
     */
    public function getCalendar()
    {
        return $this->calendar;
    }
}

