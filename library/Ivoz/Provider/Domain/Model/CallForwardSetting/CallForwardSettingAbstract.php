<?php

namespace Ivoz\Provider\Domain\Model\CallForwardSetting;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * CallForwardSettingAbstract
 * @codeCoverageIgnore
 */
abstract class CallForwardSettingAbstract
{
    /**
     * comment: enum:internal|external|both
     * @var string
     */
    protected $callTypeFilter;

    /**
     * comment: enum:inconditional|noAnswer|busy|userNotRegistered
     * @var string
     */
    protected $callForwardType;

    /**
     * comment: enum:number|extension|voicemail
     * @var string
     */
    protected $targetType;

    /**
     * @var string
     */
    protected $numberValue;

    /**
     * @var integer
     */
    protected $noAnswerTimeout = '10';

    /**
     * @var \Ivoz\Provider\Domain\Model\User\UserInterface
     */
    protected $user;

    /**
     * @var \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface
     */
    protected $extension;

    /**
     * @var \Ivoz\Provider\Domain\Model\User\UserInterface
     */
    protected $voiceMailUser;

    /**
     * @var \Ivoz\Provider\Domain\Model\Country\CountryInterface
     */
    protected $numberCountry;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct(
        $callTypeFilter,
        $callForwardType,
        $targetType,
        $noAnswerTimeout
    ) {
        $this->setCallTypeFilter($callTypeFilter);
        $this->setCallForwardType($callForwardType);
        $this->setTargetType($targetType);
        $this->setNoAnswerTimeout($noAnswerTimeout);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf("%s#%s",
            "CallForwardSetting",
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
     * @return CallForwardSettingDto
     */
    public static function createDto($id = null)
    {
        return new CallForwardSettingDto($id);
    }

    /**
     * @param EntityInterface|null $entity
     * @param int $depth
     * @return CallForwardSettingDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, CallForwardSettingInterface::class);

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
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto CallForwardSettingDto
         */
        Assertion::isInstanceOf($dto, CallForwardSettingDto::class);

        $self = new static(
            $dto->getCallTypeFilter(),
            $dto->getCallForwardType(),
            $dto->getTargetType(),
            $dto->getNoAnswerTimeout());

        $self
            ->setNumberValue($dto->getNumberValue())
            ->setUser($dto->getUser())
            ->setExtension($dto->getExtension())
            ->setVoiceMailUser($dto->getVoiceMailUser())
            ->setNumberCountry($dto->getNumberCountry())
        ;

        $self->sanitizeValues();
        $self->initChangelog();

        return $self;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto CallForwardSettingDto
         */
        Assertion::isInstanceOf($dto, CallForwardSettingDto::class);

        $this
            ->setCallTypeFilter($dto->getCallTypeFilter())
            ->setCallForwardType($dto->getCallForwardType())
            ->setTargetType($dto->getTargetType())
            ->setNumberValue($dto->getNumberValue())
            ->setNoAnswerTimeout($dto->getNoAnswerTimeout())
            ->setUser($dto->getUser())
            ->setExtension($dto->getExtension())
            ->setVoiceMailUser($dto->getVoiceMailUser())
            ->setNumberCountry($dto->getNumberCountry());



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @param int $depth
     * @return CallForwardSettingDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setCallTypeFilter($this->getCallTypeFilter())
            ->setCallForwardType($this->getCallForwardType())
            ->setTargetType($this->getTargetType())
            ->setNumberValue($this->getNumberValue())
            ->setNoAnswerTimeout($this->getNoAnswerTimeout())
            ->setUser(\Ivoz\Provider\Domain\Model\User\User::entityToDto($this->getUser(), $depth))
            ->setExtension(\Ivoz\Provider\Domain\Model\Extension\Extension::entityToDto($this->getExtension(), $depth))
            ->setVoiceMailUser(\Ivoz\Provider\Domain\Model\User\User::entityToDto($this->getVoiceMailUser(), $depth))
            ->setNumberCountry(\Ivoz\Provider\Domain\Model\Country\Country::entityToDto($this->getNumberCountry(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'callTypeFilter' => self::getCallTypeFilter(),
            'callForwardType' => self::getCallForwardType(),
            'targetType' => self::getTargetType(),
            'numberValue' => self::getNumberValue(),
            'noAnswerTimeout' => self::getNoAnswerTimeout(),
            'userId' => self::getUser() ? self::getUser()->getId() : null,
            'extensionId' => self::getExtension() ? self::getExtension()->getId() : null,
            'voiceMailUserId' => self::getVoiceMailUser() ? self::getVoiceMailUser()->getId() : null,
            'numberCountryId' => self::getNumberCountry() ? self::getNumberCountry()->getId() : null
        ];
    }


    // @codeCoverageIgnoreStart

    /**
     * Set callTypeFilter
     *
     * @param string $callTypeFilter
     *
     * @return self
     */
    public function setCallTypeFilter($callTypeFilter)
    {
        Assertion::notNull($callTypeFilter, 'callTypeFilter value "%s" is null, but non null value was expected.');
        Assertion::maxLength($callTypeFilter, 25, 'callTypeFilter value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice($callTypeFilter, array (
          0 => 'internal',
          1 => 'external',
          2 => 'both',
        ), 'callTypeFiltervalue "%s" is not an element of the valid values: %s');

        $this->callTypeFilter = $callTypeFilter;

        return $this;
    }

    /**
     * Get callTypeFilter
     *
     * @return string
     */
    public function getCallTypeFilter()
    {
        return $this->callTypeFilter;
    }

    /**
     * Set callForwardType
     *
     * @param string $callForwardType
     *
     * @return self
     */
    public function setCallForwardType($callForwardType)
    {
        Assertion::notNull($callForwardType, 'callForwardType value "%s" is null, but non null value was expected.');
        Assertion::maxLength($callForwardType, 25, 'callForwardType value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice($callForwardType, array (
          0 => 'inconditional',
          1 => 'noAnswer',
          2 => 'busy',
          3 => 'userNotRegistered',
        ), 'callForwardTypevalue "%s" is not an element of the valid values: %s');

        $this->callForwardType = $callForwardType;

        return $this;
    }

    /**
     * Get callForwardType
     *
     * @return string
     */
    public function getCallForwardType()
    {
        return $this->callForwardType;
    }

    /**
     * Set targetType
     *
     * @param string $targetType
     *
     * @return self
     */
    public function setTargetType($targetType)
    {
        Assertion::notNull($targetType, 'targetType value "%s" is null, but non null value was expected.');
        Assertion::maxLength($targetType, 25, 'targetType value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice($targetType, array (
          0 => 'number',
          1 => 'extension',
          2 => 'voicemail',
        ), 'targetTypevalue "%s" is not an element of the valid values: %s');

        $this->targetType = $targetType;

        return $this;
    }

