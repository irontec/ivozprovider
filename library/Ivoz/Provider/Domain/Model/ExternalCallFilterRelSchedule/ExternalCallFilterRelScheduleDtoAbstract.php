<?php

namespace Ivoz\Provider\Domain\Model\ExternalCallFilterRelSchedule;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class ExternalCallFilterRelScheduleDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterDto | null
     */
    private $filter;

    /**
     * @var \Ivoz\Provider\Domain\Model\Schedule\ScheduleDto | null
     */
    private $schedule;


    use DtoNormalizer;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'id' => 'id',
            'filterId' => 'filter',
            'scheduleId' => 'schedule'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        return [
            'id' => $this->getId(),
            'filter' => $this->getFilter(),
            'schedule' => $this->getSchedule()
        ];
    }

    /**
     * @param integer $id
     *
     * @return static
     */
    public function setId($id = null)
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
     * @param \Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterDto $filter
     *
     * @return static
     */
    public function setFilter(\Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterDto $filter = null)
    {
        $this->filter = $filter;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterDto
     */
    public function getFilter()
    {
        return $this->filter;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setFilterId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\ExternalCallFilter\ExternalCallFilterDto($id)
            : null;

        return $this->setFilter($value);
    }

    /**
     * @return integer | null
     */
    public function getFilterId()
    {
        if ($dto = $this->getFilter()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Schedule\ScheduleDto $schedule
     *
     * @return static
     */
    public function setSchedule(\Ivoz\Provider\Domain\Model\Schedule\ScheduleDto $schedule = null)
    {
        $this->schedule = $schedule;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Schedule\ScheduleDto
     */
    public function getSchedule()
    {
        return $this->schedule;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setScheduleId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Schedule\ScheduleDto($id)
            : null;

        return $this->setSchedule($value);
    }

    /**
     * @return integer | null
     */
    public function getScheduleId()
    {
        if ($dto = $this->getSchedule()) {
            return $dto->getId();
        }

        return null;
    }
}
