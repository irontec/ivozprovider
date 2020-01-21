<?php

namespace Ivoz\Provider\Domain\Model\CallCsvScheduler;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * CallCsvSchedulerAbstract
 * @codeCoverageIgnore
 */
abstract class CallCsvSchedulerAbstract
{
    /**
     * @var string
     */
    protected $name;

    /**
     * comment: enum:day|week|month
     * @var string
     */
    protected $unit = 'month';

    /**
     * @var integer
     */
    protected $frequency;

    /**
     * comment: enum:inbound|outbound
     * @var string | null
     */
    protected $callDirection = 'outbound';

    /**
     * @var string
     */
    protected $email;

    /**
     * @var \DateTime | null
     */
    protected $lastExecution;

    /**
     * @var string | null
     */
    protected $lastExecutionError;

    /**
     * @var \DateTime | null
     */
    protected $nextExecution;

    /**
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandInterface | null
     */
    protected $brand;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyInterface | null
     */
    protected $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface | null
     */
    protected $callCsvNotificationTemplate;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct($name, $unit, $frequency, $email)
    {
        $this->setName($name);
        $this->setUnit($unit);
        $this->setFrequency($frequency);
        $this->setEmail($email);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "CallCsvScheduler",
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
     * @return CallCsvSchedulerDto
     */
    public static function createDto($id = null)
    {
        return new CallCsvSchedulerDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param CallCsvSchedulerInterface|null $entity
     * @param int $depth
     * @return CallCsvSchedulerDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, CallCsvSchedulerInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var CallCsvSchedulerDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param CallCsvSchedulerDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, CallCsvSchedulerDto::class);

        $self = new static(
            $dto->getName(),
            $dto->getUnit(),
            $dto->getFrequency(),
            $dto->getEmail()
        );

        $self
            ->setCallDirection($dto->getCallDirection())
            ->setLastExecution($dto->getLastExecution())
            ->setLastExecutionError($dto->getLastExecutionError())
            ->setNextExecution($dto->getNextExecution())
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setCallCsvNotificationTemplate($fkTransformer->transform($dto->getCallCsvNotificationTemplate()))
        ;

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param CallCsvSchedulerDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, CallCsvSchedulerDto::class);

