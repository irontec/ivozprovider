<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\CallCsvScheduler;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Domain\Model\Helper\DateTimeHelper;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountInterface;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDeviceInterface;
use Ivoz\Provider\Domain\Model\User\UserInterface;
use Ivoz\Provider\Domain\Model\Fax\FaxInterface;
use Ivoz\Provider\Domain\Model\Friend\FriendInterface;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProviderInterface;
use Ivoz\Provider\Domain\Model\Brand\Brand;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplate;
use Ivoz\Provider\Domain\Model\Ddi\Ddi;
use Ivoz\Provider\Domain\Model\Carrier\Carrier;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccount;
use Ivoz\Provider\Domain\Model\ResidentialDevice\ResidentialDevice;
use Ivoz\Provider\Domain\Model\User\User;
use Ivoz\Provider\Domain\Model\Fax\Fax;
use Ivoz\Provider\Domain\Model\Friend\Friend;
use Ivoz\Provider\Domain\Model\DdiProvider\DdiProvider;

/**
* CallCsvSchedulerAbstract
* @codeCoverageIgnore
*/
abstract class CallCsvSchedulerAbstract
{
    use ChangelogTrait;

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
     * @var int
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
     * @var \DateTimeInterface | null
     */
    protected $lastExecution;

    /**
     * @var string | null
     */
    protected $lastExecutionError;

    /**
     * @var \DateTimeInterface | null
     */
    protected $nextExecution;

    /**
     * @var BrandInterface
     */
    protected $brand;

    /**
     * @var CompanyInterface
     */
    protected $company;

    /**
     * @var NotificationTemplateInterface
     */
    protected $callCsvNotificationTemplate;

    /**
     * @var DdiInterface
     */
    protected $ddi;

    /**
     * @var CarrierInterface
     */
    protected $carrier;

    /**
     * @var RetailAccountInterface
     */
    protected $retailAccount;

    /**
     * @var ResidentialDeviceInterface
     */
    protected $residentialDevice;

    /**
     * @var UserInterface
     */
    protected $user;

    /**
     * @var FaxInterface
     */
    protected $fax;

    /**
     * @var FriendInterface
     */
    protected $friend;

    /**
     * @var DdiProviderInterface
     */
    protected $ddiProvider;

