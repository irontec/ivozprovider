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

    /**
     * @var \Ivoz\Provider\Domain\Model\Ddi\DdiInterface | null
     */
    protected $ddi;

    /**
     * @var \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface | null
     */
    protected $carrier;

    /**
     * @var \Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface | null
     */
    protected $retailAccount;

    /**
     * @var \Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface | null
     */
    protected $residentialDevice;

    /**
     * @var \Ivoz\Provider\Domain\Model\User\UserInterface | null
     */
    protected $user;

    /**
     * @var \Ivoz\Provider\Domain\Model\Fax\FaxInterface | null
     */
    protected $fax;

    /**
     * @var \Ivoz\Provider\Domain\Model\Friend\FriendInterface | null
     */
    protected $friend;

    /**
     * @var \Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface | null
     */
    protected $ddiProvider;


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
            ->setDdi($fkTransformer->transform($dto->getDdi()))
            ->setCarrier($fkTransformer->transform($dto->getCarrier()))
            ->setRetailAccount($fkTransformer->transform($dto->getRetailAccount()))
            ->setResidentialDevice($fkTransformer->transform($dto->getResidentialDevice()))
            ->setUser($fkTransformer->transform($dto->getUser()))
            ->setFax($fkTransformer->transform($dto->getFax()))
            ->setFriend($fkTransformer->transform($dto->getFriend()))
            ->setDdiProvider($fkTransformer->transform($dto->getDdiProvider()))
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
            ->setCallCsvNotificationTemplate($fkTransformer->transform($dto->getCallCsvNotificationTemplate()))
            ->setDdi($fkTransformer->transform($dto->getDdi()))
            ->setCarrier($fkTransformer->transform($dto->getCarrier()))
            ->setRetailAccount($fkTransformer->transform($dto->getRetailAccount()))
            ->setResidentialDevice($fkTransformer->transform($dto->getResidentialDevice()))
            ->setUser($fkTransformer->transform($dto->getUser()))
            ->setFax($fkTransformer->transform($dto->getFax()))
            ->setFriend($fkTransformer->transform($dto->getFriend()))
            ->setDdiProvider($fkTransformer->transform($dto->getDdiProvider()));



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
            ->setCallCsvNotificationTemplate(\Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplate::entityToDto(self::getCallCsvNotificationTemplate(), $depth))
            ->setDdi(\Ivoz\Provider\Domain\Model\Ddi\Ddi::entityToDto(self::getDdi(), $depth))
            ->setCarrier(\Ivoz\Provider\Domain\Model\Carrier\Carrier::entityToDto(self::getCarrier(), $depth))
            ->setRetailAccount(\Ivoz\Provider\Domain\Model\RetailAccount\RetailAccount::entityToDto(self::getRetailAccount(), $depth))
            ->setResidentialDevice(\Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDevice::entityToDto(self::getResidentialDevice(), $depth))
            ->setUser(\Ivoz\Provider\Domain\Model\User\User::entityToDto(self::getUser(), $depth))
            ->setFax(\Ivoz\Provider\Domain\Model\Fax\Fax::entityToDto(self::getFax(), $depth))
            ->setFriend(\Ivoz\Provider\Domain\Model\Friend\Friend::entityToDto(self::getFriend(), $depth))
            ->setDdiProvider(\Ivoz\Provider\Domain\Model\DdiProvider\DdiProvider::entityToDto(self::getDdiProvider(), $depth));
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
            'callCsvNotificationTemplateId' => self::getCallCsvNotificationTemplate() ? self::getCallCsvNotificationTemplate()->getId() : null,
            'ddiId' => self::getDdi() ? self::getDdi()->getId() : null,
            'carrierId' => self::getCarrier() ? self::getCarrier()->getId() : null,
            'retailAccountId' => self::getRetailAccount() ? self::getRetailAccount()->getId() : null,
            'residentialDeviceId' => self::getResidentialDevice() ? self::getResidentialDevice()->getId() : null,
            'userId' => self::getUser() ? self::getUser()->getId() : null,
            'faxId' => self::getFax() ? self::getFax()->getId() : null,
            'friendId' => self::getFriend() ? self::getFriend()->getId() : null,
            'ddiProviderId' => self::getDdiProvider() ? self::getDdiProvider()->getId() : null
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
    public function getName(): string
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
    public function getUnit(): string
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
    public function getFrequency(): int
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
    public function getEmail(): string
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
    protected function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand = null)
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
    protected function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company = null)
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
    protected function setCallCsvNotificationTemplate(\Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface $callCsvNotificationTemplate = null)
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

    /**
     * Set ddi
     *
     * @param \Ivoz\Provider\Domain\Model\Ddi\DdiInterface $ddi | null
     *
     * @return static
     */
    protected function setDdi(\Ivoz\Provider\Domain\Model\Ddi\DdiInterface $ddi = null)
    {
        $this->ddi = $ddi;

        return $this;
    }

    /**
     * Get ddi
     *
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface | null
     */
    public function getDdi()
    {
        return $this->ddi;
    }

    /**
     * Set carrier
     *
     * @param \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface $carrier | null
     *
     * @return static
     */
    protected function setCarrier(\Ivoz\Provider\Domain\Model\Carrier\CarrierInterface $carrier = null)
    {
        $this->carrier = $carrier;

        return $this;
    }

    /**
     * Get carrier
     *
     * @return \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface | null
     */
    public function getCarrier()
    {
        return $this->carrier;
    }

    /**
     * Set retailAccount
     *
     * @param \Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface $retailAccount | null
     *
     * @return static
     */
    protected function setRetailAccount(\Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface $retailAccount = null)
    {
        $this->retailAccount = $retailAccount;

        return $this;
    }

    /**
     * Get retailAccount
     *
     * @return \Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface | null
     */
    public function getRetailAccount()
    {
        return $this->retailAccount;
    }

    /**
     * Set residentialDevice
     *
     * @param \Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface $residentialDevice | null
     *
     * @return static
     */
    protected function setResidentialDevice(\Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface $residentialDevice = null)
    {
        $this->residentialDevice = $residentialDevice;

        return $this;
    }

    /**
     * Get residentialDevice
     *
     * @return \Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface | null
     */
    public function getResidentialDevice()
    {
        return $this->residentialDevice;
    }

    /**
     * Set user
     *
     * @param \Ivoz\Provider\Domain\Model\User\UserInterface $user | null
     *
     * @return static
     */
    protected function setUser(\Ivoz\Provider\Domain\Model\User\UserInterface $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface | null
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set fax
     *
     * @param \Ivoz\Provider\Domain\Model\Fax\FaxInterface $fax | null
     *
     * @return static
     */
    protected function setFax(\Ivoz\Provider\Domain\Model\Fax\FaxInterface $fax = null)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return \Ivoz\Provider\Domain\Model\Fax\FaxInterface | null
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set friend
     *
     * @param \Ivoz\Provider\Domain\Model\Friend\FriendInterface $friend | null
     *
     * @return static
     */
    protected function setFriend(\Ivoz\Provider\Domain\Model\Friend\FriendInterface $friend = null)
    {
        $this->friend = $friend;

        return $this;
    }

    /**
     * Get friend
     *
     * @return \Ivoz\Provider\Domain\Model\Friend\FriendInterface | null
     */
    public function getFriend()
    {
        return $this->friend;
    }

    /**
     * Set ddiProvider
     *
     * @param \Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface $ddiProvider | null
     *
     * @return static
     */
    protected function setDdiProvider(\Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface $ddiProvider = null)
    {
        $this->ddiProvider = $ddiProvider;

        return $this;
    }

    /**
     * Get ddiProvider
     *
     * @return \Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface | null
     */
    public function getDdiProvider()
    {
        return $this->ddiProvider;
    }

    // @codeCoverageIgnoreEnd
}
