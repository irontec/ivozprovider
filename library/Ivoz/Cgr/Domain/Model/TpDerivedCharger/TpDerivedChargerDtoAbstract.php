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
     * @var string | null
     */
    private $subject = '*any';

    /**
     * @var string | null
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
     * @var \DateTimeInterface
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
    public static function getPropertyMap(string $context = '', string $role = null)
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
    * @return array
    */
    public function toArray($hideSensitiveData = false)
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
     * @param string $direction | null
     *
     * @return static
     */
    public function setDirection(?string $direction = null): self
    {
        $this->direction = $direction;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDirection(): ?string
    {
        return $this->direction;
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
     * @param string $category | null
     *
     * @return static
     */
    public function setCategory(?string $category = null): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getCategory(): ?string
    {
        return $this->category;
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
     * @param string $subject | null
     *
     * @return static
     */
    public function setSubject(?string $subject = null): self
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getSubject(): ?string
    {
        return $this->subject;
    }

    /**
     * @param string $destinationIds | null
     *
     * @return static
     */
    public function setDestinationIds(?string $destinationIds = null): self
    {
        $this->destinationIds = $destinationIds;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDestinationIds(): ?string
    {
        return $this->destinationIds;
    }

    /**
     * @param string $runid | null
     *
     * @return static
     */
    public function setRunid(?string $runid = null): self
    {
        $this->runid = $runid;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getRunid(): ?string
    {
        return $this->runid;
    }

    /**
     * @param string $runFilters | null
     *
     * @return static
     */
    public function setRunFilters(?string $runFilters = null): self
    {
        $this->runFilters = $runFilters;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getRunFilters(): ?string
    {
        return $this->runFilters;
    }

    /**
     * @param string $reqTypeField | null
     *
     * @return static
     */
    public function setReqTypeField(?string $reqTypeField = null): self
    {
        $this->reqTypeField = $reqTypeField;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getReqTypeField(): ?string
    {
        return $this->reqTypeField;
    }

    /**
     * @param string $directionField | null
     *
     * @return static
     */
    public function setDirectionField(?string $directionField = null): self
    {
        $this->directionField = $directionField;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDirectionField(): ?string
    {
        return $this->directionField;
    }

    /**
     * @param string $tenantField | null
     *
     * @return static
     */
    public function setTenantField(?string $tenantField = null): self
    {
        $this->tenantField = $tenantField;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getTenantField(): ?string
    {
        return $this->tenantField;
    }

    /**
     * @param string $categoryField | null
     *
     * @return static
     */
    public function setCategoryField(?string $categoryField = null): self
    {
        $this->categoryField = $categoryField;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getCategoryField(): ?string
    {
        return $this->categoryField;
    }

    /**
     * @param string $accountField | null
     *
     * @return static
     */
    public function setAccountField(?string $accountField = null): self
    {
        $this->accountField = $accountField;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getAccountField(): ?string
    {
        return $this->accountField;
    }

    /**
     * @param string $subjectField | null
     *
     * @return static
     */
    public function setSubjectField(?string $subjectField = null): self
    {
        $this->subjectField = $subjectField;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getSubjectField(): ?string
    {
        return $this->subjectField;
    }

    /**
     * @param string $destinationField | null
     *
     * @return static
     */
    public function setDestinationField(?string $destinationField = null): self
    {
        $this->destinationField = $destinationField;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDestinationField(): ?string
    {
        return $this->destinationField;
    }

    /**
     * @param string $setupTimeField | null
     *
     * @return static
     */
    public function setSetupTimeField(?string $setupTimeField = null): self
    {
        $this->setupTimeField = $setupTimeField;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getSetupTimeField(): ?string
    {
        return $this->setupTimeField;
    }

    /**
     * @param string $pddField | null
     *
     * @return static
     */
    public function setPddField(?string $pddField = null): self
    {
        $this->pddField = $pddField;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getPddField(): ?string
    {
        return $this->pddField;
    }

    /**
     * @param string $answerTimeField | null
     *
     * @return static
     */
    public function setAnswerTimeField(?string $answerTimeField = null): self
    {
        $this->answerTimeField = $answerTimeField;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getAnswerTimeField(): ?string
    {
        return $this->answerTimeField;
    }

    /**
     * @param string $usageField | null
     *
     * @return static
     */
    public function setUsageField(?string $usageField = null): self
    {
        $this->usageField = $usageField;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getUsageField(): ?string
    {
        return $this->usageField;
    }

    /**
     * @param string $supplierField | null
     *
     * @return static
     */
    public function setSupplierField(?string $supplierField = null): self
    {
        $this->supplierField = $supplierField;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getSupplierField(): ?string
    {
        return $this->supplierField;
    }

    /**
     * @param string $disconnectCauseField | null
     *
     * @return static
     */
    public function setDisconnectCauseField(?string $disconnectCauseField = null): self
    {
        $this->disconnectCauseField = $disconnectCauseField;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDisconnectCauseField(): ?string
    {
        return $this->disconnectCauseField;
    }

    /**
     * @param string $ratedTimeField | null
     *
     * @return static
     */
    public function setRatedTimeField(?string $ratedTimeField = null): self
    {
        $this->ratedTimeField = $ratedTimeField;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getRatedTimeField(): ?string
    {
        return $this->ratedTimeField;
    }

    /**
     * @param string $costField | null
     *
     * @return static
     */
    public function setCostField(?string $costField = null): self
    {
        $this->costField = $costField;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getCostField(): ?string
    {
        return $this->costField;
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
     * @param BrandDto | null
     *
     * @return static
     */
    public function setBrand(?BrandDto $brand = null): self
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * @return BrandDto | null
     */
    public function getBrand(): ?BrandDto
    {
        return $this->brand;
    }

    /**
     * @return static
     */
    public function setBrandId($id): self
    {
        $value = !is_null($id)
            ? new BrandDto($id)
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

}