    /**
     * Constructor
     */
    protected function __construct(
        $name,
        $unit,
        $frequency,
        $email
    ) {
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
        ForeignKeyTransformerInterface $fkTransformer
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
            ->setDdiProvider($fkTransformer->transform($dto->getDdiProvider()));

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
        ForeignKeyTransformerInterface $fkTransformer
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
            ->setBrand(Brand::entityToDto(self::getBrand(), $depth))
            ->setCompany(Company::entityToDto(self::getCompany(), $depth))
            ->setCallCsvNotificationTemplate(NotificationTemplate::entityToDto(self::getCallCsvNotificationTemplate(), $depth))
            ->setDdi(Ddi::entityToDto(self::getDdi(), $depth))
            ->setCarrier(Carrier::entityToDto(self::getCarrier(), $depth))
            ->setRetailAccount(RetailAccount::entityToDto(self::getRetailAccount(), $depth))
            ->setResidentialDevice(ResidentialDevice::entityToDto(self::getResidentialDevice(), $depth))
            ->setUser(User::entityToDto(self::getUser(), $depth))
            ->setFax(Fax::entityToDto(self::getFax(), $depth))
            ->setFriend(Friend::entityToDto(self::getFriend(), $depth))
            ->setDdiProvider(DdiProvider::entityToDto(self::getDdiProvider(), $depth));
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

    /**
     * Set name
     *
     * @param string $name
     *
     * @return static
     */
    protected function setName(string $name): CallCsvSchedulerInterface
    {
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
    protected function setUnit(string $unit): CallCsvSchedulerInterface
    {
        Assertion::maxLength($unit, 30, 'unit value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice(
            $unit,
            [
                CallCsvSchedulerInterface::UNIT_DAY,
                CallCsvSchedulerInterface::UNIT_WEEK,
                CallCsvSchedulerInterface::UNIT_MONTH,
            ],
            'unitvalue "%s" is not an element of the valid values: %s'
        );

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
     * @param int $frequency
     *
     * @return static
     */
    protected function setFrequency(int $frequency): CallCsvSchedulerInterface
    {
        Assertion::greaterOrEqualThan($frequency, 0, 'frequency provided "%s" is not greater or equal than "%s".');

        $this->frequency = $frequency;

        return $this;
    }

    /**
     * Get frequency
     *
     * @return int
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
    protected function setCallDirection(?string $callDirection = null): CallCsvSchedulerInterface
    {
        if (!is_null($callDirection)) {
            Assertion::choice(
                $callDirection,
                [
                    CallCsvSchedulerInterface::CALLDIRECTION_INBOUND,
                    CallCsvSchedulerInterface::CALLDIRECTION_OUTBOUND,
                ],
                'callDirectionvalue "%s" is not an element of the valid values: %s'
            );
        }

        $this->callDirection = $callDirection;

        return $this;
    }

    /**
     * Get callDirection
     *
     * @return string | null
     */
    public function getCallDirection(): ?string
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
    protected function setEmail(string $email): CallCsvSchedulerInterface
    {
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
     * @param \DateTimeInterface $lastExecution | null
     *
     * @return static
     */
    protected function setLastExecution($lastExecution = null): CallCsvSchedulerInterface
    {
        if (!is_null($lastExecution)) {
            Assertion::notNull(
                $lastExecution,
                'lastExecution value "%s" is null, but non null value was expected.'
            );
            $lastExecution = DateTimeHelper::createOrFix(
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
     * @return \DateTimeInterface | null
     */
    public function getLastExecution(): ?\DateTimeInterface
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
    protected function setLastExecutionError(?string $lastExecutionError = null): CallCsvSchedulerInterface
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
    public function getLastExecutionError(): ?string
    {
        return $this->lastExecutionError;
    }

    /**
     * Set nextExecution
     *
     * @param \DateTimeInterface $nextExecution | null
     *
     * @return static
     */
    protected function setNextExecution($nextExecution = null): CallCsvSchedulerInterface
    {
        if (!is_null($nextExecution)) {
            Assertion::notNull(
                $nextExecution,
                'nextExecution value "%s" is null, but non null value was expected.'
            );
            $nextExecution = DateTimeHelper::createOrFix(
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
     * @return \DateTimeInterface | null
     */
    public function getNextExecution(): ?\DateTimeInterface
    {
        return !is_null($this->nextExecution) ? clone $this->nextExecution : null;
    }

    /**
     * Set brand
     *
     * @param BrandInterface | null
     *
     * @return static
     */
    protected function setBrand(?BrandInterface $brand = null): CallCsvSchedulerInterface
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return BrandInterface | null
     */
    public function getBrand(): ?BrandInterface
    {
        return $this->brand;
    }

    /**
     * Set company
     *
     * @param CompanyInterface | null
     *
     * @return static
     */
    protected function setCompany(?CompanyInterface $company = null): CallCsvSchedulerInterface
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return CompanyInterface | null
     */
    public function getCompany(): ?CompanyInterface
    {
        return $this->company;
    }

    /**
     * Set callCsvNotificationTemplate
     *
     * @param NotificationTemplateInterface | null
     *
     * @return static
     */
    protected function setCallCsvNotificationTemplate(?NotificationTemplateInterface $callCsvNotificationTemplate = null): CallCsvSchedulerInterface
    {
        $this->callCsvNotificationTemplate = $callCsvNotificationTemplate;

        return $this;
    }

    /**
     * Get callCsvNotificationTemplate
     *
     * @return NotificationTemplateInterface | null
     */
    public function getCallCsvNotificationTemplate(): ?NotificationTemplateInterface
    {
        return $this->callCsvNotificationTemplate;
    }

    /**
     * Set ddi
     *
     * @param DdiInterface | null
     *
     * @return static
     */
    protected function setDdi(?DdiInterface $ddi = null): CallCsvSchedulerInterface
    {
        $this->ddi = $ddi;

        return $this;
    }

    /**
     * Get ddi
     *
     * @return DdiInterface | null
     */
    public function getDdi(): ?DdiInterface
    {
        return $this->ddi;
    }

    /**
     * Set carrier
     *
     * @param CarrierInterface | null
     *
     * @return static
     */
    protected function setCarrier(?CarrierInterface $carrier = null): CallCsvSchedulerInterface
    {
        $this->carrier = $carrier;

        return $this;
    }

    /**
     * Get carrier
     *
     * @return CarrierInterface | null
     */
    public function getCarrier(): ?CarrierInterface
    {
        return $this->carrier;
    }

    /**
     * Set retailAccount
     *
     * @param RetailAccountInterface | null
     *
     * @return static
     */
    protected function setRetailAccount(?RetailAccountInterface $retailAccount = null): CallCsvSchedulerInterface
    {
        $this->retailAccount = $retailAccount;

        return $this;
    }

    /**
     * Get retailAccount
     *
     * @return RetailAccountInterface | null
     */
    public function getRetailAccount(): ?RetailAccountInterface
    {
        return $this->retailAccount;
    }

    /**
     * Set residentialDevice
     *
     * @param ResidentialDeviceInterface | null
     *
     * @return static
     */
    protected function setResidentialDevice(?ResidentialDeviceInterface $residentialDevice = null): CallCsvSchedulerInterface
    {
        $this->residentialDevice = $residentialDevice;

        return $this;
    }

    /**
     * Get residentialDevice
     *
     * @return ResidentialDeviceInterface | null
     */
    public function getResidentialDevice(): ?ResidentialDeviceInterface
    {
        return $this->residentialDevice;
    }

    /**
     * Set user
     *
     * @param UserInterface | null
     *
     * @return static
     */
    protected function setUser(?UserInterface $user = null): CallCsvSchedulerInterface
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return UserInterface | null
     */
    public function getUser(): ?UserInterface
    {
        return $this->user;
    }

    /**
     * Set fax
     *
     * @param FaxInterface | null
     *
     * @return static
     */
    protected function setFax(?FaxInterface $fax = null): CallCsvSchedulerInterface
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return FaxInterface | null
     */
    public function getFax(): ?FaxInterface
    {
        return $this->fax;
    }

    /**
     * Set friend
     *
     * @param FriendInterface | null
     *
     * @return static
     */
    protected function setFriend(?FriendInterface $friend = null): CallCsvSchedulerInterface
    {
        $this->friend = $friend;

        return $this;
    }

    /**
     * Get friend
     *
     * @return FriendInterface | null
     */
    public function getFriend(): ?FriendInterface
    {
        return $this->friend;
    }

    /**
     * Set ddiProvider
     *
     * @param DdiProviderInterface | null
     *
     * @return static
     */
    protected function setDdiProvider(?DdiProviderInterface $ddiProvider = null): CallCsvSchedulerInterface
    {
        $this->ddiProvider = $ddiProvider;

        return $this;
    }

    /**
     * Get ddiProvider
     *
     * @return DdiProviderInterface | null
     */
    public function getDdiProvider(): ?DdiProviderInterface
    {
        return $this->ddiProvider;
    }

}
