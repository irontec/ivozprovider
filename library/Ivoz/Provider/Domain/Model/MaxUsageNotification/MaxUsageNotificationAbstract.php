<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\MaxUsageNotification;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
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
     * @var string | null
     */
    protected $toAddress;

    /**
     * @var float | null
     */
    protected $threshold = 0;

    /**
     * @var \DateTime | null
     */
    protected $lastSent;

    /**
     * @var NotificationTemplateInterface | null
     */
    protected $notificationTemplate;

    /**
     * @var CompanyInterface | null
     */
    protected $company;

    /**
     * Constructor
     */
    protected function __construct()
    {
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "MaxUsageNotification",
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
     * @return MaxUsageNotificationDto
     */
    public static function createDto($id = null)
    {
        return new MaxUsageNotificationDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param MaxUsageNotificationInterface|null $entity
     * @param int $depth
     * @return MaxUsageNotificationDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
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

        /** @var MaxUsageNotificationDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param MaxUsageNotificationDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
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
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
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
     * @param int $depth
     * @return MaxUsageNotificationDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setToAddress(self::getToAddress())
            ->setThreshold(self::getThreshold())
            ->setLastSent(self::getLastSent())
            ->setNotificationTemplate(NotificationTemplate::entityToDto(self::getNotificationTemplate(), $depth))
            ->setCompany(Company::entityToDto(self::getCompany(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'toAddress' => self::getToAddress(),
            'threshold' => self::getThreshold(),
            'lastSent' => self::getLastSent(),
            'notificationTemplateId' => self::getNotificationTemplate() ? self::getNotificationTemplate()->getId() : null,
            'companyId' => self::getCompany() ? self::getCompany()->getId() : null
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

            if ($this->lastSent == $lastSent) {
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
