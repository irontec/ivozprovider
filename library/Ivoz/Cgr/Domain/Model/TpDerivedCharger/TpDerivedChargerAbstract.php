<?php

declare(strict_types=1);

namespace Ivoz\Cgr\Domain\Model\TpDerivedCharger;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Domain\Model\Helper\DateTimeHelper;
use Ivoz\Provider\Domain\Model\Brand\BrandInterface;
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
     * @var ?string
     */
    protected $subject = '*any';

    /**
     * @var ?string
     * column: destination_ids
     */
    protected $destinationIds = '*any';

    /**
     * @var string
     */
    protected $runid = 'carrier';

    /**
     * @var string
     * column: run_filters
     */
    protected $runFilters = '';

    /**
     * @var string
     * column: req_type_field
     */
    protected $reqTypeField = '^*postpaid';

    /**
     * @var string
     * column: direction_field
     */
    protected $directionField = '*default';

    /**
     * @var string
     * column: tenant_field
     */
    protected $tenantField = '*default';

    /**
     * @var string
     * column: category_field
     */
    protected $categoryField = '*default';

    /**
     * @var string
     * column: account_field
     */
    protected $accountField = 'carrierId';

    /**
     * @var string
     * column: subject_field
     */
    protected $subjectField = 'carrierId';

    /**
     * @var string
     * column: destination_field
     */
    protected $destinationField = '*default';

    /**
     * @var string
     * column: setup_time_field
     */
    protected $setupTimeField = '*default';

    /**
     * @var string
     * column: pdd_field
     */
    protected $pddField = '*default';

    /**
     * @var string
     * column: answer_time_field
     */
    protected $answerTimeField = '*default';

    /**
     * @var string
     * column: usage_field
     */
    protected $usageField = '*default';

    /**
     * @var string
     * column: supplier_field
     */
    protected $supplierField = '*default';

    /**
     * @var string
     * column: disconnect_cause_field
     */
    protected $disconnectCauseField = '*default';

    /**
     * @var string
     * column: rated_field
     */
    protected $ratedTimeField = '*default';

    /**
     * @var string
     * column: cost_field
     */
    protected $costField = '*default';

    /**
     * @var \DateTime
     * column: created_at
     */
    protected $createdAt;

    /**
     * @var BrandInterface
     */
    protected $brand;

    /**
     * Constructor
     */
    protected function __construct(
        string $tpid,
        string $loadid,
        string $direction,
        string $tenant,
        string $category,
        string $account,
        string $runid,
        string $runFilters,
        string $reqTypeField,
        string $directionField,
        string $tenantField,
        string $categoryField,
        string $accountField,
        string $subjectField,
        string $destinationField,
        string $setupTimeField,
        string $pddField,
        string $answerTimeField,
        string $usageField,
        string $supplierField,
        string $disconnectCauseField,
        string $ratedTimeField,
        string $costField,
        \DateTimeInterface|string $createdAt
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

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "TpDerivedCharger",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): TpDerivedChargerDto
    {
        return new TpDerivedChargerDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|TpDerivedChargerInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?TpDerivedChargerDto
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

        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param TpDerivedChargerDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, TpDerivedChargerDto::class);
        $tpid = $dto->getTpid();
        Assertion::notNull($tpid, 'getTpid value is null, but non null value was expected.');
        $loadid = $dto->getLoadid();
        Assertion::notNull($loadid, 'getLoadid value is null, but non null value was expected.');
        $direction = $dto->getDirection();
        Assertion::notNull($direction, 'getDirection value is null, but non null value was expected.');
        $tenant = $dto->getTenant();
        Assertion::notNull($tenant, 'getTenant value is null, but non null value was expected.');
        $category = $dto->getCategory();
        Assertion::notNull($category, 'getCategory value is null, but non null value was expected.');
        $account = $dto->getAccount();
        Assertion::notNull($account, 'getAccount value is null, but non null value was expected.');
        $runid = $dto->getRunid();
        Assertion::notNull($runid, 'getRunid value is null, but non null value was expected.');
        $runFilters = $dto->getRunFilters();
        Assertion::notNull($runFilters, 'getRunFilters value is null, but non null value was expected.');
        $reqTypeField = $dto->getReqTypeField();
        Assertion::notNull($reqTypeField, 'getReqTypeField value is null, but non null value was expected.');
        $directionField = $dto->getDirectionField();
        Assertion::notNull($directionField, 'getDirectionField value is null, but non null value was expected.');
        $tenantField = $dto->getTenantField();
        Assertion::notNull($tenantField, 'getTenantField value is null, but non null value was expected.');
        $categoryField = $dto->getCategoryField();
        Assertion::notNull($categoryField, 'getCategoryField value is null, but non null value was expected.');
        $accountField = $dto->getAccountField();
        Assertion::notNull($accountField, 'getAccountField value is null, but non null value was expected.');
        $subjectField = $dto->getSubjectField();
        Assertion::notNull($subjectField, 'getSubjectField value is null, but non null value was expected.');
        $destinationField = $dto->getDestinationField();
        Assertion::notNull($destinationField, 'getDestinationField value is null, but non null value was expected.');
        $setupTimeField = $dto->getSetupTimeField();
        Assertion::notNull($setupTimeField, 'getSetupTimeField value is null, but non null value was expected.');
        $pddField = $dto->getPddField();
        Assertion::notNull($pddField, 'getPddField value is null, but non null value was expected.');
        $answerTimeField = $dto->getAnswerTimeField();
        Assertion::notNull($answerTimeField, 'getAnswerTimeField value is null, but non null value was expected.');
        $usageField = $dto->getUsageField();
        Assertion::notNull($usageField, 'getUsageField value is null, but non null value was expected.');
        $supplierField = $dto->getSupplierField();
        Assertion::notNull($supplierField, 'getSupplierField value is null, but non null value was expected.');
        $disconnectCauseField = $dto->getDisconnectCauseField();
        Assertion::notNull($disconnectCauseField, 'getDisconnectCauseField value is null, but non null value was expected.');
        $ratedTimeField = $dto->getRatedTimeField();
        Assertion::notNull($ratedTimeField, 'getRatedTimeField value is null, but non null value was expected.');
        $costField = $dto->getCostField();
        Assertion::notNull($costField, 'getCostField value is null, but non null value was expected.');
        $createdAt = $dto->getCreatedAt();
        Assertion::notNull($createdAt, 'getCreatedAt value is null, but non null value was expected.');
        $brand = $dto->getBrand();
        Assertion::notNull($brand, 'getBrand value is null, but non null value was expected.');

        $self = new static(
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
        );

        $self
            ->setSubject($dto->getSubject())
            ->setDestinationIds($dto->getDestinationIds())
            ->setBrand($fkTransformer->transform($brand));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param TpDerivedChargerDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, TpDerivedChargerDto::class);

        $tpid = $dto->getTpid();
        Assertion::notNull($tpid, 'getTpid value is null, but non null value was expected.');
        $loadid = $dto->getLoadid();
        Assertion::notNull($loadid, 'getLoadid value is null, but non null value was expected.');
        $direction = $dto->getDirection();
        Assertion::notNull($direction, 'getDirection value is null, but non null value was expected.');
        $tenant = $dto->getTenant();
        Assertion::notNull($tenant, 'getTenant value is null, but non null value was expected.');
        $category = $dto->getCategory();
        Assertion::notNull($category, 'getCategory value is null, but non null value was expected.');
        $account = $dto->getAccount();
        Assertion::notNull($account, 'getAccount value is null, but non null value was expected.');
        $runid = $dto->getRunid();
        Assertion::notNull($runid, 'getRunid value is null, but non null value was expected.');
        $runFilters = $dto->getRunFilters();
        Assertion::notNull($runFilters, 'getRunFilters value is null, but non null value was expected.');
        $reqTypeField = $dto->getReqTypeField();
        Assertion::notNull($reqTypeField, 'getReqTypeField value is null, but non null value was expected.');
        $directionField = $dto->getDirectionField();
        Assertion::notNull($directionField, 'getDirectionField value is null, but non null value was expected.');
        $tenantField = $dto->getTenantField();
        Assertion::notNull($tenantField, 'getTenantField value is null, but non null value was expected.');
        $categoryField = $dto->getCategoryField();
        Assertion::notNull($categoryField, 'getCategoryField value is null, but non null value was expected.');
        $accountField = $dto->getAccountField();
        Assertion::notNull($accountField, 'getAccountField value is null, but non null value was expected.');
        $subjectField = $dto->getSubjectField();
        Assertion::notNull($subjectField, 'getSubjectField value is null, but non null value was expected.');
        $destinationField = $dto->getDestinationField();
        Assertion::notNull($destinationField, 'getDestinationField value is null, but non null value was expected.');
        $setupTimeField = $dto->getSetupTimeField();
        Assertion::notNull($setupTimeField, 'getSetupTimeField value is null, but non null value was expected.');
        $pddField = $dto->getPddField();
        Assertion::notNull($pddField, 'getPddField value is null, but non null value was expected.');
        $answerTimeField = $dto->getAnswerTimeField();
        Assertion::notNull($answerTimeField, 'getAnswerTimeField value is null, but non null value was expected.');
        $usageField = $dto->getUsageField();
        Assertion::notNull($usageField, 'getUsageField value is null, but non null value was expected.');
        $supplierField = $dto->getSupplierField();
        Assertion::notNull($supplierField, 'getSupplierField value is null, but non null value was expected.');
        $disconnectCauseField = $dto->getDisconnectCauseField();
        Assertion::notNull($disconnectCauseField, 'getDisconnectCauseField value is null, but non null value was expected.');
        $ratedTimeField = $dto->getRatedTimeField();
        Assertion::notNull($ratedTimeField, 'getRatedTimeField value is null, but non null value was expected.');
        $costField = $dto->getCostField();
        Assertion::notNull($costField, 'getCostField value is null, but non null value was expected.');
        $createdAt = $dto->getCreatedAt();
        Assertion::notNull($createdAt, 'getCreatedAt value is null, but non null value was expected.');
        $brand = $dto->getBrand();
        Assertion::notNull($brand, 'getBrand value is null, but non null value was expected.');

        $this
            ->setTpid($tpid)
            ->setLoadid($loadid)
            ->setDirection($direction)
            ->setTenant($tenant)
            ->setCategory($category)
            ->setAccount($account)
            ->setSubject($dto->getSubject())
            ->setDestinationIds($dto->getDestinationIds())
            ->setRunid($runid)
            ->setRunFilters($runFilters)
            ->setReqTypeField($reqTypeField)
            ->setDirectionField($directionField)
            ->setTenantField($tenantField)
            ->setCategoryField($categoryField)
            ->setAccountField($accountField)
            ->setSubjectField($subjectField)
            ->setDestinationField($destinationField)
            ->setSetupTimeField($setupTimeField)
            ->setPddField($pddField)
            ->setAnswerTimeField($answerTimeField)
            ->setUsageField($usageField)
            ->setSupplierField($supplierField)
            ->setDisconnectCauseField($disconnectCauseField)
            ->setRatedTimeField($ratedTimeField)
            ->setCostField($costField)
            ->setCreatedAt($createdAt)
            ->setBrand($fkTransformer->transform($brand));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): TpDerivedChargerDto
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
     * @return array<string, mixed>
     */
    protected function __toArray(): array
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

    protected function setTpid(string $tpid): static
    {
        Assertion::maxLength($tpid, 64, 'tpid value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->tpid = $tpid;

        return $this;
    }

    public function getTpid(): string
    {
        return $this->tpid;
    }

    protected function setLoadid(string $loadid): static
    {
        Assertion::maxLength($loadid, 64, 'loadid value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->loadid = $loadid;

        return $this;
    }

    public function getLoadid(): string
    {
        return $this->loadid;
    }

    protected function setDirection(string $direction): static
    {
        Assertion::maxLength($direction, 8, 'direction value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->direction = $direction;

        return $this;
    }

    public function getDirection(): string
    {
        return $this->direction;
    }

    protected function setTenant(string $tenant): static
    {
        Assertion::maxLength($tenant, 64, 'tenant value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->tenant = $tenant;

        return $this;
    }

    public function getTenant(): string
    {
        return $this->tenant;
    }

    protected function setCategory(string $category): static
    {
        Assertion::maxLength($category, 32, 'category value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->category = $category;

        return $this;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

    protected function setAccount(string $account): static
    {
        Assertion::maxLength($account, 64, 'account value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->account = $account;

        return $this;
    }

    public function getAccount(): string
    {
        return $this->account;
    }

    protected function setSubject(?string $subject = null): static
    {
        if (!is_null($subject)) {
            Assertion::maxLength($subject, 64, 'subject value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->subject = $subject;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    protected function setDestinationIds(?string $destinationIds = null): static
    {
        if (!is_null($destinationIds)) {
            Assertion::maxLength($destinationIds, 64, 'destinationIds value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->destinationIds = $destinationIds;

        return $this;
    }

    public function getDestinationIds(): ?string
    {
        return $this->destinationIds;
    }

    protected function setRunid(string $runid): static
    {
        Assertion::maxLength($runid, 64, 'runid value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->runid = $runid;

        return $this;
    }

    public function getRunid(): string
    {
        return $this->runid;
    }

    protected function setRunFilters(string $runFilters): static
    {
        Assertion::maxLength($runFilters, 32, 'runFilters value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->runFilters = $runFilters;

        return $this;
    }

    public function getRunFilters(): string
    {
        return $this->runFilters;
    }

    protected function setReqTypeField(string $reqTypeField): static
    {
        Assertion::maxLength($reqTypeField, 64, 'reqTypeField value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->reqTypeField = $reqTypeField;

        return $this;
    }

    public function getReqTypeField(): string
    {
        return $this->reqTypeField;
    }

    protected function setDirectionField(string $directionField): static
    {
        Assertion::maxLength($directionField, 64, 'directionField value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->directionField = $directionField;

        return $this;
    }

    public function getDirectionField(): string
    {
        return $this->directionField;
    }

    protected function setTenantField(string $tenantField): static
    {
        Assertion::maxLength($tenantField, 64, 'tenantField value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->tenantField = $tenantField;

        return $this;
    }

    public function getTenantField(): string
    {
        return $this->tenantField;
    }

    protected function setCategoryField(string $categoryField): static
    {
        Assertion::maxLength($categoryField, 64, 'categoryField value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->categoryField = $categoryField;

        return $this;
    }

    public function getCategoryField(): string
    {
        return $this->categoryField;
    }

    protected function setAccountField(string $accountField): static
    {
        Assertion::maxLength($accountField, 64, 'accountField value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->accountField = $accountField;

        return $this;
    }

    public function getAccountField(): string
    {
        return $this->accountField;
    }

    protected function setSubjectField(string $subjectField): static
    {
        Assertion::maxLength($subjectField, 64, 'subjectField value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->subjectField = $subjectField;

        return $this;
    }

    public function getSubjectField(): string
    {
        return $this->subjectField;
    }

    protected function setDestinationField(string $destinationField): static
    {
        Assertion::maxLength($destinationField, 64, 'destinationField value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->destinationField = $destinationField;

        return $this;
    }

    public function getDestinationField(): string
    {
        return $this->destinationField;
    }

    protected function setSetupTimeField(string $setupTimeField): static
    {
        Assertion::maxLength($setupTimeField, 64, 'setupTimeField value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->setupTimeField = $setupTimeField;

        return $this;
    }

    public function getSetupTimeField(): string
    {
        return $this->setupTimeField;
    }

    protected function setPddField(string $pddField): static
    {
        Assertion::maxLength($pddField, 64, 'pddField value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->pddField = $pddField;

        return $this;
    }

    public function getPddField(): string
    {
        return $this->pddField;
    }

    protected function setAnswerTimeField(string $answerTimeField): static
    {
        Assertion::maxLength($answerTimeField, 64, 'answerTimeField value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->answerTimeField = $answerTimeField;

        return $this;
    }

    public function getAnswerTimeField(): string
    {
        return $this->answerTimeField;
    }

    protected function setUsageField(string $usageField): static
    {
        Assertion::maxLength($usageField, 64, 'usageField value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->usageField = $usageField;

        return $this;
    }

    public function getUsageField(): string
    {
        return $this->usageField;
    }

    protected function setSupplierField(string $supplierField): static
    {
        Assertion::maxLength($supplierField, 64, 'supplierField value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->supplierField = $supplierField;

        return $this;
    }

    public function getSupplierField(): string
    {
        return $this->supplierField;
    }

    protected function setDisconnectCauseField(string $disconnectCauseField): static
    {
        Assertion::maxLength($disconnectCauseField, 64, 'disconnectCauseField value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->disconnectCauseField = $disconnectCauseField;

        return $this;
    }

    public function getDisconnectCauseField(): string
    {
        return $this->disconnectCauseField;
    }

    protected function setRatedTimeField(string $ratedTimeField): static
    {
        Assertion::maxLength($ratedTimeField, 64, 'ratedTimeField value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->ratedTimeField = $ratedTimeField;

        return $this;
    }

    public function getRatedTimeField(): string
    {
        return $this->ratedTimeField;
    }

    protected function setCostField(string $costField): static
    {
        Assertion::maxLength($costField, 64, 'costField value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->costField = $costField;

        return $this;
    }

    public function getCostField(): string
    {
        return $this->costField;
    }

    protected function setCreatedAt(string|\DateTimeInterface $createdAt): static
    {

        /** @var \DateTime */
        $createdAt = DateTimeHelper::createOrFix(
            $createdAt,
            'CURRENT_TIMESTAMP'
        );

        if ($this->isInitialized() && $this->createdAt == $createdAt) {
            return $this;
        }

        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCreatedAt(): \DateTime
    {
        return clone $this->createdAt;
    }

    protected function setBrand(BrandInterface $brand): static
    {
        $this->brand = $brand;

        return $this;
    }

    public function getBrand(): BrandInterface
    {
        return $this->brand;
    }
}
