<?php
declare(strict_types = 1);

namespace Ivoz\Cgr\Domain\Model\TpAccountAction;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use \Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Domain\Model\Helper\DateTimeHelper;
use Ivoz\Provider\Domain\Model\Company\Company;
use Ivoz\Provider\Domain\Model\Carrier\Carrier;

/**
* TpAccountActionAbstract
* @codeCoverageIgnore
*/
abstract class TpAccountActionAbstract
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
    protected $tenant;

    /**
     * @var string
     */
    protected $account;

    /**
     * column: action_plan_tag
     * @var string | null
     */
    protected $actionPlanTag;

    /**
     * column: action_triggers_tag
     * @var string | null
     */
    protected $actionTriggersTag;

    /**
     * column: allow_negative
     * @var bool
     */
    protected $allowNegative = false;

    /**
     * @var bool
     */
    protected $disabled = false;

    /**
     * column: created_at
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var Company | null
     */
    protected $company;

    /**
     * @var Carrier | null
     */
    protected $carrier;

    /**
     * Constructor
     */
    protected function __construct(
        $tpid,
        $loadid,
        $tenant,
        $account,
        $allowNegative,
        $disabled,
        $createdAt
    ) {
        $this->setTpid($tpid);
        $this->setLoadid($loadid);
        $this->setTenant($tenant);
        $this->setAccount($account);
        $this->setAllowNegative($allowNegative);
        $this->setDisabled($disabled);
        $this->setCreatedAt($createdAt);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "TpAccountAction",
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
     * @return TpAccountActionDto
     */
    public static function createDto($id = null)
    {
        return new TpAccountActionDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param TpAccountActionInterface|null $entity
     * @param int $depth
     * @return TpAccountActionDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, TpAccountActionInterface::class);

        if ($depth < 1) {
            return static::createDto($entity->getId());
        }

        if ($entity instanceof \Doctrine\ORM\Proxy\Proxy && !$entity->__isInitialized()) {
            return static::createDto($entity->getId());
        }

        /** @var TpAccountActionDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param TpAccountActionDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, TpAccountActionDto::class);

        $self = new static(
            $dto->getTpid(),
            $dto->getLoadid(),
            $dto->getTenant(),
            $dto->getAccount(),
            $dto->getAllowNegative(),
            $dto->getDisabled(),
            $dto->getCreatedAt()
        );

        $self
            ->setActionPlanTag($dto->getActionPlanTag())
            ->setActionTriggersTag($dto->getActionTriggersTag())
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setCarrier($fkTransformer->transform($dto->getCarrier()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param TpAccountActionDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, TpAccountActionDto::class);

        $this
            ->setTpid($dto->getTpid())
            ->setLoadid($dto->getLoadid())
            ->setTenant($dto->getTenant())
            ->setAccount($dto->getAccount())
            ->setActionPlanTag($dto->getActionPlanTag())
            ->setActionTriggersTag($dto->getActionTriggersTag())
            ->setAllowNegative($dto->getAllowNegative())
            ->setDisabled($dto->getDisabled())
            ->setCreatedAt($dto->getCreatedAt())
            ->setCompany($fkTransformer->transform($dto->getCompany()))
            ->setCarrier($fkTransformer->transform($dto->getCarrier()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return TpAccountActionDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setTpid(self::getTpid())
            ->setLoadid(self::getLoadid())
            ->setTenant(self::getTenant())
            ->setAccount(self::getAccount())
            ->setActionPlanTag(self::getActionPlanTag())
            ->setActionTriggersTag(self::getActionTriggersTag())
            ->setAllowNegative(self::getAllowNegative())
            ->setDisabled(self::getDisabled())
            ->setCreatedAt(self::getCreatedAt())
            ->setCompany(Company::entityToDto(self::getCompany(), $depth))
            ->setCarrier(Carrier::entityToDto(self::getCarrier(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'tpid' => self::getTpid(),
            'loadid' => self::getLoadid(),
            'tenant' => self::getTenant(),
            'account' => self::getAccount(),
            'action_plan_tag' => self::getActionPlanTag(),
            'action_triggers_tag' => self::getActionTriggersTag(),
            'allow_negative' => self::getAllowNegative(),
            'disabled' => self::getDisabled(),
            'created_at' => self::getCreatedAt(),
            'companyId' => self::getCompany() ? self::getCompany()->getId() : null,
            'carrierId' => self::getCarrier() ? self::getCarrier()->getId() : null
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

    protected function setActionPlanTag(?string $actionPlanTag = null): static
    {
        if (!is_null($actionPlanTag)) {
            Assertion::maxLength($actionPlanTag, 64, 'actionPlanTag value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->actionPlanTag = $actionPlanTag;

        return $this;
    }

    public function getActionPlanTag(): ?string
    {
        return $this->actionPlanTag;
    }

    protected function setActionTriggersTag(?string $actionTriggersTag = null): static
    {
        if (!is_null($actionTriggersTag)) {
            Assertion::maxLength($actionTriggersTag, 64, 'actionTriggersTag value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->actionTriggersTag = $actionTriggersTag;

        return $this;
    }

    public function getActionTriggersTag(): ?string
    {
        return $this->actionTriggersTag;
    }

    protected function setAllowNegative(bool $allowNegative): static
    {
        Assertion::between(intval($allowNegative), 0, 1, 'allowNegative provided "%s" is not a valid boolean value.');
        $allowNegative = (bool) $allowNegative;

        $this->allowNegative = $allowNegative;

        return $this;
    }

    public function getAllowNegative(): bool
    {
        return $this->allowNegative;
    }

    protected function setDisabled(bool $disabled): static
    {
        Assertion::between(intval($disabled), 0, 1, 'disabled provided "%s" is not a valid boolean value.');
        $disabled = (bool) $disabled;

        $this->disabled = $disabled;

        return $this;
    }

    public function getDisabled(): bool
    {
        return $this->disabled;
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

    protected function setCompany(?Company $company = null): static
    {
        $this->company = $company;

        return $this;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    protected function setCarrier(?Carrier $carrier = null): static
    {
        $this->carrier = $carrier;

        return $this;
    }

    public function getCarrier(): ?Carrier
    {
        return $this->carrier;
    }

}
