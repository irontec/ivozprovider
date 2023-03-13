<?php

namespace Ivoz\Provider\Domain\Model\Calendar;

use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\HolidayDate\HolidayDateDto;
use Ivoz\Provider\Domain\Model\CalendarPeriod\CalendarPeriodDto;

/**
* CalendarDtoAbstract
* @codeCoverageIgnore
*/
abstract class CalendarDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string|null
     */
    private $name = null;

    /**
     * @var int|null
     */
    private $id = null;

    /**
     * @var CompanyDto | null
     */
    private $company = null;

    /**
     * @var HolidayDateDto[] | null
     */
    private $holidayDates = null;

    /**
     * @var CalendarPeriodDto[] | null
     */
    private $calendarPeriods = null;

    /**
     * @param string|int|null $id
     */
    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
    * @inheritdoc
    */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'name' => 'name',
            'id' => 'id',
            'companyId' => 'company'
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = [
            'name' => $this->getName(),
            'id' => $this->getId(),
            'company' => $this->getCompany(),
            'holidayDates' => $this->getHolidayDates(),
            'calendarPeriods' => $this->getCalendarPeriods()
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

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setCompany(?CompanyDto $company): static
    {
        $this->company = $company;

        return $this;
    }

    public function getCompany(): ?CompanyDto
    {
        return $this->company;
    }

    public function setCompanyId($id): static
    {
        $value = !is_null($id)
            ? new CompanyDto($id)
            : null;

        return $this->setCompany($value);
    }

    public function getCompanyId()
    {
        if ($dto = $this->getCompany()) {
            return $dto->getId();
        }

        return null;
    }

    public function setHolidayDates(?array $holidayDates): static
    {
        $this->holidayDates = $holidayDates;

        return $this;
    }

    /**
    * @return HolidayDateDto[] | null
    */
    public function getHolidayDates(): ?array
    {
        return $this->holidayDates;
    }

    public function setCalendarPeriods(?array $calendarPeriods): static
    {
        $this->calendarPeriods = $calendarPeriods;

        return $this;
    }

    /**
    * @return CalendarPeriodDto[] | null
    */
    public function getCalendarPeriods(): ?array
    {
        return $this->calendarPeriods;
    }
}
