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
     * @var \DateTime
     */
    protected $timeIn;

    /**
     * @var \DateTime
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
     * @param mixed $id
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

    protected function setTimeIn($timeIn): static
    {
        $this->timeIn = $timeIn;

        return $this;
    }

    public function getTimeIn(): \DateTime
    {
        return clone $this->timeIn;
    }

    protected function setTimeout($timeout): static
    {
        $this->timeout = $timeout;

        return $this;
    }

    public function getTimeout(): \DateTime
    {
        return clone $this->timeout;
    }

    protected function setMonday(?bool $monday = null): static
    {
        if (!is_null($monday)) {
            Assertion::between(intval($monday), 0, 1, 'monday provided "%s" is not a valid boolean value.');
            $monday = (bool) $monday;
        }

        $this->monday = $monday;

        return $this;
    }

    public function getMonday(): ?bool
    {
        return $this->monday;
    }

    protected function setTuesday(?bool $tuesday = null): static
    {
        if (!is_null($tuesday)) {
            Assertion::between(intval($tuesday), 0, 1, 'tuesday provided "%s" is not a valid boolean value.');
            $tuesday = (bool) $tuesday;
        }

        $this->tuesday = $tuesday;

        return $this;
    }

    public function getTuesday(): ?bool
    {
        return $this->tuesday;
    }

    protected function setWednesday(?bool $wednesday = null): static
    {
        if (!is_null($wednesday)) {
            Assertion::between(intval($wednesday), 0, 1, 'wednesday provided "%s" is not a valid boolean value.');
            $wednesday = (bool) $wednesday;
        }

        $this->wednesday = $wednesday;

        return $this;
    }

    public function getWednesday(): ?bool
    {
        return $this->wednesday;
    }

    protected function setThursday(?bool $thursday = null): static
    {
        if (!is_null($thursday)) {
            Assertion::between(intval($thursday), 0, 1, 'thursday provided "%s" is not a valid boolean value.');
            $thursday = (bool) $thursday;
        }

        $this->thursday = $thursday;

        return $this;
    }

    public function getThursday(): ?bool
    {
        return $this->thursday;
    }

    protected function setFriday(?bool $friday = null): static
    {
        if (!is_null($friday)) {
            Assertion::between(intval($friday), 0, 1, 'friday provided "%s" is not a valid boolean value.');
            $friday = (bool) $friday;
        }

        $this->friday = $friday;

        return $this;
    }

    public function getFriday(): ?bool
    {
        return $this->friday;
    }

    protected function setSaturday(?bool $saturday = null): static
    {
        if (!is_null($saturday)) {
            Assertion::between(intval($saturday), 0, 1, 'saturday provided "%s" is not a valid boolean value.');
            $saturday = (bool) $saturday;
        }

        $this->saturday = $saturday;

        return $this;
    }

    public function getSaturday(): ?bool
    {
        return $this->saturday;
    }

    protected function setSunday(?bool $sunday = null): static
    {
        if (!is_null($sunday)) {
            Assertion::between(intval($sunday), 0, 1, 'sunday provided "%s" is not a valid boolean value.');
            $sunday = (bool) $sunday;
        }

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
