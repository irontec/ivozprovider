<?php

namespace Ivoz\Provider\Domain\Model\BalanceNotification;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class BalanceNotificationDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $toAddress;

    /**
     * @var float
     */
    private $threshold = 0;

    /**
     * @var \DateTime | string
     */
    private $lastSent;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyDto | null
     */
    private $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\Carrier\CarrierDto | null
     */
    private $carrier;

    /**
     * @var \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateDto | null
     */
    private $notificationTemplate;


    use DtoNormalizer;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '', string $role = null)
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'toAddress' => 'toAddress',
            'threshold' => 'threshold',
            'lastSent' => 'lastSent',
            'id' => 'id',
            'companyId' => 'company',
            'carrierId' => 'carrier',
            'notificationTemplateId' => 'notificationTemplate'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'toAddress' => $this->getToAddress(),
            'threshold' => $this->getThreshold(),
            'lastSent' => $this->getLastSent(),
            'id' => $this->getId(),
            'company' => $this->getCompany(),
            'carrier' => $this->getCarrier(),
            'notificationTemplate' => $this->getNotificationTemplate()
        ];

        if (!$hideSensitiveData) {
            return $response;
        }

        foreach ($this->sensitiveFields as $sensitiveField) {
            if (!array_key_exists($sensitiveField, $response)) {
                throw new \Exception($sensitiveField . ' field was not found');
            }
            $response[$sensitiveField] = '*****';
        }

        return $response;
    }

    /**
     * @param string $toAddress
     *
     * @return static
     */
    public function setToAddress($toAddress = null)
    {
        $this->toAddress = $toAddress;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getToAddress()
    {
        return $this->toAddress;
    }

    /**
     * @param float $threshold
     *
     * @return static
     */
    public function setThreshold($threshold = null)
    {
        $this->threshold = $threshold;

        return $this;
    }

    /**
     * @return float | null
     */
    public function getThreshold()
    {
        return $this->threshold;
    }

    /**
     * @param \DateTime $lastSent
     *
     * @return static
     */
    public function setLastSent($lastSent = null)
    {
        $this->lastSent = $lastSent;

        return $this;
    }

    /**
     * @return \DateTime | null
     */
    public function getLastSent()
    {
        return $this->lastSent;
    }

    /**
     * @param integer $id
     *
     * @return static
     */
    public function setId($id = null)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return integer | null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyDto $company
     *
     * @return static
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyDto $company = null)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyDto | null
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setCompanyId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Company\CompanyDto($id)
            : null;

        return $this->setCompany($value);
    }

    /**
     * @return mixed | null
     */
    public function getCompanyId()
    {
        if ($dto = $this->getCompany()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Carrier\CarrierDto $carrier
     *
     * @return static
     */
    public function setCarrier(\Ivoz\Provider\Domain\Model\Carrier\CarrierDto $carrier = null)
    {
        $this->carrier = $carrier;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Carrier\CarrierDto | null
     */
    public function getCarrier()
    {
        return $this->carrier;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setCarrierId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Carrier\CarrierDto($id)
            : null;

        return $this->setCarrier($value);
    }

    /**
     * @return mixed | null
     */
    public function getCarrierId()
    {
        if ($dto = $this->getCarrier()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateDto $notificationTemplate
     *
     * @return static
     */
    public function setNotificationTemplate(\Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateDto $notificationTemplate = null)
    {
        $this->notificationTemplate = $notificationTemplate;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateDto | null
     */
    public function getNotificationTemplate()
    {
        return $this->notificationTemplate;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setNotificationTemplateId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateDto($id)
            : null;

        return $this->setNotificationTemplate($value);
    }

    /**
     * @return mixed | null
     */
    public function getNotificationTemplateId()
    {
        if ($dto = $this->getNotificationTemplate()) {
            return $dto->getId();
        }

        return null;
    }
}
