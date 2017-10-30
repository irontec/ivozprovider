<?php

namespace Ivoz\Provider\Domain\Model\ConditionalRoutesConditionsRelCalendar;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class ConditionalRoutesConditionsRelCalendarDTO implements DataTransferObjectInterface
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var mixed
     */
    private $conditionId;

    /**
     * @var mixed
     */
    private $calendarId;

    /**
     * @var mixed
     */
    private $condition;

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
            'conditionId' => $this->getConditionId(),
            'calendarId' => $this->getCalendarId()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {
        $this->condition = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\ConditionalRoutesCondition\\ConditionalRoutesCondition', $this->getConditionId());
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
     * @return ConditionalRoutesConditionsRelCalendarDTO
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
     * @param integer $conditionId
     *
     * @return ConditionalRoutesConditionsRelCalendarDTO
     */
    public function setConditionId($conditionId)
    {
        $this->conditionId = $conditionId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getConditionId()
    {
        return $this->conditionId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesCondition
     */
    public function getCondition()
    {
        return $this->condition;
    }

    /**
     * @param integer $calendarId
     *
     * @return ConditionalRoutesConditionsRelCalendarDTO
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


