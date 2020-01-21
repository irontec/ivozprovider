<?php

namespace Ivoz\Provider\Domain\Model\CallCsvScheduler;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class CallCsvSchedulerDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $unit = 'month';

    /**
     * @var integer
     */
    private $frequency;

    /**
     * @var string
     */
    private $callDirection = 'outbound';

    /**
     * @var string
     */
    private $email;

    /**
     * @var \DateTime | string
     */
    private $lastExecution;

    /**
     * @var string
     */
    private $lastExecutionError;

    /**
     * @var \DateTime | string
     */
    private $nextExecution;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandDto | null
     */
    private $brand;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyDto | null
     */
    private $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateDto | null
     */
    private $callCsvNotificationTemplate;


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
            'name' => 'name',
            'unit' => 'unit',
            'frequency' => 'frequency',
            'callDirection' => 'callDirection',
            'email' => 'email',
            'lastExecution' => 'lastExecution',
            'lastExecutionError' => 'lastExecutionError',
            'nextExecution' => 'nextExecution',
            'id' => 'id',
            'brandId' => 'brand',
            'companyId' => 'company',
            'callCsvNotificationTemplateId' => 'callCsvNotificationTemplate'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        return [
            'name' => $this->getName(),
            'unit' => $this->getUnit(),
            'frequency' => $this->getFrequency(),
            'callDirection' => $this->getCallDirection(),
            'email' => $this->getEmail(),
            'lastExecution' => $this->getLastExecution(),
            'lastExecutionError' => $this->getLastExecutionError(),
            'nextExecution' => $this->getNextExecution(),
            'id' => $this->getId(),
            'brand' => $this->getBrand(),
            'company' => $this->getCompany(),
            'callCsvNotificationTemplate' => $this->getCallCsvNotificationTemplate()
        ];
    }

    /**
     * @param string $name
     *
     * @return static
     */
    public function setName($name = null)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $unit
     *
     * @return static
     */
    public function setUnit($unit = null)
    {
        $this->unit = $unit;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * @param integer $frequency
     *
     * @return static
     */
    public function setFrequency($frequency = null)
    {
        $this->frequency = $frequency;

        return $this;
    }

    /**
     * @return integer | null
     */
    public function getFrequency()
    {
        return $this->frequency;
    }

    /**
     * @param string $callDirection
     *
     * @return static
     */
    public function setCallDirection($callDirection = null)
    {
        $this->callDirection = $callDirection;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getCallDirection()
    {
        return $this->callDirection;
    }

    /**
     * @param string $email
     *
     * @return static
     */
    public function setEmail($email = null)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param \DateTime $lastExecution
     *
     * @return static
     */
    public function setLastExecution($lastExecution = null)
    {
        $this->lastExecution = $lastExecution;

        return $this;
    }

    /**
     * @return \DateTime | null
     */
    public function getLastExecution()
    {
        return $this->lastExecution;
    }

    /**
     * @param string $lastExecutionError
     *
     * @return static
     */
    public function setLastExecutionError($lastExecutionError = null)
    {
        $this->lastExecutionError = $lastExecutionError;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getLastExecutionError()
    {
        return $this->lastExecutionError;
    }

    /**
     * @param \DateTime $nextExecution
     *
     * @return static
     */
    public function setNextExecution($nextExecution = null)
    {
        $this->nextExecution = $nextExecution;

        return $this;
    }

    /**
     * @return \DateTime | null
     */
    public function getNextExecution()
    {
        return $this->nextExecution;
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
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandDto $brand
     *
     * @return static
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandDto $brand = null)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandDto | null
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setBrandId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Brand\BrandDto($id)
            : null;

        return $this->setBrand($value);
    }

    /**
     * @return mixed | null
     */
    public function getBrandId()
    {
        if ($dto = $this->getBrand()) {
            return $dto->getId();
        }

        return null;
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
     * @param \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateDto $callCsvNotificationTemplate
     *
     * @return static
     */
    public function setCallCsvNotificationTemplate(\Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateDto $callCsvNotificationTemplate = null)
    {
        $this->callCsvNotificationTemplate = $callCsvNotificationTemplate;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateDto | null
     */
    public function getCallCsvNotificationTemplate()
    {
        return $this->callCsvNotificationTemplate;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setCallCsvNotificationTemplateId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\NotificationTemplate\NotificationTemplateDto($id)
            : null;

        return $this->setCallCsvNotificationTemplate($value);
    }

    /**
     * @return mixed | null
     */
    public function getCallCsvNotificationTemplateId()
    {
        if ($dto = $this->getCallCsvNotificationTemplate()) {
            return $dto->getId();
        }

        return null;
    }
}
