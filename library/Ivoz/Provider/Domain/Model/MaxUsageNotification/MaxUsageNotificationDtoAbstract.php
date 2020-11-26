<?php

namespace Ivoz\Provider\Domain\Model\MaxUsageNotification;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
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
     * @var string | null
     */
    private $toAddress;

    /**
     * @var float | null
     */
    private $threshold = 0;

    /**
     * @var \DateTimeInterface | null
     */
    private $lastSent;

    /**
     * @var int
     */
    private $id;

    /**
     * @var NotificationTemplateDto | null
     */
    private $notificationTemplate;

    /**
     * @var CompanyDto | null
     */
    private $company;

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
            'notificationTemplateId' => 'notificationTemplate',
            'companyId' => 'company'
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

    /**
     * @param string $toAddress | null
     *
     * @return static
     */
    public function setToAddress(?string $toAddress = null): self
    {
        $this->toAddress = $toAddress;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getToAddress(): ?string
    {
        return $this->toAddress;
    }

    /**
     * @param float $threshold | null
     *
     * @return static
     */
    public function setThreshold(?float $threshold = null): self
    {
        $this->threshold = $threshold;

        return $this;
    }

    /**
     * @return float | null
     */
    public function getThreshold(): ?float
    {
        return $this->threshold;
    }

    /**
     * @param \DateTimeInterface $lastSent | null
     *
     * @return static
     */
    public function setLastSent($lastSent = null): self
    {
        $this->lastSent = $lastSent;

        return $this;
    }

    /**
     * @return \DateTimeInterface | null
     */
    public function getLastSent()
    {
        return $this->lastSent;
    }

    /**
     * @param int $id | null
     *
     * @return static
     */
    public function setId(?int $id = null): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param NotificationTemplateDto | null
     *
     * @return static
     */
    public function setNotificationTemplate(?NotificationTemplateDto $notificationTemplate = null): self
    {
        $this->notificationTemplate = $notificationTemplate;

        return $this;
    }

    /**
     * @return NotificationTemplateDto | null
     */
    public function getNotificationTemplate(): ?NotificationTemplateDto
    {
        return $this->notificationTemplate;
    }

    /**
     * @return static
     */
    public function setNotificationTemplateId($id): self
    {
        $value = !is_null($id)
            ? new NotificationTemplateDto($id)
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

    /**
     * @param CompanyDto | null
     *
     * @return static
     */
    public function setCompany(?CompanyDto $company = null): self
    {
        $this->company = $company;

        return $this;
    }

    /**
     * @return CompanyDto | null
     */
    public function getCompany(): ?CompanyDto
    {
        return $this->company;
    }

    /**
     * @return static
     */
    public function setCompanyId($id): self
    {
        $value = !is_null($id)
            ? new CompanyDto($id)
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

}
