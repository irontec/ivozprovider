<?php

namespace Ivoz\Provider\Domain\Model\CalendarPeriod;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * CalendarPeriodAbstract
 * @codeCoverageIgnore
 */
abstract class CalendarPeriodAbstract
{
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
     * @var \Ivoz\Provider\Domain\Model\Calendar\CalendarInterface
     */
    protected $calendar;

    /**
     * @var \Ivoz\Provider\Domain\Model\Locution\LocutionInterface | null
     */
    protected $locution;

    /**
     * @var \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface | null
     */
    protected $extension;

    /**
     * @var \Ivoz\Provider\Domain\Model\User\UserInterface | null
     */
    protected $voiceMailUser;

    /**
     * @var \Ivoz\Provider\Domain\Model\Country\CountryInterface | null
     */
    protected $numberCountry;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct($startDate, $endDate)
    {
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
     * @param null $id
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
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
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
            ->setNumberCountry($fkTransformer->transform($dto->getNumberCountry()))
        ;

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
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
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
            ->setCalendar(\Ivoz\Provider\Domain\Model\Calendar\Calendar::entityToDto(self::getCalendar(), $depth))
            ->setLocution(\Ivoz\Provider\Domain\Model\Locution\Locution::entityToDto(self::getLocution(), $depth))
            ->setExtension(\Ivoz\Provider\Domain\Model\Extension\Extension::entityToDto(self::getExtension(), $depth))
            ->setVoiceMailUser(\Ivoz\Provider\Domain\Model\User\User::entityToDto(self::getVoiceMailUser(), $depth))
            ->setNumberCountry(\Ivoz\Provider\Domain\Model\Country\Country::entityToDto(self::getNumberCountry(), $depth));
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
            'calendarId' => self::getCalendar() ? self::getCalendar()->getId() : null,
            'locutionId' => self::getLocution() ? self::getLocution()->getId() : null,
            'extensionId' => self::getExtension() ? self::getExtension()->getId() : null,
            'voiceMailUserId' => self::getVoiceMailUser() ? self::getVoiceMailUser()->getId() : null,
            'numberCountryId' => self::getNumberCountry() ? self::getNumberCountry()->getId() : null
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     *
     * @return static
     */
    protected function setStartDate($startDate)
    {
        Assertion::notNull($startDate, 'startDate value "%s" is null, but non null value was expected.');

        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     *
     * @return static
     */
    protected function setEndDate($endDate)
    {
        Assertion::notNull($endDate, 'endDate value "%s" is null, but non null value was expected.');

        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set routeType
     *
     * @param string $routeType | null
     *
     * @return static
     */
    protected function setRouteType($routeType = null)
    {
        if (!is_null($routeType)) {
            Assertion::maxLength($routeType, 25, 'routeType value "%s" is too long, it should have no more than %d characters, but has %d characters.');
            Assertion::choice($routeType, [
                CalendarPeriodInterface::ROUTETYPE_NUMBER,
                CalendarPeriodInterface::ROUTETYPE_EXTENSION,
                CalendarPeriodInterface::ROUTETYPE_VOICEMAIL
            ], 'routeTypevalue "%s" is not an element of the valid values: %s');
        }

        $this->routeType = $routeType;

        return $this;
    }

    /**
     * Get routeType
     *
     * @return string | null
     */
    public function getRouteType()
    {
        return $this->routeType;
    }

    /**
     * Set numberValue
     *
     * @param string $numberValue | null
     *
     * @return static
     */
    protected function setNumberValue($numberValue = null)
    {
        if (!is_null($numberValue)) {
            Assertion::maxLength($numberValue, 25, 'numberValue value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->numberValue = $numberValue;

        return $this;
    }

    /**
     * Get numberValue
     *
     * @return string | null
     */
    public function getNumberValue()
    {
        return $this->numberValue;
    }

    /**
     * Set calendar
     *
     * @param \Ivoz\Provider\Domain\Model\Calendar\CalendarInterface $calendar
     *
     * @return static
     */
    public function setCalendar(\Ivoz\Provider\Domain\Model\Calendar\CalendarInterface $calendar = null)
    {
        $this->calendar = $calendar;

        return $this;
    }

    /**
     * Get calendar
     *
     * @return \Ivoz\Provider\Domain\Model\Calendar\CalendarInterface
     */
    public function getCalendar()
    {
        return $this->calendar;
    }

    /**
     * Set locution
     *
     * @param \Ivoz\Provider\Domain\Model\Locution\LocutionInterface $locution | null
     *
     * @return static
     */
    public function setLocution(\Ivoz\Provider\Domain\Model\Locution\LocutionInterface $locution = null)
    {
        $this->locution = $locution;

        return $this;
    }

    /**
     * Get locution
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionInterface | null
     */
    public function getLocution()
    {
        return $this->locution;
    }

    /**
     * Set extension
     *
     * @param \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $extension | null
     *
     * @return static
     */
    public function setExtension(\Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $extension = null)
    {
        $this->extension = $extension;

        return $this;
    }

    /**
     * Get extension
     *
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface | null
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * Set voiceMailUser
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $voiceMailUser | null
     *
     * @return static
     */
    public function setVoiceMailUser(\Ivoz\Provider\Domain\Model\User\UserInterface $voiceMailUser = null)
    {
        $this->voiceMailUser = $voiceMailUser;

        return $this;
    }

    /**
     * Get voiceMailUser
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface | null
     */
    public function getVoiceMailUser()
    {
        return $this->voiceMailUser;
    }

    /**
     * Set numberCountry
     *
     * @param \Ivoz\Provider\Domain\Model\Country\CountryInterface $numberCountry | null
     *
     * @return static
     */
    public function setNumberCountry(\Ivoz\Provider\Domain\Model\Country\CountryInterface $numberCountry = null)
    {
        $this->numberCountry = $numberCountry;

        return $this;
    }

    /**
     * Get numberCountry
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface | null
     */
    public function getNumberCountry()
    {
        return $this->numberCountry;
    }

    // @codeCoverageIgnoreEnd
}
