<?php

namespace Ivoz\Cgr\Domain\Model\TpTiming;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class TpTimingDTO implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $tpid = 'ivozprovider';

    /**
     * @var string
     */
    private $tag;

    /**
     * @var string
     */
    private $years;

    /**
     * @var string
     */
    private $months;

    /**
     * @var string
     */
    private $monthDays;

    /**
     * @var string
     */
    private $weekDays;

    /**
     * @var string
     */
    private $time = '00:00:00';

    /**
     * @var \DateTime
     */
    private $createdAt = 'CURRENT_TIMESTAMP';

    /**
     * @var integer
     */
    private $id;

    /**
     * @return array
     */
    public function __toArray()
    {
        return [
            'tpid' => $this->getTpid(),
            'tag' => $this->getTag(),
            'years' => $this->getYears(),
            'months' => $this->getMonths(),
            'monthDays' => $this->getMonthDays(),
            'weekDays' => $this->getWeekDays(),
            'time' => $this->getTime(),
            'createdAt' => $this->getCreatedAt(),
            'id' => $this->getId()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {

    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {

    }

    /**
     * @param string $tpid
     *
     * @return TpTimingDTO
     */
    public function setTpid($tpid)
    {
        $this->tpid = $tpid;

        return $this;
    }

    /**
     * @return string
     */
    public function getTpid()
    {
        return $this->tpid;
    }

    /**
     * @param string $tag
     *
     * @return TpTimingDTO
     */
    public function setTag($tag = null)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param string $years
     *
     * @return TpTimingDTO
     */
    public function setYears($years)
    {
        $this->years = $years;

        return $this;
    }

    /**
     * @return string
     */
    public function getYears()
    {
        return $this->years;
    }

    /**
     * @param string $months
     *
     * @return TpTimingDTO
     */
    public function setMonths($months)
    {
        $this->months = $months;

        return $this;
    }

    /**
     * @return string
     */
    public function getMonths()
    {
        return $this->months;
    }

    /**
     * @param string $monthDays
     *
     * @return TpTimingDTO
     */
    public function setMonthDays($monthDays)
    {
        $this->monthDays = $monthDays;

        return $this;
    }

    /**
     * @return string
     */
    public function getMonthDays()
    {
        return $this->monthDays;
    }

    /**
     * @param string $weekDays
     *
     * @return TpTimingDTO
     */
    public function setWeekDays($weekDays)
    {
        $this->weekDays = $weekDays;

        return $this;
    }

    /**
     * @return string
     */
    public function getWeekDays()
    {
        return $this->weekDays;
    }

    /**
     * @param string $time
     *
     * @return TpTimingDTO
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * @return string
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param \DateTime $createdAt
     *
     * @return TpTimingDTO
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param integer $id
     *
     * @return TpTimingDTO
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
}


