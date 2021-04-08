<?php

namespace Ivoz\Provider\Domain\Model\BalanceNotification;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Carrier\CarrierDto;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateDto;

/**
* BalanceNotificationDtoAbstract
* @codeCoverageIgnore
*/
abstract class BalanceNotificationDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string|null
     */
    private $toAddress;

    /**
     * @var float|null
     */
    private $threshold = 0;

    /**
     * @var \DateTime|string|null
     */
    private $lastSent;

    /**
     * @var int
     */
    private $id;

    /**
     * @var CompanyDto | null
     */
    private $company;

    /**
     * @var CarrierDto | null
     */
    private $carrier;

    /**
     * @var NotificationTemplateDto | null
     */
    private $notificationTemplate;

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

    public function setToAddress(?string $toAddress): static
    {
        $this->toAddress = $toAddress;

        return $this;
    }

    public function getToAddress(): ?string
    {
        return $this->toAddress;
    }

    public function setThreshold(?float $threshold): static
    {
        $this->threshold = $threshold;

        return $this;
    }

    public function getThreshold(): ?float
    {
        return $this->threshold;
    }

    public function setLastSent(null|\DateTime|string $lastSent): static
    {
        $this->lastSent = $lastSent;

        return $this;
    }

    public function getLastSent(): \DateTime|string|null
    {
        return $this->lastSent;
    }

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setCompany(?CompanyDto $company): static
    {
        $this->company = $company;

        return $this;
    }

    public function getCompany(): ?CompanyDto
    {
        return $this->company;
    }

    public function setCompanyId($id): static
    {
        $value = !is_null($id)
            ? new CompanyDto($id)
            : null;

        return $this->setCompany($value);
    }

    public function getCompanyId()
    {
        if ($dto = $this->getCompany()) {
            return $dto->getId();
        }

        return null;
    }

    public function setCarrier(?CarrierDto $carrier): static
    {
        $this->carrier = $carrier;

        return $this;
    }

    public function getCarrier(): ?CarrierDto
    {
        return $this->carrier;
    }

    public function setCarrierId($id): static
    {
        $value = !is_null($id)
            ? new CarrierDto($id)
            : null;

        return $this->setCarrier($value);
    }

    public function getCarrierId()
    {
        if ($dto = $this->getCarrier()) {
            return $dto->getId();
        }

        return null;
    }

    public function setNotificationTemplate(?NotificationTemplateDto $notificationTemplate): static
    {
        $this->notificationTemplate = $notificationTemplate;

        return $this;
    }

    public function getNotificationTemplate(): ?NotificationTemplateDto
    {
        return $this->notificationTemplate;
    }

    public function setNotificationTemplateId($id): static
    {
        $value = !is_null($id)
            ? new NotificationTemplateDto($id)
            : null;

        return $this->setNotificationTemplate($value);
    }

    public function getNotificationTemplateId()
    {
        if ($dto = $this->getNotificationTemplate()) {
            return $dto->getId();
        }

        return null;
    }
}