    /**
     * Get targetType
     *
     * @return string
     */
    public function getTargetType()
    {
        return $this->targetType;
    }

    /**
     * Set numberValue
     *
     * @param string $numberValue
     *
     * @return self
     */
    public function setNumberValue($numberValue = null)
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
     * @return string
     */
    public function getNumberValue()
    {
        return $this->numberValue;
    }

    /**
     * Set noAnswerTimeout
     *
     * @param integer $noAnswerTimeout
     *
     * @return self
     */
    public function setNoAnswerTimeout($noAnswerTimeout)
    {
        Assertion::notNull($noAnswerTimeout, 'noAnswerTimeout value "%s" is null, but non null value was expected.');
        Assertion::integerish($noAnswerTimeout, 'noAnswerTimeout value "%s" is not an integer or a number castable to integer.');

        $this->noAnswerTimeout = $noAnswerTimeout;

        return $this;
    }

    /**
     * Get noAnswerTimeout
     *
     * @return integer
     */
    public function getNoAnswerTimeout()
    {
        return $this->noAnswerTimeout;
    }

    /**
     * Set user
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $user
     *
     * @return self
     */
    public function setUser(\Ivoz\Provider\Domain\Model\User\UserInterface $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set extension
     *
     * @param \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $extension
     *
     * @return self
     */
    public function setExtension(\Ivoz\Provider\Domain\Model\Extension\ExtensionInterface $extension = null)
    {
        $this->extension = $extension;

        return $this;
    }

    /**
     * Get extension
     *
     * @return \Ivoz\Provider\Domain\Model\Extension\ExtensionInterface
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * Set voiceMailUser
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $voiceMailUser
     *
     * @return self
     */
    public function setVoiceMailUser(\Ivoz\Provider\Domain\Model\User\UserInterface $voiceMailUser = null)
    {
        $this->voiceMailUser = $voiceMailUser;

        return $this;
    }

    /**
     * Get voiceMailUser
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface
     */
    public function getVoiceMailUser()
    {
        return $this->voiceMailUser;
    }

    /**
     * Set numberCountry
     *
     * @param \Ivoz\Provider\Domain\Model\Country\CountryInterface $numberCountry
     *
     * @return self
     */
    public function setNumberCountry(\Ivoz\Provider\Domain\Model\Country\CountryInterface $numberCountry = null)
    {
        $this->numberCountry = $numberCountry;

        return $this;
    }

    /**
     * Get numberCountry
     *
     * @return \Ivoz\Provider\Domain\Model\Country\CountryInterface
     */
    public function getNumberCountry()
    {
        return $this->numberCountry;
    }



    // @codeCoverageIgnoreEnd
}

