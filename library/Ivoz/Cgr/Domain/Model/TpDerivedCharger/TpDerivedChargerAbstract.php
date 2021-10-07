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
     * @var \DateTime
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
     * @param mixed $id
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
        $dto = $entity->toDto($depth - 1);

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

    protected function setCreatedAt($createdAt): static
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
