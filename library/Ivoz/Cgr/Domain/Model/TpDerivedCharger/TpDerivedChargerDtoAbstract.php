<?php

namespace Ivoz\Cgr\Domain\Model\TpDerivedCharger;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Brand\BrandDto;

/**
* TpDerivedChargerDtoAbstract
* @codeCoverageIgnore
*/
abstract class TpDerivedChargerDtoAbstract implements DataTransferObjectInterface
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
    private $direction = '*out';

    /**
     * @var string
     */
    private $tenant;

    /**
     * @var string
     */
    private $category = 'call';

    /**
     * @var string
     */
    private $account = '*any';

    /**
     * @var string|null
     */
    private $subject = '*any';

    /**
     * @var string|null
     */
    private $destinationIds = '*any';

    /**
     * @var string
     */
    private $runid = 'carrier';

    /**
     * @var string
     */
    private $runFilters = '';

    /**
     * @var string
     */
    private $reqTypeField = '^*postpaid';

    /**
     * @var string
     */
    private $directionField = '*default';

    /**
     * @var string
     */
    private $tenantField = '*default';

    /**
     * @var string
     */
    private $categoryField = '*default';

    /**
     * @var string
     */
    private $accountField = 'carrierId';

    /**
     * @var string
     */
    private $subjectField = 'carrierId';

    /**
     * @var string
     */
    private $destinationField = '*default';

    /**
     * @var string
     */
    private $setupTimeField = '*default';

    /**
     * @var string
     */
    private $pddField = '*default';

    /**
     * @var string
     */
    private $answerTimeField = '*default';

    /**
     * @var string
     */
    private $usageField = '*default';

    /**
     * @var string
     */
    private $supplierField = '*default';

    /**
     * @var string
     */
    private $disconnectCauseField = '*default';

    /**
     * @var string
     */
    private $ratedTimeField = '*default';

    /**
     * @var string
     */
    private $costField = '*default';

    /**
     * @var \DateTimeInterface|string
     */
    private $createdAt = 'CURRENT_TIMESTAMP';

    /**
     * @var int
     */
    private $id;

    /**
     * @var BrandDto | null
     */
    private $brand;

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
            'direction' => 'direction',
            'tenant' => 'tenant',
            'category' => 'category',
            'account' => 'account',
            'subject' => 'subject',
            'destinationIds' => 'destinationIds',
            'runid' => 'runid',
            'runFilters' => 'runFilters',
            'reqTypeField' => 'reqTypeField',
            'directionField' => 'directionField',
            'tenantField' => 'tenantField',
            'categoryField' => 'categoryField',
            'accountField' => 'accountField',
            'subjectField' => 'subjectField',
            'destinationField' => 'destinationField',
            'setupTimeField' => 'setupTimeField',
            'pddField' => 'pddField',
            'answerTimeField' => 'answerTimeField',
            'usageField' => 'usageField',
            'supplierField' => 'supplierField',
            'disconnectCauseField' => 'disconnectCauseField',
            'ratedTimeField' => 'ratedTimeField',
            'costField' => 'costField',
            'createdAt' => 'createdAt',
            'id' => 'id',
            'brandId' => 'brand'
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
            'direction' => $this->getDirection(),
            'tenant' => $this->getTenant(),
            'category' => $this->getCategory(),
            'account' => $this->getAccount(),
            'subject' => $this->getSubject(),
            'destinationIds' => $this->getDestinationIds(),
            'runid' => $this->getRunid(),
            'runFilters' => $this->getRunFilters(),
            'reqTypeField' => $this->getReqTypeField(),
            'directionField' => $this->getDirectionField(),
            'tenantField' => $this->getTenantField(),
            'categoryField' => $this->getCategoryField(),
            'accountField' => $this->getAccountField(),
            'subjectField' => $this->getSubjectField(),
            'destinationField' => $this->getDestinationField(),
            'setupTimeField' => $this->getSetupTimeField(),
            'pddField' => $this->getPddField(),
            'answerTimeField' => $this->getAnswerTimeField(),
            'usageField' => $this->getUsageField(),
            'supplierField' => $this->getSupplierField(),
            'disconnectCauseField' => $this->getDisconnectCauseField(),
            'ratedTimeField' => $this->getRatedTimeField(),
            'costField' => $this->getCostField(),
            'createdAt' => $this->getCreatedAt(),
            'id' => $this->getId(),
            'brand' => $this->getBrand()
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

    public function setDirection(string $direction): static
    {
        $this->direction = $direction;

        return $this;
    }

    public function getDirection(): ?string
    {
        return $this->direction;
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

    public function setCategory(string $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
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

    public function setSubject(?string $subject): static
    {
        $this->subject = $subject;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setDestinationIds(?string $destinationIds): static
    {
        $this->destinationIds = $destinationIds;

        return $this;
    }

    public function getDestinationIds(): ?string
    {
        return $this->destinationIds;
    }

    public function setRunid(string $runid): static
    {
        $this->runid = $runid;

        return $this;
    }

    public function getRunid(): ?string
    {
        return $this->runid;
    }

    public function setRunFilters(string $runFilters): static
    {
        $this->runFilters = $runFilters;

        return $this;
    }

    public function getRunFilters(): ?string
    {
        return $this->runFilters;
    }

    public function setReqTypeField(string $reqTypeField): static
    {
        $this->reqTypeField = $reqTypeField;

        return $this;
    }

    public function getReqTypeField(): ?string
    {
        return $this->reqTypeField;
    }

    public function setDirectionField(string $directionField): static
    {
        $this->directionField = $directionField;

        return $this;
    }

    public function getDirectionField(): ?string
    {
        return $this->directionField;
    }

    public function setTenantField(string $tenantField): static
    {
        $this->tenantField = $tenantField;

        return $this;
    }

    public function getTenantField(): ?string
    {
        return $this->tenantField;
    }

    public function setCategoryField(string $categoryField): static
    {
        $this->categoryField = $categoryField;

        return $this;
    }

    public function getCategoryField(): ?string
    {
        return $this->categoryField;
    }

    public function setAccountField(string $accountField): static
    {
        $this->accountField = $accountField;

        return $this;
    }

    public function getAccountField(): ?string
    {
        return $this->accountField;
    }

    public function setSubjectField(string $subjectField): static
    {
        $this->subjectField = $subjectField;

        return $this;
    }

    public function getSubjectField(): ?string
    {
        return $this->subjectField;
    }

    public function setDestinationField(string $destinationField): static
    {
        $this->destinationField = $destinationField;

        return $this;
    }

    public function getDestinationField(): ?string
    {
        return $this->destinationField;
    }

    public function setSetupTimeField(string $setupTimeField): static
    {
        $this->setupTimeField = $setupTimeField;

        return $this;
    }

    public function getSetupTimeField(): ?string
    {
        return $this->setupTimeField;
    }

    public function setPddField(string $pddField): static
    {
        $this->pddField = $pddField;

        return $this;
    }

    public function getPddField(): ?string
    {
        return $this->pddField;
    }

    public function setAnswerTimeField(string $answerTimeField): static
    {
        $this->answerTimeField = $answerTimeField;

        return $this;
    }

    public function getAnswerTimeField(): ?string
    {
        return $this->answerTimeField;
    }

    public function setUsageField(string $usageField): static
    {
        $this->usageField = $usageField;

        return $this;
    }

    public function getUsageField(): ?string
    {
        return $this->usageField;
    }

    public function setSupplierField(string $supplierField): static
    {
        $this->supplierField = $supplierField;

        return $this;
    }

    public function getSupplierField(): ?string
    {
        return $this->supplierField;
    }

    public function setDisconnectCauseField(string $disconnectCauseField): static
    {
        $this->disconnectCauseField = $disconnectCauseField;

        return $this;
    }

    public function getDisconnectCauseField(): ?string
    {
        return $this->disconnectCauseField;
    }

    public function setRatedTimeField(string $ratedTimeField): static
    {
        $this->ratedTimeField = $ratedTimeField;

        return $this;
    }

    public function getRatedTimeField(): ?string
    {
        return $this->ratedTimeField;
    }

    public function setCostField(string $costField): static
    {
        $this->costField = $costField;

        return $this;
    }

    public function getCostField(): ?string
    {
        return $this->costField;
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

    public function getId()
    {
        return $this->id;
    }

    public function setBrand(?BrandDto $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getBrand(): ?BrandDto
    {
        return $this->brand;
    }

    public function setBrandId($id): static
    {
        $value = !is_null($id)
            ? new BrandDto($id)
            : null;

        return $this->setBrand($value);
    }

    public function getBrandId()
    {
        if ($dto = $this->getBrand()) {
            return $dto->getId();
        }

        return null;
    }
}
