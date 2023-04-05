<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\MaxUsageNotification;

use Assert\Assertion;
use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Domain\ForeignKeyTransformerInterface;
use Ivoz\Core\Domain\Model\Helper\DateTimeHelper;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplate;
use Ivoz\Provider\Domain\Model\Company\Company;

/**
* MaxUsageNotificationAbstract
* @codeCoverageIgnore
*/
abstract class MaxUsageNotificationAbstract
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
     * @var ?NotificationTemplateInterface
     */
    protected $notificationTemplate = null;

    /**
     * @var ?CompanyInterface
     */
    protected $company = null;

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
            "MaxUsageNotification",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): MaxUsageNotificationDto
    {
        return new MaxUsageNotificationDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|MaxUsageNotificationInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?MaxUsageNotificationDto
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, MaxUsageNotificationInterface::class);

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
     * @param MaxUsageNotificationDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, MaxUsageNotificationDto::class);

        $self = new static();

        $self
            ->setToAddress($dto->getToAddress())
            ->setThreshold($dto->getThreshold())
            ->setLastSent($dto->getLastSent())
            ->setNotificationTemplate($fkTransformer->transform($dto->getNotificationTemplate()))
            ->setCompany($fkTransformer->transform($dto->getCompany()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param MaxUsageNotificationDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, MaxUsageNotificationDto::class);

        $this
            ->setToAddress($dto->getToAddress())
            ->setThreshold($dto->getThreshold())
            ->setLastSent($dto->getLastSent())
            ->setNotificationTemplate($fkTransformer->transform($dto->getNotificationTemplate()))
            ->setCompany($fkTransformer->transform($dto->getCompany()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): MaxUsageNotificationDto
    {
        return self::createDto()
            ->setToAddress(self::getToAddress())
            ->setThreshold(self::getThreshold())
            ->setLastSent(self::getLastSent())
            ->setNotificationTemplate(NotificationTemplate::entityToDto(self::getNotificationTemplate(), $depth))
            ->setCompany(Company::entityToDto(self::getCompany(), $depth));
    }

    /**
     * @return array<string, mixed>
     */
    protected function __toArray(): array
    {
        return [
            'toAddress' => self::getToAddress(),
            'threshold' => self::getThreshold(),
            'lastSent' => self::getLastSent(),
            'notificationTemplateId' => self::getNotificationTemplate()?->getId(),
            'companyId' => self::getCompany()?->getId()
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

    protected function setLastSent(string|\DateTimeInterface|null $lastSent = null): static
    {
        if (!is_null($lastSent)) {

            /** @var ?\DateTime */
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

    public function getLastSent(): ?\DateTime
    {
        return !is_null($this->lastSent) ? clone $this->lastSent : null;
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

    protected function setCompany(?CompanyInterface $company = null): static
    {
        $this->company = $company;

        return $this;
    }

    public function getCompany(): ?CompanyInterface
    {
        return $this->company;
    }
}
