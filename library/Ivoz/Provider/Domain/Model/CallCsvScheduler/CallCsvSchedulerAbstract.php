<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\CallCsvScheduler;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
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
     * @var string
     * comment: enum:day|week|month
     */
    protected $unit = 'month';

    /**
     * @var int
     */
    protected $frequency;

    /**
     * @var ?string
     * comment: enum:inbound|outbound
     */
    protected $callDirection = 'outbound';

    /**
     * @var string
     */
    protected $email;

    /**
     * @var ?\DateTime
     */
    protected $lastExecution = null;

    /**
     * @var ?string
     */
    protected $lastExecutionError = null;

    /**
     * @var ?\DateTime
     */
    protected $nextExecution = null;

    /**
     * @var ?BrandInterface
     */
    protected $brand = null;

    /**
     * @var ?CompanyInterface
     */
    protected $company = null;

    /**
     * @var ?NotificationTemplateInterface
     */
    protected $callCsvNotificationTemplate = null;

    /**
     * @var ?DdiInterface
     */
    protected $ddi = null;

    /**
     * @var ?CarrierInterface
     */
    protected $carrier = null;

    /**
     * @var ?RetailAccountInterface
     */
    protected $retailAccount = null;

    /**
     * @var ?ResidentialDeviceInterface
     */
    protected $residentialDevice = null;

    /**
     * @var ?UserInterface
     */
    protected $user = null;

    /**
     * @var ?FaxInterface
     */
    protected $fax = null;

    /**
     * @var ?FriendInterface
     */
    protected $friend = null;

    /**
     * @var ?DdiProviderInterface
     */
    protected $ddiProvider = null;

    /**
     * Constructor
     */
    protected function __construct(
        string $name,
        string $unit,
        int $frequency,
        string $email
    ) {
        $this->setName($name);
        $this->setUnit($unit);
        $this->setFrequency($frequency);
        $this->setEmail($email);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "CallCsvScheduler",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): CallCsvSchedulerDto
    {
        return new CallCsvSchedulerDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|CallCsvSchedulerInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?CallCsvSchedulerDto
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

        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param CallCsvSchedulerDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, CallCsvSchedulerDto::class);
        $name = $dto->getName();
        Assertion::notNull($name, 'getName value is null, but non null value was expected.');
        $unit = $dto->getUnit();
        Assertion::notNull($unit, 'getUnit value is null, but non null value was expected.');
        $frequency = $dto->getFrequency();
        Assertion::notNull($frequency, 'getFrequency value is null, but non null value was expected.');
        $email = $dto->getEmail();
        Assertion::notNull($email, 'getEmail value is null, but non null value was expected.');

        $self = new static(
            $name,
            $unit,
            $frequency,
            $email
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
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, CallCsvSchedulerDto::class);

        $name = $dto->getName();
        Assertion::notNull($name, 'getName value is null, but non null value was expected.');
        $unit = $dto->getUnit();
        Assertion::notNull($unit, 'getUnit value is null, but non null value was expected.');
        $frequency = $dto->getFrequency();
        Assertion::notNull($frequency, 'getFrequency value is null, but non null value was expected.');
        $email = $dto->getEmail();
        Assertion::notNull($email, 'getEmail value is null, but non null value was expected.');

        $this
            ->setName($name)
            ->setUnit($unit)
            ->setFrequency($frequency)
            ->setCallDirection($dto->getCallDirection())
            ->setEmail($email)
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
     */
    public function toDto(int $depth = 0): CallCsvSchedulerDto
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
     * @return array<string, mixed>
     */
    protected function __toArray(): array
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
            'brandId' => self::getBrand()?->getId(),
            'companyId' => self::getCompany()?->getId(),
            'callCsvNotificationTemplateId' => self::getCallCsvNotificationTemplate()?->getId(),
            'ddiId' => self::getDdi()?->getId(),
            'carrierId' => self::getCarrier()?->getId(),
            'retailAccountId' => self::getRetailAccount()?->getId(),
            'residentialDeviceId' => self::getResidentialDevice()?->getId(),
            'userId' => self::getUser()?->getId(),
            'faxId' => self::getFax()?->getId(),
            'friendId' => self::getFriend()?->getId(),
            'ddiProviderId' => self::getDdiProvider()?->getId()
        ];
    }

    protected function setName(string $name): static
    {
        Assertion::maxLength($name, 40, 'name value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->name = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    protected function setUnit(string $unit): static
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

    public function getUnit(): string
    {
        return $this->unit;
    }

    protected function setFrequency(int $frequency): static
    {
        Assertion::greaterOrEqualThan($frequency, 0, 'frequency provided "%s" is not greater or equal than "%s".');

        $this->frequency = $frequency;

        return $this;
    }

    public function getFrequency(): int
    {
        return $this->frequency;
    }

    protected function setCallDirection(?string $callDirection = null): static
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

    public function getCallDirection(): ?string
    {
        return $this->callDirection;
    }

    protected function setEmail(string $email): static
    {
        Assertion::maxLength($email, 140, 'email value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->email = $email;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    protected function setLastExecution(string|\DateTimeInterface|null $lastExecution = null): static
    {
        if (!is_null($lastExecution)) {

            /** @var ?\DateTime */
            $lastExecution = DateTimeHelper::createOrFix(
                $lastExecution,
                null
            );

            if ($this->isInitialized() && $this->lastExecution == $lastExecution) {
                return $this;
            }
        }

        $this->lastExecution = $lastExecution;

        return $this;
    }

    public function getLastExecution(): ?\DateTime
    {
        return !is_null($this->lastExecution) ? clone $this->lastExecution : null;
    }

    protected function setLastExecutionError(?string $lastExecutionError = null): static
    {
        if (!is_null($lastExecutionError)) {
            Assertion::maxLength($lastExecutionError, 300, 'lastExecutionError value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->lastExecutionError = $lastExecutionError;

        return $this;
    }

    public function getLastExecutionError(): ?string
    {
        return $this->lastExecutionError;
    }

    protected function setNextExecution(string|\DateTimeInterface|null $nextExecution = null): static
    {
        if (!is_null($nextExecution)) {

            /** @var ?\DateTime */
            $nextExecution = DateTimeHelper::createOrFix(
                $nextExecution,
                null
            );

            if ($this->isInitialized() && $this->nextExecution == $nextExecution) {
                return $this;
            }
        }

        $this->nextExecution = $nextExecution;

        return $this;
    }

    public function getNextExecution(): ?\DateTime
    {
        return !is_null($this->nextExecution) ? clone $this->nextExecution : null;
    }

    protected function setBrand(?BrandInterface $brand = null): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getBrand(): ?BrandInterface
    {
        return $this->brand;
    }

    protected function setCompany(?CompanyInterface $company = null): static
    {
        $this->company = $company;

        return $this;
    }

    public function getCompany(): ?CompanyInterface
    {
        return $this->company;
    }

    protected function setCallCsvNotificationTemplate(?NotificationTemplateInterface $callCsvNotificationTemplate = null): static
    {
        $this->callCsvNotificationTemplate = $callCsvNotificationTemplate;

        return $this;
    }

    public function getCallCsvNotificationTemplate(): ?NotificationTemplateInterface
    {
        return $this->callCsvNotificationTemplate;
    }

    protected function setDdi(?DdiInterface $ddi = null): static
    {
        $this->ddi = $ddi;

        return $this;
    }

    public function getDdi(): ?DdiInterface
    {
        return $this->ddi;
    }

    protected function setCarrier(?CarrierInterface $carrier = null): static
    {
        $this->carrier = $carrier;

        return $this;
    }

    public function getCarrier(): ?CarrierInterface
    {
        return $this->carrier;
    }

    protected function setRetailAccount(?RetailAccountInterface $retailAccount = null): static
    {
        $this->retailAccount = $retailAccount;

        return $this;
    }

    public function getRetailAccount(): ?RetailAccountInterface
    {
        return $this->retailAccount;
    }

    protected function setResidentialDevice(?ResidentialDeviceInterface $residentialDevice = null): static
    {
        $this->residentialDevice = $residentialDevice;

        return $this;
    }

    public function getResidentialDevice(): ?ResidentialDeviceInterface
    {
        return $this->residentialDevice;
    }

    protected function setUser(?UserInterface $user = null): static
    {
        $this->user = $user;

        return $this;
    }

    public function getUser(): ?UserInterface
    {
        return $this->user;
    }

    protected function setFax(?FaxInterface $fax = null): static
    {
        $this->fax = $fax;

        return $this;
    }

    public function getFax(): ?FaxInterface
    {
        return $this->fax;
    }

    protected function setFriend(?FriendInterface $friend = null): static
    {
        $this->friend = $friend;

        return $this;
    }

    public function getFriend(): ?FriendInterface
    {
        return $this->friend;
    }

    protected function setDdiProvider(?DdiProviderInterface $ddiProvider = null): static
    {
        $this->ddiProvider = $ddiProvider;

        return $this;
    }

    public function getDdiProvider(): ?DdiProviderInterface
    {
        return $this->ddiProvider;
    }
}
