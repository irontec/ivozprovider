<?php

namespace Ivoz\Cgr\Domain\Model\TpAccountAction;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Company\CompanyDto;
use Ivoz\Provider\Domain\Model\Carrier\CarrierDto;

/**
* TpAccountActionDtoAbstract
* @codeCoverageIgnore
*/
abstract class TpAccountActionDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string
     */
    private $tpid = 'ivozprovider';

    /**
     * @var string
     */
    private $loadid = 'DATABASE';

    /**
     * @var string
     */
    private $tenant;

    /**
     * @var string
     */
    private $account;

    /**
     * @var string | null
     */
    private $actionPlanTag;

    /**
     * @var string | null
     */
    private $actionTriggersTag;

    /**
     * @var bool
     */
    private $allowNegative = false;

    /**
     * @var bool
     */
    private $disabled = false;

    /**
     * @var \DateTimeInterface
     */
    private $createdAt = 'CURRENT_TIMESTAMP';

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
            'tpid' => 'tpid',
            'loadid' => 'loadid',
            'tenant' => 'tenant',
            'account' => 'account',
            'actionPlanTag' => 'actionPlanTag',
            'actionTriggersTag' => 'actionTriggersTag',
            'allowNegative' => 'allowNegative',
            'disabled' => 'disabled',
            'createdAt' => 'createdAt',
            'id' => 'id',
            'companyId' => 'company',
            'carrierId' => 'carrier'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'tpid' => $this->getTpid(),
            'loadid' => $this->getLoadid(),
            'tenant' => $this->getTenant(),
            'account' => $this->getAccount(),
            'actionPlanTag' => $this->getActionPlanTag(),
            'actionTriggersTag' => $this->getActionTriggersTag(),
            'allowNegative' => $this->getAllowNegative(),
            'disabled' => $this->getDisabled(),
            'createdAt' => $this->getCreatedAt(),
            'id' => $this->getId(),
            'company' => $this->getCompany(),
            'carrier' => $this->getCarrier()
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
     * @param string $tpid | null
     *
     * @return static
     */
    public function setTpid(?string $tpid = null): self
    {
        $this->tpid = $tpid;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getTpid(): ?string
    {
        return $this->tpid;
    }

    /**
     * @param string $loadid | null
     *
     * @return static
     */
    public function setLoadid(?string $loadid = null): self
    {
        $this->loadid = $loadid;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getLoadid(): ?string
    {
        return $this->loadid;
    }

    /**
     * @param string $tenant | null
     *
     * @return static
     */
    public function setTenant(?string $tenant = null): self
    {
        $this->tenant = $tenant;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getTenant(): ?string
    {
        return $this->tenant;
    }

    /**
     * @param string $account | null
     *
     * @return static
     */
    public function setAccount(?string $account = null): self
    {
        $this->account = $account;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getAccount(): ?string
    {
        return $this->account;
    }

    /**
     * @param string $actionPlanTag | null
     *
     * @return static
     */
    public function setActionPlanTag(?string $actionPlanTag = null): self
    {
        $this->actionPlanTag = $actionPlanTag;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getActionPlanTag(): ?string
    {
        return $this->actionPlanTag;
    }

    /**
     * @param string $actionTriggersTag | null
     *
     * @return static
     */
    public function setActionTriggersTag(?string $actionTriggersTag = null): self
    {
        $this->actionTriggersTag = $actionTriggersTag;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getActionTriggersTag(): ?string
    {
        return $this->actionTriggersTag;
    }

    /**
     * @param bool $allowNegative | null
     *
     * @return static
     */
    public function setAllowNegative(?bool $allowNegative = null): self
    {
        $this->allowNegative = $allowNegative;

        return $this;
    }

    /**
     * @return bool | null
     */
    public function getAllowNegative(): ?bool
    {
        return $this->allowNegative;
    }

    /**
     * @param bool $disabled | null
     *
     * @return static
     */
    public function setDisabled(?bool $disabled = null): self
    {
        $this->disabled = $disabled;

        return $this;
    }

    /**
     * @return bool | null
     */
    public function getDisabled(): ?bool
    {
        return $this->disabled;
    }

    /**
     * @param \DateTimeInterface $createdAt | null
     *
     * @return static
     */
    public function setCreatedAt($createdAt = null): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return \DateTimeInterface | null
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
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

    /**
     * @param CarrierDto | null
     *
     * @return static
     */
    public function setCarrier(?CarrierDto $carrier = null): self
    {
        $this->carrier = $carrier;

        return $this;
    }

    /**
     * @return CarrierDto | null
     */
    public function getCarrier(): ?CarrierDto
    {
        return $this->carrier;
    }

    /**
     * @return static
     */
    public function setCarrierId($id): self
    {
        $value = !is_null($id)
            ? new CarrierDto($id)
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

}
