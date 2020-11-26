<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\Schedule;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Domain\Model\Helper\DateTimeHelper;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Company\Company;

/**
* ScheduleAbstract
* @codeCoverageIgnore
*/
abstract class ScheduleAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var \DateTimeInterface
     */
    protected $timeIn;

    /**
     * @var \DateTimeInterface
     */
    protected $timeout;

    /**
     * @var bool | null
     */
    protected $monday = false;

    /**
     * @var bool | null
     */
    protected $tuesday = false;

    /**
     * @var bool | null
     */
    protected $wednesday = false;

    /**
     * @var bool | null
     */
    protected $thursday = false;

    /**
     * @var bool | null
     */
    protected $friday = false;

    /**
     * @var bool | null
     */
    protected $saturday = false;

    /**
     * @var bool | null
     */
    protected $sunday = false;

    /**
     * @var CompanyInterface
     */
    protected $company;

    /**
     * Constructor
     */
    protected function __construct(
        $name,
        $timeIn,
        $timeout
    ) {
        $this->setName($name);
        $this->setTimeIn($timeIn);
        $this->setTimeout($timeout);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "Schedule",
            $this->getId()
        );
    }

    /**
     * @return void
     * @throws \Exception
     */
    protected function sanitizeValues()
    {
    }

    /**
     * @param null $id
     * @return ScheduleDto
     */
    public static function createDto($id = null)
    {
        return new ScheduleDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param ScheduleInterface|null $entity
     * @param int $depth
     * @return ScheduleDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, ScheduleInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var ScheduleDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param ScheduleDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, ScheduleDto::class);

        $self = new static(
            $dto->getName(),
            $dto->getTimeIn(),
            $dto->getTimeout()
        );

        $self
            ->setMonday($dto->getMonday())
            ->setTuesday($dto->getTuesday())
            ->setWednesday($dto->getWednesday())
            ->setThursday($dto->getThursday())
            ->setFriday($dto->getFriday())
            ->setSaturday($dto->getSaturday())
            ->setSunday($dto->getSunday())
            ->setCompany($fkTransformer->transform($dto->getCompany()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param ScheduleDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, ScheduleDto::class);

        $this
            ->setName($dto->getName())
            ->setTimeIn($dto->getTimeIn())
            ->setTimeout($dto->getTimeout())
            ->setMonday($dto->getMonday())
            ->setTuesday($dto->getTuesday())
            ->setWednesday($dto->getWednesday())
            ->setThursday($dto->getThursday())
            ->setFriday($dto->getFriday())
            ->setSaturday($dto->getSaturday())
            ->setSunday($dto->getSunday())
            ->setCompany($fkTransformer->transform($dto->getCompany()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return ScheduleDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setName(self::getName())
            ->setTimeIn(self::getTimeIn())
            ->setTimeout(self::getTimeout())
            ->setMonday(self::getMonday())
            ->setTuesday(self::getTuesday())
            ->setWednesday(self::getWednesday())
            ->setThursday(self::getThursday())
            ->setFriday(self::getFriday())
            ->setSaturday(self::getSaturday())
            ->setSunday(self::getSunday())
            ->setCompany(Company::entityToDto(self::getCompany(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'name' => self::getName(),
            'timeIn' => self::getTimeIn(),
            'timeout' => self::getTimeout(),
            'monday' => self::getMonday(),
            'tuesday' => self::getTuesday(),
            'wednesday' => self::getWednesday(),
            'thursday' => self::getThursday(),
            'friday' => self::getFriday(),
            'saturday' => self::getSaturday(),
            'sunday' => self::getSunday(),
            'companyId' => self::getCompany()->getId()
        ];
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return static
     */
    protected function setName(string $name): ScheduleInterface
    {
        Assertion::maxLength($name, 50, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set timeIn
     *
     * @param \DateTimeInterface $timeIn
     *
     * @return static
     */
    protected function setTimeIn($timeIn): ScheduleInterface
    {
        $this->timeIn = $timeIn;

        return $this;
    }

    /**
     * Get timeIn
     *
     * @return \DateTimeInterface
     */
    public function getTimeIn(): \DateTimeInterface
    {
        return clone $this->timeIn;
    }

    /**
     * Set timeout
     *
     * @param \DateTimeInterface $timeout
     *
     * @return static
     */
    protected function setTimeout($timeout): ScheduleInterface
    {
        $this->timeout = $timeout;

        return $this;
    }

    /**
     * Get timeout
     *
     * @return \DateTimeInterface
     */
    public function getTimeout(): \DateTimeInterface
    {
        return clone $this->timeout;
    }

    /**
     * Set monday
     *
     * @param bool $monday | null
     *
     * @return static
     */
    protected function setMonday(?bool $monday = null): ScheduleInterface
    {
        if (!is_null($monday)) {
            Assertion::between(intval($monday), 0, 1, 'monday provided "%s" is not a valid boolean value.');
            $monday = (bool) $monday;
        }

        $this->monday = $monday;

        return $this;
    }

    /**
     * Get monday
     *
     * @return bool | null
     */
    public function getMonday(): ?bool
    {
        return $this->monday;
    }

    /**
     * Set tuesday
     *
     * @param bool $tuesday | null
     *
     * @return static
     */
    protected function setTuesday(?bool $tuesday = null): ScheduleInterface
    {
        if (!is_null($tuesday)) {
            Assertion::between(intval($tuesday), 0, 1, 'tuesday provided "%s" is not a valid boolean value.');
            $tuesday = (bool) $tuesday;
        }

        $this->tuesday = $tuesday;

        return $this;
    }

    /**
     * Get tuesday
     *
     * @return bool | null
     */
    public function getTuesday(): ?bool
    {
        return $this->tuesday;
    }

    /**
     * Set wednesday
     *
     * @param bool $wednesday | null
     *
     * @return static
     */
    protected function setWednesday(?bool $wednesday = null): ScheduleInterface
    {
        if (!is_null($wednesday)) {
            Assertion::between(intval($wednesday), 0, 1, 'wednesday provided "%s" is not a valid boolean value.');
            $wednesday = (bool) $wednesday;
        }

        $this->wednesday = $wednesday;

        return $this;
    }

    /**
     * Get wednesday
     *
     * @return bool | null
     */
    public function getWednesday(): ?bool
    {
        return $this->wednesday;
    }

    /**
     * Set thursday
     *
     * @param bool $thursday | null
     *
     * @return static
     */
    protected function setThursday(?bool $thursday = null): ScheduleInterface
    {
        if (!is_null($thursday)) {
            Assertion::between(intval($thursday), 0, 1, 'thursday provided "%s" is not a valid boolean value.');
            $thursday = (bool) $thursday;
        }

        $this->thursday = $thursday;

        return $this;
    }

    /**
     * Get thursday
     *
     * @return bool | null
     */
    public function getThursday(): ?bool
    {
        return $this->thursday;
    }

    /**
     * Set friday
     *
     * @param bool $friday | null
     *
     * @return static
     */
    protected function setFriday(?bool $friday = null): ScheduleInterface
    {
        if (!is_null($friday)) {
            Assertion::between(intval($friday), 0, 1, 'friday provided "%s" is not a valid boolean value.');
            $friday = (bool) $friday;
        }

        $this->friday = $friday;

        return $this;
    }

    /**
     * Get friday
     *
     * @return bool | null
     */
    public function getFriday(): ?bool
    {
        return $this->friday;
    }

    /**
     * Set saturday
     *
     * @param bool $saturday | null
     *
     * @return static
     */
    protected function setSaturday(?bool $saturday = null): ScheduleInterface
    {
        if (!is_null($saturday)) {
            Assertion::between(intval($saturday), 0, 1, 'saturday provided "%s" is not a valid boolean value.');
            $saturday = (bool) $saturday;
        }

        $this->saturday = $saturday;

        return $this;
    }

    /**
     * Get saturday
     *
     * @return bool | null
     */
    public function getSaturday(): ?bool
    {
        return $this->saturday;
    }

    /**
     * Set sunday
     *
     * @param bool $sunday | null
     *
     * @return static
     */
    protected function setSunday(?bool $sunday = null): ScheduleInterface
    {
        if (!is_null($sunday)) {
            Assertion::between(intval($sunday), 0, 1, 'sunday provided "%s" is not a valid boolean value.');
            $sunday = (bool) $sunday;
        }

        $this->sunday = $sunday;

        return $this;
    }

    /**
     * Get sunday
     *
     * @return bool | null
     */
    public function getSunday(): ?bool
    {
        return $this->sunday;
    }

    /**
     * Set company
     *
     * @param CompanyInterface
     *
     * @return static
     */
    protected function setCompany(CompanyInterface $company): ScheduleInterface
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return CompanyInterface
     */
    public function getCompany(): CompanyInterface
    {
        return $this->company;
    }

}
