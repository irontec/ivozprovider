<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\BalanceNotification;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Domain\Model\Helper\DateTimeHelper;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Carrier\Carrier;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplate;

/**
* BalanceNotificationAbstract
* @codeCoverageIgnore
*/
abstract class BalanceNotificationAbstract
{
    use ChangelogTrait;

    /**
     * @var ?string
     */
    protected $toAddress = null;

    /**
     * @var ?float
     */
    protected $threshold = 0;

    /**
     * @var ?\DateTime
     */
    protected $lastSent = null;

    /**
     * @var ?CompanyInterface
     */
    protected $company = null;

    /**
     * @var ?CarrierInterface
     */
    protected $carrier = null;

    /**
     * @var ?NotificationTemplateInterface
     */
    protected $notificationTemplate = null;

    /**
     * Constructor
     */
    protected function __construct()
    {
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "BalanceNotification",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): BalanceNotificationDto
    {
        return new BalanceNotificationDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|BalanceNotificationInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?BalanceNotificationDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, BalanceNotificationInterface::class);

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
     * @param BalanceNotificationDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, BalanceNotificationDto::class);

        $self = new static();

        $self
            ->setToAddress($dto->getToAddress())
            ->setThreshold($dto->getThreshold())
            ->setLastSent($dto->getLastSent())
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setCarrier($fkTransformer->transform($dto->getCarrier()))
            ->setNotificationTemplate($fkTransformer->transform($dto->getNotificationTemplate()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param BalanceNotificationDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, BalanceNotificationDto::class);

        $this
            ->setToAddress($dto->getToAddress())
            ->setThreshold($dto->getThreshold())
            ->setLastSent($dto->getLastSent())
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setCarrier($fkTransformer->transform($dto->getCarrier()))
            ->setNotificationTemplate($fkTransformer->transform($dto->getNotificationTemplate()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): BalanceNotificationDto
    {
        return self::createDto()
            ->setToAddress(self::getToAddress())
            ->setThreshold(self::getThreshold())
            ->setLastSent(self::getLastSent())
            ->setCompany(Company::entityToDto(self::getCompany(), $depth))
            ->setCarrier(Carrier::entityToDto(self::getCarrier(), $depth))
            ->setNotificationTemplate(NotificationTemplate::entityToDto(self::getNotificationTemplate(), $depth));
    }

    protected function __toArray(): array
    {
        return [
            'toAddress' => self::getToAddress(),
            'threshold' => self::getThreshold(),
            'lastSent' => self::getLastSent(),
            'companyId' => self::getCompany()?->getId(),
            'carrierId' => self::getCarrier()?->getId(),
            'notificationTemplateId' => self::getNotificationTemplate()?->getId()
        ];
    }

    protected function setToAddress(?string $toAddress = null): static
    {
        if (!is_null($toAddress)) {
            Assertion::maxLength($toAddress, 255, 'toAddress value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->toAddress = $toAddress;

        return $this;
    }

    public function getToAddress(): ?string
    {
        return $this->toAddress;
    }

    protected function setThreshold(?float $threshold = null): static
    {
        if (!is_null($threshold)) {
            $threshold = (float) $threshold;
        }

        $this->threshold = $threshold;

        return $this;
    }

    public function getThreshold(): ?float
    {
        return $this->threshold;
    }

    protected function setLastSent($lastSent = null): static
    {
        if (!is_null($lastSent)) {
            Assertion::notNull(
                $lastSent,
                'lastSent value "%s" is null, but non null value was expected.'
            );
            $lastSent = DateTimeHelper::createOrFix(
                $lastSent,
                null
            );

            if ($this->isInitialized() && $this->lastSent == $lastSent) {
                return $this;
            }
        }

        $this->lastSent = $lastSent;

        return $this;
    }

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getLastSent(): ?\DateTimeInterface
    {
        return !is_null($this->lastSent) ? clone $this->lastSent : null;
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

    protected function setCarrier(?CarrierInterface $carrier = null): static
    {
        $this->carrier = $carrier;

        return $this;
    }

    public function getCarrier(): ?CarrierInterface
    {
        return $this->carrier;
    }

    protected function setNotificationTemplate(?NotificationTemplateInterface $notificationTemplate = null): static
    {
        $this->notificationTemplate = $notificationTemplate;

        return $this;
    }

    public function getNotificationTemplate(): ?NotificationTemplateInterface
    {
        return $this->notificationTemplate;
    }
}
