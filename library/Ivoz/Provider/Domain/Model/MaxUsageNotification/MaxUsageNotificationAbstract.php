<?php

namespace Ivoz\Provider\Domain\Model\MaxUsageNotification;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * MaxUsageNotificationAbstract
 * @codeCoverageIgnore
 */
abstract class MaxUsageNotificationAbstract
{
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
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyInterface | null
     */
    protected $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface | null
     */
    protected $notificationTemplate;


    use ChangelogTrait;

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
     * @param null $id
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
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, MaxUsageNotificationDto::class);

        $self = new static();

        $self
            ->setToAddress($dto->getToAddress())
            ->setThreshold($dto->getThreshold())
            ->setLastSent($dto->getLastSent())
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setNotificationTemplate($fkTransformer->transform($dto->getNotificationTemplate()))
        ;

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
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, MaxUsageNotificationDto::class);

        $this
            ->setToAddress($dto->getToAddress())
            ->setThreshold($dto->getThreshold())
            ->setLastSent($dto->getLastSent())
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setNotificationTemplate($fkTransformer->transform($dto->getNotificationTemplate()));



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
            ->setCompany(\Ivoz\Provider\Domain\Model\Company\Company::entityToDto(self::getCompany(), $depth))
            ->setNotificationTemplate(\Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplate::entityToDto(self::getNotificationTemplate(), $depth));
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
            'companyId' => self::getCompany() ? self::getCompany()->getId() : null,
            'notificationTemplateId' => self::getNotificationTemplate() ? self::getNotificationTemplate()->getId() : null
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * Set toAddress
     *
     * @param string $toAddress | null
     *
     * @return static
     */
    protected function setToAddress($toAddress = null)
    {
        if (!is_null($toAddress)) {
            Assertion::maxLength($toAddress, 255, 'toAddress value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->toAddress = $toAddress;

        return $this;
    }

    /**
     * Get toAddress
     *
     * @return string | null
     */
    public function getToAddress()
    {
        return $this->toAddress;
    }

    /**
     * Set threshold
     *
     * @param float $threshold | null
     *
     * @return static
     */
    protected function setThreshold($threshold = null)
    {
        if (!is_null($threshold)) {
            Assertion::numeric($threshold);
            $threshold = (float) $threshold;
        }

        $this->threshold = $threshold;

        return $this;
    }

    /**
     * Get threshold
     *
     * @return float | null
     */
    public function getThreshold()
    {
        return $this->threshold;
    }

    /**
     * Set lastSent
     *
     * @param \DateTime $lastSent | null
     *
     * @return static
     */
    protected function setLastSent($lastSent = null)
    {
        if (!is_null($lastSent)) {
            $lastSent = \Ivoz\Core\Domain\Model\Helper\DateTimeHelper::createOrFix(
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

    /**
     * Get lastSent
     *
     * @return \DateTime | null
     */
    public function getLastSent()
    {
        return !is_null($this->lastSent) ? clone $this->lastSent : null;
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
     * Set notificationTemplate
     *
     * @param \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface $notificationTemplate | null
     *
     * @return static
     */
    protected function setNotificationTemplate(\Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface $notificationTemplate = null)
    {
        $this->notificationTemplate = $notificationTemplate;

        return $this;
    }

    /**
     * Get notificationTemplate
     *
     * @return \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface | null
     */
    public function getNotificationTemplate()
    {
        return $this->notificationTemplate;
    }

    // @codeCoverageIgnoreEnd
}
