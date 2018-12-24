<?php

namespace Ivoz\Provider\Domain\Model\HuntGroup;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * HuntGroupAbstract
 * @codeCoverageIgnore
 */
abstract class HuntGroupAbstract
{
    /**
     * @var string
     */
    protected $name = '';

    /**
     * @var string
     */
    protected $description = '';

    /**
     * comment: enum:ringAll|linear|roundRobin|random
     * @var string
     */
    protected $strategy;

    /**
     * @var integer
     */
    protected $ringAllTimeout;

    /**
     * comment: enum:number|extension|voicemail
     * @var string | null
     */
    protected $noAnswerTargetType;

    /**
     * @var string | null
     */
    protected $noAnswerNumberValue;

    /**
     * @var integer
     */
    protected $preventMissedCalls = '1';

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    protected $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\Locution\LocutionInterface
     */
    protected $noAnswerLocution;

    /**
     * @var \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface
     */
    protected $noAnswerExtension;

    /**
     * @var \Ivoz\Provider\Domain\Model\User\UserInterface
     */
    protected $noAnswerVoiceMailUser;

    /**
     * @var \Ivoz\Provider\Domain\Model\Country\CountryInterface
     */
    protected $noAnswerNumberCountry;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct(
        $name,
        $description,
        $strategy,
        $ringAllTimeout,
        $preventMissedCalls
    ) {
        $this->setName($name);
        $this->setDescription($description);
        $this->setStrategy($strategy);
        $this->setRingAllTimeout($ringAllTimeout);
        $this->setPreventMissedCalls($preventMissedCalls);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "HuntGroup",
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
     * @return HuntGroupDto
     */
    public static function createDto($id = null)
    {
        return new HuntGroupDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param EntityInterface|null $entity
     * @param int $depth
     * @return HuntGroupDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, HuntGroupInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        return $entity->toDto($depth-1);
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto HuntGroupDto
         */
        Assertion::isInstanceOf($dto, HuntGroupDto::class);

        $self = new static(
            $dto->getName(),
            $dto->getDescription(),
            $dto->getStrategy(),
            $dto->getRingAllTimeout(),
            $dto->getPreventMissedCalls()
        );

        $self
            ->setNoAnswerTargetType($dto->getNoAnswerTargetType())
            ->setNoAnswerNumberValue($dto->getNoAnswerNumberValue())
            ->setCompany($dto->getCompany())
            ->setNoAnswerLocution($dto->getNoAnswerLocution())
            ->setNoAnswerExtension($dto->getNoAnswerExtension())
            ->setNoAnswerVoiceMailUser($dto->getNoAnswerVoiceMailUser())
            ->setNoAnswerNumberCountry($dto->getNoAnswerNumberCountry())
        ;

        $self->sanitizeValues();
        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto HuntGroupDto
         */
        Assertion::isInstanceOf($dto, HuntGroupDto::class);

        $this
            ->setName($dto->getName())
            ->setDescription($dto->getDescription())
            ->setStrategy($dto->getStrategy())
            ->setRingAllTimeout($dto->getRingAllTimeout())
            ->setNoAnswerTargetType($dto->getNoAnswerTargetType())
            ->setNoAnswerNumberValue($dto->getNoAnswerNumberValue())
            ->setPreventMissedCalls($dto->getPreventMissedCalls())
            ->setCompany($dto->getCompany())
            ->setNoAnswerLocution($dto->getNoAnswerLocution())
            ->setNoAnswerExtension($dto->getNoAnswerExtension())
            ->setNoAnswerVoiceMailUser($dto->getNoAnswerVoiceMailUser())
            ->setNoAnswerNumberCountry($dto->getNoAnswerNumberCountry());



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return HuntGroupDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setName(self::getName())
            ->setDescription(self::getDescription())
            ->setStrategy(self::getStrategy())
            ->setRingAllTimeout(self::getRingAllTimeout())
            ->setNoAnswerTargetType(self::getNoAnswerTargetType())
            ->setNoAnswerNumberValue(self::getNoAnswerNumberValue())
            ->setPreventMissedCalls(self::getPreventMissedCalls())
            ->setCompany(\Ivoz\Provider\Domain\Model\Company\Company::entityToDto(self::getCompany(), $depth))
            ->setNoAnswerLocution(\Ivoz\Provider\Domain\Model\Locution\Locution::entityToDto(self::getNoAnswerLocution(), $depth))
            ->setNoAnswerExtension(\Ivoz\Provider\Domain\Model\Extension\Extension::entityToDto(self::getNoAnswerExtension(), $depth))
            ->setNoAnswerVoiceMailUser(\Ivoz\Provider\Domain\Model\User\User::entityToDto(self::getNoAnswerVoiceMailUser(), $depth))
            ->setNoAnswerNumberCountry(\Ivoz\Provider\Domain\Model\Country\Country::entityToDto(self::getNoAnswerNumberCountry(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'name' => self::getName(),
            'description' => self::getDescription(),
            'strategy' => self::getStrategy(),
            'ringAllTimeout' => self::getRingAllTimeout(),
            'noAnswerTargetType' => self::getNoAnswerTargetType(),
            'noAnswerNumberValue' => self::getNoAnswerNumberValue(),
            'preventMissedCalls' => self::getPreventMissedCalls(),
            'companyId' => self::getCompany() ? self::getCompany()->getId() : null,
            'noAnswerLocutionId' => self::getNoAnswerLocution() ? self::getNoAnswerLocution()->getId() : null,
            'noAnswerExtensionId' => self::getNoAnswerExtension() ? self::getNoAnswerExtension()->getId() : null,
            'noAnswerVoiceMailUserId' => self::getNoAnswerVoiceMailUser() ? self::getNoAnswerVoiceMailUser()->getId() : null,
            'noAnswerNumberCountryId' => self::getNoAnswerNumberCountry() ? self::getNoAnswerNumberCountry()->getId() : null
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * Set name
     *
     * @param string $name
     *
     * @return self
     */
    protected function setName($name)
    {
        Assertion::notNull($name, 'name value "%s" is null, but non null value was expected.');
        Assertion::maxLength($name, 100, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return self
     */
    protected function setDescription($description)
    {
        Assertion::notNull($description, 'description value "%s" is null, but non null value was expected.');
        Assertion::maxLength($description, 500, 'description value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set strategy
     *
     * @param string $strategy
     *
     * @return self
     */
    protected function setStrategy($strategy)
    {
        Assertion::notNull($strategy, 'strategy value "%s" is null, but non null value was expected.');
        Assertion::maxLength($strategy, 25, 'strategy value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice($strategy, array (
          0 => 'ringAll',
          1 => 'linear',
          2 => 'roundRobin',
          3 => 'random',
        ), 'strategyvalue "%s" is not an element of the valid values: %s');

        $this->strategy = $strategy;

        return $this;
    }

    /**
     * Get strategy
     *
     * @return string
     */
    public function getStrategy()
    {
        return $this->strategy;
    }

    /**
     * Set ringAllTimeout
     *
     * @param integer $ringAllTimeout
     *
     * @return self
     */
    protected function setRingAllTimeout($ringAllTimeout)
    {
        Assertion::notNull($ringAllTimeout, 'ringAllTimeout value "%s" is null, but non null value was expected.');
        Assertion::integerish($ringAllTimeout, 'ringAllTimeout value "%s" is not an integer or a number castable to integer.');

        $this->ringAllTimeout = $ringAllTimeout;

        return $this;
    }

    /**
     * Get ringAllTimeout
     *
     * @return integer
     */
    public function getRingAllTimeout()
    {
        return $this->ringAllTimeout;
    }

    /**
     * Set noAnswerTargetType
     *
     * @param string $noAnswerTargetType
     *
     * @return self
     */
    protected function setNoAnswerTargetType($noAnswerTargetType = null)
    {
        if (!is_null($noAnswerTargetType)) {
            Assertion::maxLength($noAnswerTargetType, 25, 'noAnswerTargetType value "%s" is too long, it should have no more than %d characters, but has %d characters.');
            Assertion::choice($noAnswerTargetType, array (
              0 => 'number',
              1 => 'extension',
              2 => 'voicemail',
            ), 'noAnswerTargetTypevalue "%s" is not an element of the valid values: %s');
        }

        $this->noAnswerTargetType = $noAnswerTargetType;

        return $this;
    }

    /**
     * Get noAnswerTargetType
     *
     * @return string | null
     */
    public function getNoAnswerTargetType()
    {
        return $this->noAnswerTargetType;
    }

    /**
     * Set noAnswerNumberValue
     *
     * @param string $noAnswerNumberValue
     *
     * @return self
     */
    protected function setNoAnswerNumberValue($noAnswerNumberValue = null)
    {
        if (!is_null($noAnswerNumberValue)) {
            Assertion::maxLength($noAnswerNumberValue, 25, 'noAnswerNumberValue value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->noAnswerNumberValue = $noAnswerNumberValue;

        return $this;
    }

    /**
     * Get noAnswerNumberValue
     *
     * @return string | null
     */
    public function getNoAnswerNumberValue()
    {
        return $this->noAnswerNumberValue;
    }

    /**
     * Set preventMissedCalls
     *
     * @param integer $preventMissedCalls
     *
     * @return self
     */
    protected function setPreventMissedCalls($preventMissedCalls)
    {
        Assertion::notNull($preventMissedCalls, 'preventMissedCalls value "%s" is null, but non null value was expected.');
        Assertion::integerish($preventMissedCalls, 'preventMissedCalls value "%s" is not an integer or a number castable to integer.');
        Assertion::greaterOrEqualThan($preventMissedCalls, 0, 'preventMissedCalls provided "%s" is not greater or equal than "%s".');

        $this->preventMissedCalls = $preventMissedCalls;

        return $this;
    }

    /**
     * Get preventMissedCalls
     *
     * @return integer
     */
    public function getPreventMissedCalls()
    {
        return $this->preventMissedCalls;
    }

    /**
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return self
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set noAnswerLocution
     *
     * @param \Ivoz\Provider\Domain\Model\Locution\LocutionInterface $noAnswerLocution
     *
     * @return self
     */
    public function setNoAnswerLocution(\Ivoz\Provider\Domain\Model\Locution\LocutionInterface $noAnswerLocution = null)
    {
        $this->noAnswerLocution = $noAnswerLocution;

        return $this;
    }

    /**
     * Get noAnswerLocution
     *
     * @return \Ivoz\Provider\Domain\Model\Locution\LocutionInterface
     */
    public function getNoAnswerLocution()
    {
        return $this->noAnswerLocution;
    }

    /**
     * Set noAnswerExtension
     *
     * @param \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $noAnswerExtension
     *
     * @return self
     */
    public function setNoAnswerExtension(\Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $noAnswerExtension = null)
    {
        $this->noAnswerExtension = $noAnswerExtension;

        return $this;
    }

    /**
     * Get noAnswerExtension
     *
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface
     */
    public function getNoAnswerExtension()
    {
        return $this->noAnswerExtension;
    }

    /**
     * Set noAnswerVoiceMailUser
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $noAnswerVoiceMailUser
     *
     * @return self
     */
    public function setNoAnswerVoiceMailUser(\Ivoz\Provider\Domain\Model\User\UserInterface $noAnswerVoiceMailUser = null)
    {
        $this->noAnswerVoiceMailUser = $noAnswerVoiceMailUser;

        return $this;
    }

    /**
     * Get noAnswerVoiceMailUser
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface
     */
    public function getNoAnswerVoiceMailUser()
    {
        return $this->noAnswerVoiceMailUser;
    }

    /**
     * Set noAnswerNumberCountry
     *
     * @param \Ivoz\Provider\Domain\Model\Country\CountryInterface $noAnswerNumberCountry
     *
     * @return self
     */
    public function setNoAnswerNumberCountry(\Ivoz\Provider\Domain\Model\Country\CountryInterface $noAnswerNumberCountry = null)
    {
        $this->noAnswerNumberCountry = $noAnswerNumberCountry;

        return $this;
    }

    /**
     * Get noAnswerNumberCountry
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface
     */
    public function getNoAnswerNumberCountry()
    {
        return $this->noAnswerNumberCountry;
    }

    // @codeCoverageIgnoreEnd
}
