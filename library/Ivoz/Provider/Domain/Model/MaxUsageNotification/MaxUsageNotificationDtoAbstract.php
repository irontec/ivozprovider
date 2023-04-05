<?php

namespace Ivoz\Provider\Domain\Model\MaxUsageNotification;

use Ivoz\Core\Domain\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateDto;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;

/**
* MaxUsageNotificationDtoAbstract
* @codeCoverageIgnore
*/
abstract class MaxUsageNotificationDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string|null
     */
    private $toAddress = null;

    /**
     * @var float|null
     */
    private $threshold = 0;

    /**
     * @var \DateTimeInterface|string|null
     */
    private $lastSent = null;

    /**
     * @var int|null
     */
    private $id = null;

    /**
     * @var NotificationTemplateDto | null
     */
    private $notificationTemplate = null;

    /**
     * @var CompanyDto | null
     */
    private $company = null;

    /**
     * @param string|int|null $id
     */
    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
    * @inheritdoc
    */
    public static function getPropertyMap(string $context = '', string $role = null): array
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
            'toAddress' => 'toAddress',
            'threshold' => 'threshold',
            'lastSent' => 'lastSent',
            'id' => 'id',
            'notificationTemplateId' => 'notificationTemplate',
            'companyId' => 'company'
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
    {
        $response = [
            'toAddress' => $this->getToAddress(),
            'threshold' => $this->getThreshold(),
            'lastSent' => $this->getLastSent(),
            'id' => $this->getId(),
            'notificationTemplate' => $this->getNotificationTemplate(),
            'company' => $this->getCompany()
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

    public function setLastSent(null|\DateTimeInterface|string $lastSent): static
    {
        $this->lastSent = $lastSent;

        return $this;
    }

    public function getLastSent(): \DateTimeInterface|string|null
    {
        return $this->lastSent;
    }

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
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
}
