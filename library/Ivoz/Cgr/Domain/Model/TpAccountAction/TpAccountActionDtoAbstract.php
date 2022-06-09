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
     * @var string|null
     */
    private $tpid = 'ivozprovider';

    /**
     * @var string|null
     */
    private $loadid = 'DATABASE';

    /**
     * @var string|null
     */
    private $tenant = null;

    /**
     * @var string|null
     */
    private $account = null;

    /**
     * @var string|null
     */
    private $actionPlanTag = null;

    /**
     * @var string|null
     */
    private $actionTriggersTag = null;

    /**
     * @var bool|null
     */
    private $allowNegative = false;

    /**
     * @var bool|null
     */
    private $disabled = false;

    /**
     * @var \DateTimeInterface|string|null
     */
    private $createdAt = 'CURRENT_TIMESTAMP';

    /**
     * @var int|null
     */
    private $id = null;

    /**
     * @var CompanyDto | null
     */
    private $company = null;

    /**
     * @var CarrierDto | null
     */
    private $carrier = null;

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
     * @return array<string, mixed>
     */
    public function toArray(bool $hideSensitiveData = false): array
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

    public function setTpid(string $tpid): static
    {
        $this->tpid = $tpid;

        return $this;
    }

    public function getTpid(): ?string
    {
        return $this->tpid;
    }

    public function setLoadid(string $loadid): static
    {
        $this->loadid = $loadid;

        return $this;
    }

    public function getLoadid(): ?string
    {
        return $this->loadid;
    }

    public function setTenant(string $tenant): static
    {
        $this->tenant = $tenant;

        return $this;
    }

    public function getTenant(): ?string
    {
        return $this->tenant;
    }

    public function setAccount(string $account): static
    {
        $this->account = $account;

        return $this;
    }

    public function getAccount(): ?string
    {
        return $this->account;
    }

    public function setActionPlanTag(?string $actionPlanTag): static
    {
        $this->actionPlanTag = $actionPlanTag;

        return $this;
    }

    public function getActionPlanTag(): ?string
    {
        return $this->actionPlanTag;
    }

    public function setActionTriggersTag(?string $actionTriggersTag): static
    {
        $this->actionTriggersTag = $actionTriggersTag;

        return $this;
    }

    public function getActionTriggersTag(): ?string
    {
        return $this->actionTriggersTag;
    }

    public function setAllowNegative(bool $allowNegative): static
    {
        $this->allowNegative = $allowNegative;

        return $this;
    }

    public function getAllowNegative(): ?bool
    {
        return $this->allowNegative;
    }

    public function setDisabled(bool $disabled): static
    {
        $this->disabled = $disabled;

        return $this;
    }

    public function getDisabled(): ?bool
    {
        return $this->disabled;
    }

    public function setCreatedAt(\DateTimeInterface|string $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCreatedAt(): \DateTimeInterface|string|null
    {
        return $this->createdAt;
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
}
