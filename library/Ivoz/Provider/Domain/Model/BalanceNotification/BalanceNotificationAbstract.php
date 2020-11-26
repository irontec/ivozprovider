<?php
declare(strict_types = 1);

namespace Ivoz\Provider\Domain\Model\BalanceNotification;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
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
     * @var string | null
     */
    protected $toAddress;

    /**
     * @var float | null
     */
    protected $threshold = 0;

    /**
     * @var \DateTimeInterface | null
     */
    protected $lastSent;

    /**
     * @var CompanyInterface
     */
    protected $company;

    /**
     * @var CarrierInterface
     */
    protected $carrier;

    /**
     * @var NotificationTemplateInterface
     */
    protected $notificationTemplate;

    /**
     * Constructor
     */
    protected function __construct(

    ) {

    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "BalanceNotification",
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
     * @return BalanceNotificationDto
     */
    public static function createDto($id = null)
    {
        return new BalanceNotificationDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param BalanceNotificationInterface|null $entity
     * @param int $depth
     * @return BalanceNotificationDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
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

        /** @var BalanceNotificationDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param BalanceNotificationDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, BalanceNotificationDto::class);

        $self = new static(

        );

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
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
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
     * @param int $depth
     * @return BalanceNotificationDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setToAddress(self::getToAddress())
            ->setThreshold(self::getThreshold())
            ->setLastSent(self::getLastSent())
            ->setCompany(Company::entityToDto(self::getCompany(), $depth))
            ->setCarrier(Carrier::entityToDto(self::getCarrier(), $depth))
            ->setNotificationTemplate(NotificationTemplate::entityToDto(self::getNotificationTemplate(), $depth));
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
            'carrierId' => self::getCarrier() ? self::getCarrier()->getId() : null,
            'notificationTemplateId' => self::getNotificationTemplate() ? self::getNotificationTemplate()->getId() : null
        ];
    }

    /**
     * Set toAddress
     *
     * @param string $toAddress | null
     *
     * @return static
     */
    protected function setToAddress(?string $toAddress = null): BalanceNotificationInterface
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
    public function getToAddress(): ?string
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
    protected function setThreshold(?float $threshold = null): BalanceNotificationInterface
    {
        if (!is_null($threshold)) {
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
    public function getThreshold(): ?float
    {
        return $this->threshold;
    }

    /**
     * Set lastSent
     *
     * @param \DateTimeInterface $lastSent | null
     *
     * @return static
     */
    protected function setLastSent($lastSent = null): BalanceNotificationInterface
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

    /**
     * Get lastSent
     *
     * @return \DateTimeInterface | null
     */
    public function getLastSent(): ?\DateTimeInterface
    {
        return !is_null($this->lastSent) ? clone $this->lastSent : null;
    }

    /**
     * Set company
     *
     * @param CompanyInterface | null
     *
     * @return static
     */
    protected function setCompany(?CompanyInterface $company = null): BalanceNotificationInterface
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
     * Set carrier
     *
     * @param CarrierInterface | null
     *
     * @return static
     */
    protected function setCarrier(?CarrierInterface $carrier = null): BalanceNotificationInterface
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
     * Set notificationTemplate
     *
     * @param NotificationTemplateInterface | null
     *
     * @return static
     */
    protected function setNotificationTemplate(?NotificationTemplateInterface $notificationTemplate = null): BalanceNotificationInterface
    {
        $this->notificationTemplate = $notificationTemplate;

        return $this;
    }

    /**
     * Get notificationTemplate
     *
     * @return NotificationTemplateInterface | null
     */
    public function getNotificationTemplate(): ?NotificationTemplateInterface
    {
        return $this->notificationTemplate;
    }

}
