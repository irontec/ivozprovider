<?php
declare(strict_types = 1);

namespace Ivoz\Cgr\Domain\Model\TpDerivedCharger;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Domain\Model\Helper\DateTimeHelper;
use Ivoz\Provider\Domain\Model\Brand\Brand;

/**
* TpDerivedChargerAbstract
* @codeCoverageIgnore
*/
abstract class TpDerivedChargerAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     */
    protected $tpid = 'ivozprovider';

    /**
     * @var string
     */
    protected $loadid = 'DATABASE';

    /**
     * @var string
     */
    protected $direction = '*out';

    /**
     * @var string
     */
    protected $tenant;

    /**
     * @var string
     */
    protected $category = 'call';

    /**
     * @var string
     */
    protected $account = '*any';

    /**
     * @var string | null
     */
    protected $subject = '*any';

    /**
     * column: destination_ids
     * @var string | null
     */
    protected $destinationIds = '*any';

    /**
     * @var string
     */
    protected $runid = 'carrier';

    /**
     * column: run_filters
     * @var string
     */
    protected $runFilters = '';

    /**
     * column: req_type_field
     * @var string
     */
    protected $reqTypeField = '^*postpaid';

    /**
     * column: direction_field
     * @var string
     */
    protected $directionField = '*default';

    /**
     * column: tenant_field
     * @var string
     */
    protected $tenantField = '*default';

    /**
     * column: category_field
     * @var string
     */
    protected $categoryField = '*default';

    /**
     * column: account_field
     * @var string
     */
    protected $accountField = 'carrierId';

    /**
     * column: subject_field
     * @var string
     */
    protected $subjectField = 'carrierId';

    /**
     * column: destination_field
     * @var string
     */
    protected $destinationField = '*default';

    /**
     * column: setup_time_field
     * @var string
     */
    protected $setupTimeField = '*default';

    /**
     * column: pdd_field
     * @var string
     */
    protected $pddField = '*default';

    /**
     * column: answer_time_field
     * @var string
     */
    protected $answerTimeField = '*default';

    /**
     * column: usage_field
     * @var string
     */
    protected $usageField = '*default';

    /**
     * column: supplier_field
     * @var string
     */
    protected $supplierField = '*default';

    /**
     * column: disconnect_cause_field
     * @var string
     */
    protected $disconnectCauseField = '*default';

    /**
     * column: rated_field
     * @var string
     */
    protected $ratedTimeField = '*default';

    /**
     * column: cost_field
     * @var string
     */
    protected $costField = '*default';

    /**
     * column: created_at
     * @var \DateTimeInterface
     */
    protected $createdAt = 'CURRENT_TIMESTAMP';

    /**
     * @var Brand
     */
    protected $brand;

    /**
     * Constructor
     */
    protected function __construct(
        $tpid,
        $loadid,
        $direction,
        $tenant,
        $category,
        $account,
        $runid,
        $runFilters,
        $reqTypeField,
        $directionField,
        $tenantField,
        $categoryField,
        $accountField,
        $subjectField,
        $destinationField,
        $setupTimeField,
        $pddField,
        $answerTimeField,
        $usageField,
        $supplierField,
        $disconnectCauseField,
        $ratedTimeField,
        $costField,
        $createdAt
    ) {
        $this->setTpid($tpid);
        $this->setLoadid($loadid);
        $this->setDirection($direction);
        $this->setTenant($tenant);
        $this->setCategory($category);
        $this->setAccount($account);
        $this->setRunid($runid);
        $this->setRunFilters($runFilters);
        $this->setReqTypeField($reqTypeField);
        $this->setDirectionField($directionField);
        $this->setTenantField($tenantField);
        $this->setCategoryField($categoryField);
        $this->setAccountField($accountField);
        $this->setSubjectField($subjectField);
        $this->setDestinationField($destinationField);
        $this->setSetupTimeField($setupTimeField);
        $this->setPddField($pddField);
        $this->setAnswerTimeField($answerTimeField);
        $this->setUsageField($usageField);
        $this->setSupplierField($supplierField);
        $this->setDisconnectCauseField($disconnectCauseField);
        $this->setRatedTimeField($ratedTimeField);
        $this->setCostField($costField);
        $this->setCreatedAt($createdAt);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "TpDerivedCharger",
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
     * @return TpDerivedChargerDto
     */
    public static function createDto($id = null)
    {
        return new TpDerivedChargerDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param TpDerivedChargerInterface|null $entity
     * @param int $depth
     * @return TpDerivedChargerDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, TpDerivedChargerInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var TpDerivedChargerDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param TpDerivedChargerDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, TpDerivedChargerDto::class);

        $self = new static(
            $dto->getTpid(),
            $dto->getLoadid(),
            $dto->getDirection(),
            $dto->getTenant(),
            $dto->getCategory(),
            $dto->getAccount(),
            $dto->getRunid(),
            $dto->getRunFilters(),
            $dto->getReqTypeField(),
            $dto->getDirectionField(),
            $dto->getTenantField(),
            $dto->getCategoryField(),
            $dto->getAccountField(),
            $dto->getSubjectField(),
            $dto->getDestinationField(),
            $dto->getSetupTimeField(),
            $dto->getPddField(),
            $dto->getAnswerTimeField(),
            $dto->getUsageField(),
            $dto->getSupplierField(),
            $dto->getDisconnectCauseField(),
            $dto->getRatedTimeField(),
            $dto->getCostField(),
            $dto->getCreatedAt()
        );

        $self
            ->setSubject($dto->getSubject())
            ->setDestinationIds($dto->getDestinationIds())
            ->setBrand($fkTransformer->transform($dto->getBrand()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param TpDerivedChargerDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, TpDerivedChargerDto::class);

        $this
            ->setTpid($dto->getTpid())
            ->setLoadid($dto->getLoadid())
            ->setDirection($dto->getDirection())
            ->setTenant($dto->getTenant())
            ->setCategory($dto->getCategory())
            ->setAccount($dto->getAccount())
            ->setSubject($dto->getSubject())
            ->setDestinationIds($dto->getDestinationIds())
            ->setRunid($dto->getRunid())
            ->setRunFilters($dto->getRunFilters())
            ->setReqTypeField($dto->getReqTypeField())
            ->setDirectionField($dto->getDirectionField())
            ->setTenantField($dto->getTenantField())
            ->setCategoryField($dto->getCategoryField())
            ->setAccountField($dto->getAccountField())
            ->setSubjectField($dto->getSubjectField())
            ->setDestinationField($dto->getDestinationField())
            ->setSetupTimeField($dto->getSetupTimeField())
            ->setPddField($dto->getPddField())
            ->setAnswerTimeField($dto->getAnswerTimeField())
            ->setUsageField($dto->getUsageField())
            ->setSupplierField($dto->getSupplierField())
            ->setDisconnectCauseField($dto->getDisconnectCauseField())
            ->setRatedTimeField($dto->getRatedTimeField())
            ->setCostField($dto->getCostField())
            ->setCreatedAt($dto->getCreatedAt())
            ->setBrand($fkTransformer->transform($dto->getBrand()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return TpDerivedChargerDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setTpid(self::getTpid())
            ->setLoadid(self::getLoadid())
            ->setDirection(self::getDirection())
            ->setTenant(self::getTenant())
            ->setCategory(self::getCategory())
            ->setAccount(self::getAccount())
            ->setSubject(self::getSubject())
            ->setDestinationIds(self::getDestinationIds())
            ->setRunid(self::getRunid())
            ->setRunFilters(self::getRunFilters())
            ->setReqTypeField(self::getReqTypeField())
            ->setDirectionField(self::getDirectionField())
            ->setTenantField(self::getTenantField())
            ->setCategoryField(self::getCategoryField())
            ->setAccountField(self::getAccountField())
            ->setSubjectField(self::getSubjectField())
            ->setDestinationField(self::getDestinationField())
            ->setSetupTimeField(self::getSetupTimeField())
            ->setPddField(self::getPddField())
            ->setAnswerTimeField(self::getAnswerTimeField())
            ->setUsageField(self::getUsageField())
            ->setSupplierField(self::getSupplierField())
            ->setDisconnectCauseField(self::getDisconnectCauseField())
            ->setRatedTimeField(self::getRatedTimeField())
            ->setCostField(self::getCostField())
            ->setCreatedAt(self::getCreatedAt())
            ->setBrand(Brand::entityToDto(self::getBrand(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'tpid' => self::getTpid(),
            'loadid' => self::getLoadid(),
            'direction' => self::getDirection(),
            'tenant' => self::getTenant(),
            'category' => self::getCategory(),
            'account' => self::getAccount(),
            'subject' => self::getSubject(),
            'destination_ids' => self::getDestinationIds(),
            'runid' => self::getRunid(),
            'run_filters' => self::getRunFilters(),
            'req_type_field' => self::getReqTypeField(),
            'direction_field' => self::getDirectionField(),
            'tenant_field' => self::getTenantField(),
            'category_field' => self::getCategoryField(),
            'account_field' => self::getAccountField(),
            'subject_field' => self::getSubjectField(),
            'destination_field' => self::getDestinationField(),
            'setup_time_field' => self::getSetupTimeField(),
            'pdd_field' => self::getPddField(),
            'answer_time_field' => self::getAnswerTimeField(),
            'usage_field' => self::getUsageField(),
            'supplier_field' => self::getSupplierField(),
            'disconnect_cause_field' => self::getDisconnectCauseField(),
            'rated_field' => self::getRatedTimeField(),
            'cost_field' => self::getCostField(),
            'created_at' => self::getCreatedAt(),
            'brandId' => self::getBrand()->getId()
        ];
    }

    /**
     * Set tpid
     *
     * @param string $tpid
     *
     * @return static
     */
    protected function setTpid(string $tpid): TpDerivedChargerInterface
    {
        Assertion::maxLength($tpid, 64, 'tpid value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->tpid = $tpid;

        return $this;
    }

    /**
     * Get tpid
     *
     * @return string
     */
    public function getTpid(): string
    {
        return $this->tpid;
    }

    /**
     * Set loadid
     *
     * @param string $loadid
     *
     * @return static
     */
    protected function setLoadid(string $loadid): TpDerivedChargerInterface
    {
        Assertion::maxLength($loadid, 64, 'loadid value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->loadid = $loadid;

        return $this;
    }

    /**
     * Get loadid
     *
     * @return string
     */
    public function getLoadid(): string
    {
        return $this->loadid;
    }

    /**
     * Set direction
     *
     * @param string $direction
     *
     * @return static
     */
    protected function setDirection(string $direction): TpDerivedChargerInterface
    {
        Assertion::maxLength($direction, 8, 'direction value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->direction = $direction;

        return $this;
    }

    /**
     * Get direction
     *
     * @return string
     */
    public function getDirection(): string
    {
        return $this->direction;
    }

    /**
     * Set tenant
     *
     * @param string $tenant
     *
     * @return static
     */
    protected function setTenant(string $tenant): TpDerivedChargerInterface
    {
        Assertion::maxLength($tenant, 64, 'tenant value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->tenant = $tenant;

        return $this;
    }

    /**
     * Get tenant
     *
     * @return string
     */
    public function getTenant(): string
    {
        return $this->tenant;
    }

    /**
     * Set category
     *
     * @param string $category
     *
     * @return static
     */
    protected function setCategory(string $category): TpDerivedChargerInterface
    {
        Assertion::maxLength($category, 32, 'category value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * Set account
     *
     * @param string $account
     *
     * @return static
     */
    protected function setAccount(string $account): TpDerivedChargerInterface
    {
        Assertion::maxLength($account, 64, 'account value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->account = $account;

        return $this;
    }

    /**
     * Get account
     *
     * @return string
     */
    public function getAccount(): string
    {
        return $this->account;
    }

    /**
     * Set subject
     *
     * @param string $subject | null
     *
     * @return static
     */
    protected function setSubject(?string $subject = null): TpDerivedChargerInterface
    {
        if (!is_null($subject)) {
            Assertion::maxLength($subject, 64, 'subject value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string | null
     */
    public function getSubject(): ?string
    {
        return $this->subject;
    }

    /**
     * Set destinationIds
     *
     * @param string $destinationIds | null
     *
     * @return static
     */
    protected function setDestinationIds(?string $destinationIds = null): TpDerivedChargerInterface
    {
        if (!is_null($destinationIds)) {
            Assertion::maxLength($destinationIds, 64, 'destinationIds value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->destinationIds = $destinationIds;

        return $this;
    }

    /**
     * Get destinationIds
     *
     * @return string | null
     */
    public function getDestinationIds(): ?string
    {
        return $this->destinationIds;
    }

    /**
     * Set runid
     *
     * @param string $runid
     *
     * @return static
     */
    protected function setRunid(string $runid): TpDerivedChargerInterface
    {
        Assertion::maxLength($runid, 64, 'runid value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->runid = $runid;

        return $this;
    }

    /**
     * Get runid
     *
     * @return string
     */
    public function getRunid(): string
    {
        return $this->runid;
    }

    /**
     * Set runFilters
     *
     * @param string $runFilters
     *
     * @return static
     */
    protected function setRunFilters(string $runFilters): TpDerivedChargerInterface
    {
        Assertion::maxLength($runFilters, 32, 'runFilters value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->runFilters = $runFilters;

        return $this;
    }

    /**
     * Get runFilters
     *
     * @return string
     */
    public function getRunFilters(): string
    {
        return $this->runFilters;
    }

    /**
     * Set reqTypeField
     *
     * @param string $reqTypeField
     *
     * @return static
     */
    protected function setReqTypeField(string $reqTypeField): TpDerivedChargerInterface
    {
        Assertion::maxLength($reqTypeField, 64, 'reqTypeField value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->reqTypeField = $reqTypeField;

        return $this;
    }

    /**
     * Get reqTypeField
     *
     * @return string
     */
    public function getReqTypeField(): string
    {
        return $this->reqTypeField;
    }

    /**
     * Set directionField
     *
     * @param string $directionField
     *
     * @return static
     */
    protected function setDirectionField(string $directionField): TpDerivedChargerInterface
    {
        Assertion::maxLength($directionField, 64, 'directionField value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->directionField = $directionField;

        return $this;
    }

    /**
     * Get directionField
     *
     * @return string
     */
    public function getDirectionField(): string
    {
        return $this->directionField;
    }

    /**
     * Set tenantField
     *
     * @param string $tenantField
     *
     * @return static
     */
    protected function setTenantField(string $tenantField): TpDerivedChargerInterface
    {
        Assertion::maxLength($tenantField, 64, 'tenantField value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->tenantField = $tenantField;

        return $this;
    }

    /**
     * Get tenantField
     *
     * @return string
     */
    public function getTenantField(): string
    {
        return $this->tenantField;
    }

    /**
     * Set categoryField
     *
     * @param string $categoryField
     *
     * @return static
     */
    protected function setCategoryField(string $categoryField): TpDerivedChargerInterface
    {
        Assertion::maxLength($categoryField, 64, 'categoryField value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->categoryField = $categoryField;

        return $this;
    }

    /**
     * Get categoryField
     *
     * @return string
     */
    public function getCategoryField(): string
    {
        return $this->categoryField;
    }

    /**
     * Set accountField
     *
     * @param string $accountField
     *
     * @return static
     */
    protected function setAccountField(string $accountField): TpDerivedChargerInterface
    {
        Assertion::maxLength($accountField, 64, 'accountField value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->accountField = $accountField;

        return $this;
    }

    /**
     * Get accountField
     *
     * @return string
     */
    public function getAccountField(): string
    {
        return $this->accountField;
    }

    /**
     * Set subjectField
     *
     * @param string $subjectField
     *
     * @return static
     */
    protected function setSubjectField(string $subjectField): TpDerivedChargerInterface
    {
        Assertion::maxLength($subjectField, 64, 'subjectField value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->subjectField = $subjectField;

        return $this;
    }

    /**
     * Get subjectField
     *
     * @return string
     */
    public function getSubjectField(): string
    {
        return $this->subjectField;
    }

    /**
     * Set destinationField
     *
     * @param string $destinationField
     *
     * @return static
     */
    protected function setDestinationField(string $destinationField): TpDerivedChargerInterface
    {
        Assertion::maxLength($destinationField, 64, 'destinationField value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->destinationField = $destinationField;

        return $this;
    }

    /**
     * Get destinationField
     *
     * @return string
     */
    public function getDestinationField(): string
    {
        return $this->destinationField;
    }

    /**
     * Set setupTimeField
     *
     * @param string $setupTimeField
     *
     * @return static
     */
    protected function setSetupTimeField(string $setupTimeField): TpDerivedChargerInterface
    {
        Assertion::maxLength($setupTimeField, 64, 'setupTimeField value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->setupTimeField = $setupTimeField;

        return $this;
    }

    /**
     * Get setupTimeField
     *
     * @return string
     */
    public function getSetupTimeField(): string
    {
        return $this->setupTimeField;
    }

    /**
     * Set pddField
     *
     * @param string $pddField
     *
     * @return static
     */
    protected function setPddField(string $pddField): TpDerivedChargerInterface
    {
        Assertion::maxLength($pddField, 64, 'pddField value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->pddField = $pddField;

        return $this;
    }

    /**
     * Get pddField
     *
     * @return string
     */
    public function getPddField(): string
    {
        return $this->pddField;
    }

    /**
     * Set answerTimeField
     *
     * @param string $answerTimeField
     *
     * @return static
     */
    protected function setAnswerTimeField(string $answerTimeField): TpDerivedChargerInterface
    {
        Assertion::maxLength($answerTimeField, 64, 'answerTimeField value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->answerTimeField = $answerTimeField;

        return $this;
    }

    /**
     * Get answerTimeField
     *
     * @return string
     */
    public function getAnswerTimeField(): string
    {
        return $this->answerTimeField;
    }

    /**
     * Set usageField
     *
     * @param string $usageField
     *
     * @return static
     */
    protected function setUsageField(string $usageField): TpDerivedChargerInterface
    {
        Assertion::maxLength($usageField, 64, 'usageField value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->usageField = $usageField;

        return $this;
    }

    /**
     * Get usageField
     *
     * @return string
     */
    public function getUsageField(): string
    {
        return $this->usageField;
    }

    /**
     * Set supplierField
     *
     * @param string $supplierField
     *
     * @return static
     */
    protected function setSupplierField(string $supplierField): TpDerivedChargerInterface
    {
        Assertion::maxLength($supplierField, 64, 'supplierField value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->supplierField = $supplierField;

        return $this;
    }

    /**
     * Get supplierField
     *
     * @return string
     */
    public function getSupplierField(): string
    {
        return $this->supplierField;
    }

    /**
     * Set disconnectCauseField
     *
     * @param string $disconnectCauseField
     *
     * @return static
     */
    protected function setDisconnectCauseField(string $disconnectCauseField): TpDerivedChargerInterface
    {
        Assertion::maxLength($disconnectCauseField, 64, 'disconnectCauseField value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->disconnectCauseField = $disconnectCauseField;

        return $this;
    }

    /**
     * Get disconnectCauseField
     *
     * @return string
     */
    public function getDisconnectCauseField(): string
    {
        return $this->disconnectCauseField;
    }

    /**
     * Set ratedTimeField
     *
     * @param string $ratedTimeField
     *
     * @return static
     */
    protected function setRatedTimeField(string $ratedTimeField): TpDerivedChargerInterface
    {
        Assertion::maxLength($ratedTimeField, 64, 'ratedTimeField value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->ratedTimeField = $ratedTimeField;

        return $this;
    }

    /**
     * Get ratedTimeField
     *
     * @return string
     */
    public function getRatedTimeField(): string
    {
        return $this->ratedTimeField;
    }

    /**
     * Set costField
     *
     * @param string $costField
     *
     * @return static
     */
    protected function setCostField(string $costField): TpDerivedChargerInterface
    {
        Assertion::maxLength($costField, 64, 'costField value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->costField = $costField;

        return $this;
    }

    /**
     * Get costField
     *
     * @return string
     */
    public function getCostField(): string
    {
        return $this->costField;
    }

    /**
     * Set createdAt
     *
     * @param \DateTimeInterface $createdAt
     *
     * @return static
     */
    protected function setCreatedAt($createdAt): TpDerivedChargerInterface
    {

        $createdAt = DateTimeHelper::createOrFix(
            $createdAt,
            'CURRENT_TIMESTAMP'
        );

        if ($this->createdAt == $createdAt) {
            return $this;
        }

        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTimeInterface
     */
    public function getCreatedAt(): \DateTimeInterface
    {
        return clone $this->createdAt;
    }

    /**
     * Set brand
     *
     * @param Brand
     *
     * @return static
     */
    protected function setBrand(Brand $brand): TpDerivedChargerInterface
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return Brand
     */
    public function getBrand(): Brand
    {
        return $this->brand;
    }

}
