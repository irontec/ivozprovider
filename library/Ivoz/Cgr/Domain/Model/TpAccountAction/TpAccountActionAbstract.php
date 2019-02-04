<?php

namespace Ivoz\Cgr\Domain\Model\TpAccountAction;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * TpAccountActionAbstract
 * @codeCoverageIgnore
 */
abstract class TpAccountActionAbstract
{
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
     * @var boolean
     */
    protected $allowNegative = 0;

    /**
     * @var boolean
     */
    protected $disabled = 0;

    /**
     * column: created_at
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    protected $company;

    /**
     * @var \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface
     */
    protected $carrier;


    use ChangelogTrait;

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
     * @param null $id
     * @return TpAccountActionDto
     */
    public static function createDto($id = null)
    {
        return new TpAccountActionDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param EntityInterface|null $entity
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

        return $entity->toDto($depth-1);
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        /**
         * @var $dto TpAccountActionDto
         */
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
            ->setCarrier($fkTransformer->transform($dto->getCarrier()))
        ;

        $self->sanitizeValues();
        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        /**
         * @var $dto TpAccountActionDto
         */
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



        $this->sanitizeValues();
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
            ->setCompany(\Ivoz\Provider\Domain\Model\Company\Company::entityToDto(self::getCompany(), $depth))
            ->setCarrier(\Ivoz\Provider\Domain\Model\Carrier\Carrier::entityToDto(self::getCarrier(), $depth));
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
    // @codeCoverageIgnoreStart

    /**
     * Set tpid
     *
     * @param string $tpid
     *
     * @return self
     */
    protected function setTpid($tpid)
    {
        Assertion::notNull($tpid, 'tpid value "%s" is null, but non null value was expected.');
        Assertion::maxLength($tpid, 64, 'tpid value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->tpid = $tpid;

        return $this;
    }

    /**
     * Get tpid
     *
     * @return string
     */
    public function getTpid()
    {
        return $this->tpid;
    }

    /**
     * Set loadid
     *
     * @param string $loadid
     *
     * @return self
     */
    protected function setLoadid($loadid)
    {
        Assertion::notNull($loadid, 'loadid value "%s" is null, but non null value was expected.');
        Assertion::maxLength($loadid, 64, 'loadid value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->loadid = $loadid;

        return $this;
    }

    /**
     * Get loadid
     *
     * @return string
     */
    public function getLoadid()
    {
        return $this->loadid;
    }

    /**
     * Set tenant
     *
     * @param string $tenant
     *
     * @return self
     */
    protected function setTenant($tenant)
    {
        Assertion::notNull($tenant, 'tenant value "%s" is null, but non null value was expected.');
        Assertion::maxLength($tenant, 64, 'tenant value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->tenant = $tenant;

        return $this;
    }

    /**
     * Get tenant
     *
     * @return string
     */
    public function getTenant()
    {
        return $this->tenant;
    }

    /**
     * Set account
     *
     * @param string $account
     *
     * @return self
     */
    protected function setAccount($account)
    {
        Assertion::notNull($account, 'account value "%s" is null, but non null value was expected.');
        Assertion::maxLength($account, 64, 'account value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->account = $account;

        return $this;
    }

    /**
     * Get account
     *
     * @return string
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * Set actionPlanTag
     *
     * @param string $actionPlanTag
     *
     * @return self
     */
    protected function setActionPlanTag($actionPlanTag = null)
    {
        if (!is_null($actionPlanTag)) {
            Assertion::maxLength($actionPlanTag, 64, 'actionPlanTag value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->actionPlanTag = $actionPlanTag;

        return $this;
    }

    /**
     * Get actionPlanTag
     *
     * @return string | null
     */
    public function getActionPlanTag()
    {
        return $this->actionPlanTag;
    }

    /**
     * Set actionTriggersTag
     *
     * @param string $actionTriggersTag
     *
     * @return self
     */
    protected function setActionTriggersTag($actionTriggersTag = null)
    {
        if (!is_null($actionTriggersTag)) {
            Assertion::maxLength($actionTriggersTag, 64, 'actionTriggersTag value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->actionTriggersTag = $actionTriggersTag;

        return $this;
    }

    /**
     * Get actionTriggersTag
     *
     * @return string | null
     */
    public function getActionTriggersTag()
    {
        return $this->actionTriggersTag;
    }

    /**
     * Set allowNegative
     *
     * @param boolean $allowNegative
     *
     * @return self
     */
    protected function setAllowNegative($allowNegative)
    {
        Assertion::notNull($allowNegative, 'allowNegative value "%s" is null, but non null value was expected.');
        Assertion::between(intval($allowNegative), 0, 1, 'allowNegative provided "%s" is not a valid boolean value.');

        $this->allowNegative = $allowNegative;

        return $this;
    }

    /**
     * Get allowNegative
     *
     * @return boolean
     */
    public function getAllowNegative()
    {
        return $this->allowNegative;
    }

    /**
     * Set disabled
     *
     * @param boolean $disabled
     *
     * @return self
     */
    protected function setDisabled($disabled)
    {
        Assertion::notNull($disabled, 'disabled value "%s" is null, but non null value was expected.');
        Assertion::between(intval($disabled), 0, 1, 'disabled provided "%s" is not a valid boolean value.');

        $this->disabled = $disabled;

        return $this;
    }

    /**
     * Get disabled
     *
     * @return boolean
     */
    public function getDisabled()
    {
        return $this->disabled;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return self
     */
    protected function setCreatedAt($createdAt)
    {
        Assertion::notNull($createdAt, 'createdAt value "%s" is null, but non null value was expected.');
        $createdAt = \Ivoz\Core\Domain\Model\Helper\DateTimeHelper::createOrFix(
            $createdAt,
            'CURRENT_TIMESTAMP'
        );

        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return clone $this->createdAt;
    }

    /**
     * Set company
     *
     * @param \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company
     *
     * @return self
     */
    public function setCompany(\Ivoz\Provider\Domain\Model\Company\CompanyInterface $company = null)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface | null
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set carrier
     *
     * @param \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface $carrier
     *
     * @return self
     */
    public function setCarrier(\Ivoz\Provider\Domain\Model\Carrier\CarrierInterface $carrier = null)
    {
        $this->carrier = $carrier;

        return $this;
    }

    /**
     * Get carrier
     *
     * @return \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface | null
     */
    public function getCarrier()
    {
        return $this->carrier;
    }

    // @codeCoverageIgnoreEnd
}