        $this
            ->setName($dto->getName())
            ->setUnit($dto->getUnit())
            ->setFrequency($dto->getFrequency())
            ->setCallDirection($dto->getCallDirection())
            ->setEmail($dto->getEmail())
            ->setLastExecution($dto->getLastExecution())
            ->setLastExecutionError($dto->getLastExecutionError())
            ->setNextExecution($dto->getNextExecution())
            ->setBrand($fkTransformer->transform($dto->getBrand()))
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setCallCsvNotificationTemplate($fkTransformer->transform($dto->getCallCsvNotificationTemplate()));



        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return CallCsvSchedulerDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setName(self::getName())
            ->setUnit(self::getUnit())
            ->setFrequency(self::getFrequency())
            ->setCallDirection(self::getCallDirection())
            ->setEmail(self::getEmail())
            ->setLastExecution(self::getLastExecution())
            ->setLastExecutionError(self::getLastExecutionError())
            ->setNextExecution(self::getNextExecution())
            ->setBrand(\Ivoz\Provider\Domain\Model\Brand\Brand::entityToDto(self::getBrand(), $depth))
            ->setCompany(\Ivoz\Provider\Domain\Model\Company\Company::entityToDto(self::getCompany(), $depth))
            ->setCallCsvNotificationTemplate(\Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplate::entityToDto(self::getCallCsvNotificationTemplate(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'name' => self::getName(),
            'unit' => self::getUnit(),
            'frequency' => self::getFrequency(),
            'callDirection' => self::getCallDirection(),
            'email' => self::getEmail(),
            'lastExecution' => self::getLastExecution(),
            'lastExecutionError' => self::getLastExecutionError(),
            'nextExecution' => self::getNextExecution(),
            'brandId' => self::getBrand() ? self::getBrand()->getId() : null,
            'companyId' => self::getCompany() ? self::getCompany()->getId() : null,
            'callCsvNotificationTemplateId' => self::getCallCsvNotificationTemplate() ? self::getCallCsvNotificationTemplate()->getId() : null
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * Set name
     *
     * @param string $name
     *
     * @return static
     */
    protected function setName($name)
    {
        Assertion::notNull($name, 'name value "%s" is null, but non null value was expected.');
        Assertion::maxLength($name, 40, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

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
     * Set unit
     *
     * @param string $unit
     *
     * @return static
     */
    protected function setUnit($unit)
    {
        Assertion::notNull($unit, 'unit value "%s" is null, but non null value was expected.');
        Assertion::maxLength($unit, 30, 'unit value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice($unit, [
            CallCsvSchedulerInterface::UNIT_DAY,
            CallCsvSchedulerInterface::UNIT_WEEK,
            CallCsvSchedulerInterface::UNIT_MONTH
        ], 'unitvalue "%s" is not an element of the valid values: %s');

        $this->unit = $unit;

        return $this;
    }

    /**
     * Get unit
     *
     * @return string
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * Set frequency
     *
     * @param integer $frequency
     *
     * @return static
     */
    protected function setFrequency($frequency)
    {
        Assertion::notNull($frequency, 'frequency value "%s" is null, but non null value was expected.');
        Assertion::integerish($frequency, 'frequency value "%s" is not an integer or a number castable to integer.');
        Assertion::greaterOrEqualThan($frequency, 0, 'frequency provided "%s" is not greater or equal than "%s".');

        $this->frequency = (int) $frequency;

        return $this;
    }

    /**
     * Get frequency
     *
     * @return integer
     */
    public function getFrequency()
    {
        return $this->frequency;
    }

    /**
     * Set callDirection
     *
     * @param string $callDirection | null
     *
     * @return static
     */
    protected function setCallDirection($callDirection = null)
    {
        if (!is_null($callDirection)) {
            Assertion::choice($callDirection, [
                CallCsvSchedulerInterface::CALLDIRECTION_INBOUND,
                CallCsvSchedulerInterface::CALLDIRECTION_OUTBOUND
            ], 'callDirectionvalue "%s" is not an element of the valid values: %s');
        }

        $this->callDirection = $callDirection;

        return $this;
    }

    /**
     * Get callDirection
     *
     * @return string | null
     */
    public function getCallDirection()
    {
        return $this->callDirection;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return static
     */
    protected function setEmail($email)
    {
        Assertion::notNull($email, 'email value "%s" is null, but non null value was expected.');
        Assertion::maxLength($email, 140, 'email value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set lastExecution
     *
     * @param \DateTime $lastExecution | null
     *
     * @return static
     */
    protected function setLastExecution($lastExecution = null)
    {
        if (!is_null($lastExecution)) {
            $lastExecution = \Ivoz\Core\Domain\Model\Helper\DateTimeHelper::createOrFix(
                $lastExecution,
                null
            );

            if ($this->lastExecution == $lastExecution) {
                return $this;
            }
        }

        $this->lastExecution = $lastExecution;

        return $this;
    }

    /**
     * Get lastExecution
     *
     * @return \DateTime | null
     */
    public function getLastExecution()
    {
        return !is_null($this->lastExecution) ? clone $this->lastExecution : null;
    }

    /**
     * Set lastExecutionError
     *
     * @param string $lastExecutionError | null
     *
     * @return static
     */
    protected function setLastExecutionError($lastExecutionError = null)
    {
        if (!is_null($lastExecutionError)) {
            Assertion::maxLength($lastExecutionError, 300, 'lastExecutionError value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->lastExecutionError = $lastExecutionError;

        return $this;
    }

    /**
     * Get lastExecutionError
     *
     * @return string | null
     */
    public function getLastExecutionError()
    {
        return $this->lastExecutionError;
    }

    /**
     * Set nextExecution
     *
     * @param \DateTime $nextExecution | null
     *
     * @return static
     */
    protected function setNextExecution($nextExecution = null)
    {
        if (!is_null($nextExecution)) {
            $nextExecution = \Ivoz\Core\Domain\Model\Helper\DateTimeHelper::createOrFix(
                $nextExecution,
                null
            );

            if ($this->nextExecution == $nextExecution) {
                return $this;
            }
        }

        $this->nextExecution = $nextExecution;

        return $this;
    }

    /**
     * Get nextExecution
     *
     * @return \DateTime | null
     */
    public function getNextExecution()
    {
        return !is_null($this->nextExecution) ? clone $this->nextExecution : null;
    }

    /**
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand | null
     *
     * @return static
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand = null)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface | null
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company | null
     *
     * @return static
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company = null)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface | null
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set callCsvNotificationTemplate
     *
     * @param \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface $callCsvNotificationTemplate | null
     *
     * @return static
     */
    public function setCallCsvNotificationTemplate(\Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface $callCsvNotificationTemplate = null)
    {
        $this->callCsvNotificationTemplate = $callCsvNotificationTemplate;

        return $this;
    }

    /**
     * Get callCsvNotificationTemplate
     *
     * @return \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface | null
     */
    public function getCallCsvNotificationTemplate()
    {
        return $this->callCsvNotificationTemplate;
    }

    // @codeCoverageIgnoreEnd
}
