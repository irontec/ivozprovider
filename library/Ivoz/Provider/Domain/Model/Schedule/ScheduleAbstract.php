<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\Schedule;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
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
     * @var ?bool
     */
    protected $monday = false;

    /**
     * @var ?bool
     */
    protected $tuesday = false;

    /**
     * @var ?bool
     */
    protected $wednesday = false;

    /**
     * @var ?bool
     */
    protected $thursday = false;

    /**
     * @var ?bool
     */
    protected $friday = false;

    /**
     * @var ?bool
     */
    protected $saturday = false;

    /**
     * @var ?bool
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
        string $name,
        \DateTimeInterface $timeIn,
        \DateTimeInterface $timeout
    ) {
        $this->setName($name);
        $this->setTimeIn($timeIn);
        $this->setTimeout($timeout);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "Schedule",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): ScheduleDto
    {
        return new ScheduleDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|ScheduleInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?ScheduleDto
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

        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param ScheduleDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, ScheduleDto::class);
        $name = $dto->getName();
        Assertion::notNull($name, 'getName value is null, but non null value was expected.');
        $timeIn = $dto->getTimeIn();
        Assertion::notNull($timeIn, 'getTimeIn value is null, but non null value was expected.');
        $timeout = $dto->getTimeout();
        Assertion::notNull($timeout, 'getTimeout value is null, but non null value was expected.');
        $company = $dto->getCompany();
        Assertion::notNull($company, 'getCompany value is null, but non null value was expected.');

        $self = new static(
            $name,
            $timeIn,
            $timeout
        );

        $self
            ->setMonday($dto->getMonday())
            ->setTuesday($dto->getTuesday())
            ->setWednesday($dto->getWednesday())
            ->setThursday($dto->getThursday())
            ->setFriday($dto->getFriday())
            ->setSaturday($dto->getSaturday())
            ->setSunday($dto->getSunday())
            ->setCompany($fkTransformer->transform($company));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param ScheduleDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, ScheduleDto::class);

        $name = $dto->getName();
        Assertion::notNull($name, 'getName value is null, but non null value was expected.');
        $timeIn = $dto->getTimeIn();
        Assertion::notNull($timeIn, 'getTimeIn value is null, but non null value was expected.');
        $timeout = $dto->getTimeout();
        Assertion::notNull($timeout, 'getTimeout value is null, but non null value was expected.');
        $company = $dto->getCompany();
        Assertion::notNull($company, 'getCompany value is null, but non null value was expected.');

        $this
            ->setName($name)
            ->setTimeIn($timeIn)
            ->setTimeout($timeout)
            ->setMonday($dto->getMonday())
            ->setTuesday($dto->getTuesday())
            ->setWednesday($dto->getWednesday())
            ->setThursday($dto->getThursday())
            ->setFriday($dto->getFriday())
            ->setSaturday($dto->getSaturday())
            ->setSunday($dto->getSunday())
            ->setCompany($fkTransformer->transform($company));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): ScheduleDto
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
     * @return array<string, mixed>
     */
    protected function __toArray(): array
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

    protected function setName(string $name): static
    {
        Assertion::maxLength($name, 50, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    protected function setTimeIn(string|\DateTimeInterface $timeIn): static
    {

        /** @var \DateTime */
        $timeIn = !($timeIn instanceof \DateTimeInterface)
            ? \DateTime::createFromFormat($timeIn, 'H:i:s', new \DateTimeZone('UTC'))
            : $timeIn;

        if ($this->isInitialized() && $this->timeIn == $timeIn) {
            return $this;
        }

        $this->timeIn = $timeIn;

        return $this;
    }

    public function getTimeIn(): \DateTimeInterface
    {
        return $this->timeIn;
    }

    protected function setTimeout(string|\DateTimeInterface $timeout): static
    {

        /** @var \DateTime */
        $timeout = !($timeout instanceof \DateTimeInterface)
            ? \DateTime::createFromFormat($timeout, 'H:i:s', new \DateTimeZone('UTC'))
            : $timeout;

        if ($this->isInitialized() && $this->timeout == $timeout) {
            return $this;
        }

        $this->timeout = $timeout;

        return $this;
    }

    public function getTimeout(): \DateTimeInterface
    {
        return $this->timeout;
    }

    protected function setMonday(?bool $monday = null): static
    {
        $this->monday = $monday;

        return $this;
    }

    public function getMonday(): ?bool
    {
        return $this->monday;
    }

    protected function setTuesday(?bool $tuesday = null): static
    {
        $this->tuesday = $tuesday;

        return $this;
    }

    public function getTuesday(): ?bool
    {
        return $this->tuesday;
    }

    protected function setWednesday(?bool $wednesday = null): static
    {
        $this->wednesday = $wednesday;

        return $this;
    }

    public function getWednesday(): ?bool
    {
        return $this->wednesday;
    }

    protected function setThursday(?bool $thursday = null): static
    {
        $this->thursday = $thursday;

        return $this;
    }

    public function getThursday(): ?bool
    {
        return $this->thursday;
    }

    protected function setFriday(?bool $friday = null): static
    {
        $this->friday = $friday;

        return $this;
    }

    public function getFriday(): ?bool
    {
        return $this->friday;
    }

    protected function setSaturday(?bool $saturday = null): static
    {
        $this->saturday = $saturday;

        return $this;
    }

    public function getSaturday(): ?bool
    {
        return $this->saturday;
    }

    protected function setSunday(?bool $sunday = null): static
    {
        $this->sunday = $sunday;

        return $this;
    }

    public function getSunday(): ?bool
    {
        return $this->sunday;
    }

    protected function setCompany(CompanyInterface $company): static
    {
        $this->company = $company;

        return $this;
    }

    public function getCompany(): CompanyInterface
    {
        return $this->company;
    }
}
