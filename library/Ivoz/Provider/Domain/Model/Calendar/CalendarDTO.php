<?php

namespace Ivoz\Provider\Domain\Model\Calendar;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;

/**
 * @codeCoverageIgnore
 */
class CalendarDTO implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var mixed
     */
    private $companyId;

    /**
     * @var mixed
     */
    private $company;

    /**
     * @var array|null
     */
    private $holidayDates = null;

    /**
     * @return array
     */
    public function __toArray()
    {
        return [
            'name' => $this->getName(),
            'id' => $this->getId(),
            'companyId' => $this->getCompanyId(),
            'holidayDatesId' => $this->getHolidayDatesId()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {
        $this->company = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Company\\Company', $this->getCompanyId());
        if (!is_null($this->holidayDates)) {
            $items = $this->getHolidayDates();
            $this->holidayDates = [];
            foreach ($items as $item) {
                $this->holidayDates[] = $transformer->transform(
                    'Ivoz\\Provider\\Domain\\Model\\HolidayDate\\HolidayDate',
                    $item->getId() ?? $item
                );
            }
        }

    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {
        $this->holidayDates = $transformer->transform(
            'Ivoz\\Provider\\Domain\\Model\\HolidayDate\\HolidayDate',
            $this->holidayDates
        );
    }

    /**
     * @param string $name
     *
     * @return CalendarDTO
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param integer $id
     *
     * @return CalendarDTO
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
     * @param integer $companyId
     *
     * @return CalendarDTO
     */
    public function setCompanyId($companyId)
    {
        $this->companyId = $companyId;

        return $this;
    }

    /**
     * @return integer
     */
    public function getCompanyId()
    {
        return $this->companyId;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Company\Company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param array $holidayDates
     *
     * @return CalendarDTO
     */
    public function setHolidayDates($holidayDates)
    {
        $this->holidayDates = $holidayDates;

        return $this;
    }

    /**
     * @return array
     */
    public function getHolidayDates()
    {
        return $this->holidayDates;
    }
}


