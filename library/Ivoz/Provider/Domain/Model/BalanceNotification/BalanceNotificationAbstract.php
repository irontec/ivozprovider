<?php

namespace Ivoz\Provider\Domain\Model\BalanceNotification;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * BalanceNotificationAbstract
 * @codeCoverageIgnore
 */
abstract class BalanceNotificationAbstract
{
    /**
     * @var string
     */
    protected $toAddress;

    /**
     * @var string
     */
    protected $threshold = 0;

    /**
     * @var \DateTime
     */
    protected $lastSent;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    protected $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface
     */
    protected $carrier;

    /**
     * @var \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface
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
     * @param EntityInterface|null $entity
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

        return $entity->toDto($depth-1);
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto BalanceNotificationDto
         */
        Assertion::isInstanceOf($dto, BalanceNotificationDto::class);

        $self = new static();

        $self
            ->setToAddress($dto->getToAddress())
            ->setThreshold($dto->getThreshold())
            ->setLastSent($dto->getLastSent())
            ->setCompany($dto->getCompany())
            ->setCarrier($dto->getCarrier())
            ->setNotificationTemplate($dto->getNotificationTemplate())
        ;

        $self->sanitizeValues();
        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto BalanceNotificationDto
         */
        Assertion::isInstanceOf($dto, BalanceNotificationDto::class);

        $this
            ->setToAddress($dto->getToAddress())
            ->setThreshold($dto->getThreshold())
            ->setLastSent($dto->getLastSent())
            ->setCompany($dto->getCompany())
            ->setCarrier($dto->getCarrier())
            ->setNotificationTemplate($dto->getNotificationTemplate());



        $this->sanitizeValues();
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
            ->setCompany(\Ivoz\Provider\Domain\Model\Company\Company::entityToDto(self::getCompany(), $depth))
            ->setCarrier(\Ivoz\Provider\Domain\Model\Carrier\Carrier::entityToDto(self::getCarrier(), $depth))
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
            'carrierId' => self::getCarrier() ? self::getCarrier()->getId() : null,
            'notificationTemplateId' => self::getNotificationTemplate() ? self::getNotificationTemplate()->getId() : null
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * @deprecated
     * Set toAddress
     *
     * @param string $toAddress
     *
     * @return self
     */
    public function setToAddress($toAddress = null)
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
     * @return string
     */
    public function getToAddress()
    {
        return $this->toAddress;
    }

    /**
     * @deprecated
     * Set threshold
     *
     * @param string $threshold
     *
     * @return self
     */
    public function setThreshold($threshold = null)
    {
        if (!is_null($threshold)) {
            if (!is_null($threshold)) {
                Assertion::numeric($threshold);
                $threshold = (float) $threshold;
            }
        }

        $this->threshold = $threshold;

        return $this;
    }

    /**
     * Get threshold
     *
     * @return string
     */
    public function getThreshold()
    {
        return $this->threshold;
    }

    /**
     * @deprecated
     * Set lastSent
     *
     * @param \DateTime $lastSent
     *
     * @return self
     */
    public function setLastSent($lastSent = null)
    {
        if (!is_null($lastSent)) {
            $lastSent = \Ivoz\Core\Domain\Model\Helper\DateTimeHelper::createOrFix(
                $lastSent,
                null
            );
        }

        $this->lastSent = $lastSent;

        return $this;
    }

    /**
     * Get lastSent
     *
     * @return \DateTime
     */
    public function getLastSent()
    {
        return $this->lastSent;
    }

    /**
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return self
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company = null)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set carrier
     *
     * @param \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface $carrier
     *
     * @return self
     */
    public function setCarrier(\Ivoz\Provider\Domain\Model\Carrier\CarrierInterface $carrier = null)
    {
        $this->carrier = $carrier;

        return $this;
    }

    /**
     * Get carrier
     *
     * @return \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface
     */
    public function getCarrier()
    {
        return $this->carrier;
    }

    /**
     * Set notificationTemplate
     *
     * @param \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface $notificationTemplate
     *
     * @return self
     */
    public function setNotificationTemplate(\Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface $notificationTemplate = null)
    {
        $this->notificationTemplate = $notificationTemplate;

        return $this;
    }

    /**
     * Get notificationTemplate
     *
     * @return \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateInterface
     */
    public function getNotificationTemplate()
    {
        return $this->notificationTemplate;
    }

    // @codeCoverageIgnoreEnd
}
