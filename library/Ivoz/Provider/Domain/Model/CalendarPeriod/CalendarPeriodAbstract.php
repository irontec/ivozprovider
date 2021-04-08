<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\CalendarPeriod;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Domain\Model\Helper\DateTimeHelper;
use Ivoz\Provider\Domain\Model\Calendar\CalendarInterface;
use Ivoz\Provider\Domain\Model\Locution\LocutionInterface;
use Ivoz\Provider\Domain\Model\Extension\ExtensionInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Country\CountryInterface;
use Ivoz\Provider\Domain\Model\Calendar\Calendar;
use Ivoz\Provider\Domain\Model\Locution\Locution;
use Ivoz\Provider\Domain\Model\Extension\Extension;
use Ivoz\Provider\Domain\Model\User\User;
use Ivoz\Provider\Domain\Model\Country\Country;

/**
* CalendarPeriodAbstract
* @codeCoverageIgnore
*/
abstract class CalendarPeriodAbstract
{
    use ChangelogTrait;

    /**
     * @var \DateTime
     */
    protected $startDate;

    /**
     * @var \DateTime
     */
    protected $endDate;

    /**
     * comment: enum:number|extension|voicemail
     * @var string | null
     */
    protected $routeType;

    /**
     * @var string | null
     */
    protected $numberValue;

    /**
     * @var CalendarInterface
     * inversedBy calendarPeriods
     */
    protected $calendar;

    /**
     * @var LocutionInterface | null
     */
    protected $locution;

    /**
     * @var ExtensionInterface | null
     */
    protected $extension;

    /**
     * @var UserInterface | null
     */
    protected $voiceMailUser;

    /**
     * @var CountryInterface | null
     */
    protected $numberCountry;

    /**
     * Constructor
     */
    protected function __construct(
        $startDate,
        $endDate
    ) {
        $this->setStartDate($startDate);
        $this->setEndDate($endDate);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "CalendarPeriod",
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
     * @return CalendarPeriodDto
     */
    public static function createDto($id = null)
    {
        return new CalendarPeriodDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param CalendarPeriodInterface|null $entity
     * @param int $depth
     * @return CalendarPeriodDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, CalendarPeriodInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var CalendarPeriodDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param CalendarPeriodDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, CalendarPeriodDto::class);

        $self = new static(
            $dto->getStartDate(),
            $dto->getEndDate()
        );

        $self
            ->setRouteType($dto->getRouteType())
            ->setNumberValue($dto->getNumberValue())
            ->setCalendar($fkTransformer->transform($dto->getCalendar()))
            ->setLocution($fkTransformer->transform($dto->getLocution()))
            ->setExtension($fkTransformer->transform($dto->getExtension()))
            ->setVoiceMailUser($fkTransformer->transform($dto->getVoiceMailUser()))
            ->setNumberCountry($fkTransformer->transform($dto->getNumberCountry()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param CalendarPeriodDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, CalendarPeriodDto::class);

        $this
            ->setStartDate($dto->getStartDate())
            ->setEndDate($dto->getEndDate())
            ->setRouteType($dto->getRouteType())
            ->setNumberValue($dto->getNumberValue())
            ->setCalendar($fkTransformer->transform($dto->getCalendar()))
            ->setLocution($fkTransformer->transform($dto->getLocution()))
            ->setExtension($fkTransformer->transform($dto->getExtension()))
            ->setVoiceMailUser($fkTransformer->transform($dto->getVoiceMailUser()))
            ->setNumberCountry($fkTransformer->transform($dto->getNumberCountry()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return CalendarPeriodDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setStartDate(self::getStartDate())
            ->setEndDate(self::getEndDate())
            ->setRouteType(self::getRouteType())
            ->setNumberValue(self::getNumberValue())
            ->setCalendar(Calendar::entityToDto(self::getCalendar(), $depth))
            ->setLocution(Locution::entityToDto(self::getLocution(), $depth))
            ->setExtension(Extension::entityToDto(self::getExtension(), $depth))
            ->setVoiceMailUser(User::entityToDto(self::getVoiceMailUser(), $depth))
            ->setNumberCountry(Country::entityToDto(self::getNumberCountry(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'startDate' => self::getStartDate(),
            'endDate' => self::getEndDate(),
            'routeType' => self::getRouteType(),
            'numberValue' => self::getNumberValue(),
            'calendarId' => self::getCalendar()->getId(),
            'locutionId' => self::getLocution() ? self::getLocution()->getId() : null,
            'extensionId' => self::getExtension() ? self::getExtension()->getId() : null,
            'voiceMailUserId' => self::getVoiceMailUser() ? self::getVoiceMailUser()->getId() : null,
            'numberCountryId' => self::getNumberCountry() ? self::getNumberCountry()->getId() : null
        ];
    }

    protected function setStartDate($startDate): static
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getStartDate(): \DateTime
    {
        return clone $this->startDate;
    }

    protected function setEndDate($endDate): static
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getEndDate(): \DateTime
    {
        return clone $this->endDate;
    }

    protected function setRouteType(?string $routeType = null): static
    {
        if (!is_null($routeType)) {
            Assertion::maxLength($routeType, 25, 'routeType value "%s" is too long, it should have no more than %d characters, but has %d characters.');
            Assertion::choice(
                $routeType,
                [
                    CalendarPeriodInterface::ROUTETYPE_NUMBER,
                    CalendarPeriodInterface::ROUTETYPE_EXTENSION,
                    CalendarPeriodInterface::ROUTETYPE_VOICEMAIL,
                ],
                'routeTypevalue "%s" is not an element of the valid values: %s'
            );
        }

        $this->routeType = $routeType;

        return $this;
    }

    public function getRouteType(): ?string
    {
        return $this->routeType;
    }

    protected function setNumberValue(?string $numberValue = null): static
    {
        if (!is_null($numberValue)) {
            Assertion::maxLength($numberValue, 25, 'numberValue value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->numberValue = $numberValue;

        return $this;
    }

    public function getNumberValue(): ?string
    {
        return $this->numberValue;
    }

    public function setCalendar(CalendarInterface $calendar): static
    {
        $this->calendar = $calendar;

        /** @var  $this */
        return $this;
    }

    public function getCalendar(): CalendarInterface
    {
        return $this->calendar;
    }

    protected function setLocution(?LocutionInterface $locution = null): static
    {
        $this->locution = $locution;

        return $this;
    }

    public function getLocution(): ?LocutionInterface
    {
        return $this->locution;
    }

    protected function setExtension(?ExtensionInterface $extension = null): static
    {
        $this->extension = $extension;

        return $this;
    }

    public function getExtension(): ?ExtensionInterface
    {
        return $this->extension;
    }

    protected function setVoiceMailUser(?UserInterface $voiceMailUser = null): static
    {
        $this->voiceMailUser = $voiceMailUser;

        return $this;
    }

    public function getVoiceMailUser(): ?UserInterface
    {
        return $this->voiceMailUser;
    }

    protected function setNumberCountry(?CountryInterface $numberCountry = null): static
    {
        $this->numberCountry = $numberCountry;

        return $this;
    }

    public function getNumberCountry(): ?CountryInterface
    {
        return $this->numberCountry;
    }
}
