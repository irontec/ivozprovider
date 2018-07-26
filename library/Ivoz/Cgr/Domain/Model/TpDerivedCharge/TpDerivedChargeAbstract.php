<?php

namespace Ivoz\Cgr\Domain\Model\TpDerivedCharge;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * TpDerivedChargeAbstract
 * @codeCoverageIgnore
 */
abstract class TpDerivedChargeAbstract
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
     * @var string
     */
    protected $subject = '*any';

    /**
     * @var string
     */
    protected $runid = 'carrier';

    /**
     * column: run_filters
     * @var string
     */
    protected $runFilters = 'carrier_id';

    /**
     * column: account_field
     * @var string
     */
    protected $accountField = 'carrier_id';

    /**
     * column: subject_field
     * @var string
     */
    protected $subjectField = 'carrier_id';

    /**
     * column: created_at
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    protected $brand;


    use ChangelogTrait;

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
        $accountField,
        $subjectField,
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
        $this->setAccountField($accountField);
        $this->setSubjectField($subjectField);
        $this->setCreatedAt($createdAt);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf("%s#%s",
            "TpDerivedCharge",
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
     * @return TpDerivedChargeDto
     */
    public static function createDto($id = null)
    {
        return new TpDerivedChargeDto($id);
    }

    /**
     * @param EntityInterface|null $entity
     * @param int $depth
     * @return TpDerivedChargeDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, TpDerivedChargeInterface::class);

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
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto TpDerivedChargeDto
         */
        Assertion::isInstanceOf($dto, TpDerivedChargeDto::class);

        $self = new static(
            $dto->getTpid(),
            $dto->getLoadid(),
            $dto->getDirection(),
            $dto->getTenant(),
            $dto->getCategory(),
            $dto->getAccount(),
            $dto->getRunid(),
            $dto->getRunFilters(),
            $dto->getAccountField(),
            $dto->getSubjectField(),
            $dto->getCreatedAt());

        $self
            ->setSubject($dto->getSubject())
            ->setBrand($dto->getBrand())
        ;

        $self->sanitizeValues();
        $self->initChangelog();

        return $self;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto TpDerivedChargeDto
         */
        Assertion::isInstanceOf($dto, TpDerivedChargeDto::class);

        $this
            ->setTpid($dto->getTpid())
            ->setLoadid($dto->getLoadid())
            ->setDirection($dto->getDirection())
            ->setTenant($dto->getTenant())
            ->setCategory($dto->getCategory())
            ->setAccount($dto->getAccount())
            ->setSubject($dto->getSubject())
            ->setRunid($dto->getRunid())
            ->setRunFilters($dto->getRunFilters())
            ->setAccountField($dto->getAccountField())
            ->setSubjectField($dto->getSubjectField())
            ->setCreatedAt($dto->getCreatedAt())
            ->setBrand($dto->getBrand());



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @param int $depth
     * @return TpDerivedChargeDto
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
            ->setRunid(self::getRunid())
            ->setRunFilters(self::getRunFilters())
            ->setAccountField(self::getAccountField())
            ->setSubjectField(self::getSubjectField())
            ->setCreatedAt(self::getCreatedAt())
            ->setBrand(\Ivoz\Provider\Domain\Model\Brand\Brand::entityToDto(self::getBrand(), $depth));
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
            'runid' => self::getRunid(),
            'run_filters' => self::getRunFilters(),
            'account_field' => self::getAccountField(),
            'subject_field' => self::getSubjectField(),
            'created_at' => self::getCreatedAt(),
            'brandId' => self::getBrand() ? self::getBrand()->getId() : null
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
    public function setTpid($tpid)
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
    public function setLoadid($loadid)
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
     * Set direction
     *
     * @param string $direction
     *
     * @return self
     */
    public function setDirection($direction)
    {
        Assertion::notNull($direction, 'direction value "%s" is null, but non null value was expected.');
        Assertion::maxLength($direction, 8, 'direction value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->direction = $direction;

        return $this;
    }

    /**
     * Get direction
     *
     * @return string
     */
    public function getDirection()
    {
        return $this->direction;
    }

    /**
     * Set tenant
     *
     * @param string $tenant
     *
     * @return self
     */
    public function setTenant($tenant)
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
     * Set category
     *
     * @param string $category
     *
     * @return self
     */
    public function setCategory($category)
    {
        Assertion::notNull($category, 'category value "%s" is null, but non null value was expected.');
        Assertion::maxLength($category, 32, 'category value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set account
     *
     * @param string $account
     *
     * @return self
     */
    public function setAccount($account)
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
     * Set subject
     *
     * @param string $subject
     *
     * @return self
     */
    public function setSubject($subject = null)
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
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set runid
     *
     * @param string $runid
     *
     * @return self
     */
    public function setRunid($runid)
    {
        Assertion::notNull($runid, 'runid value "%s" is null, but non null value was expected.');
        Assertion::maxLength($runid, 64, 'runid value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->runid = $runid;

        return $this;
    }

    /**
     * Get runid
     *
     * @return string
     */
    public function getRunid()
    {
        return $this->runid;
    }

    /**
     * Set runFilters
     *
     * @param string $runFilters
     *
     * @return self
     */
    public function setRunFilters($runFilters)
    {
        Assertion::notNull($runFilters, 'runFilters value "%s" is null, but non null value was expected.');
        Assertion::maxLength($runFilters, 32, 'runFilters value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->runFilters = $runFilters;

        return $this;
    }

    /**
     * Get runFilters
     *
     * @return string
     */
    public function getRunFilters()
    {
        return $this->runFilters;
    }

    /**
     * Set accountField
     *
     * @param string $accountField
     *
     * @return self
     */
    public function setAccountField($accountField)
    {
        Assertion::notNull($accountField, 'accountField value "%s" is null, but non null value was expected.');
        Assertion::maxLength($accountField, 32, 'accountField value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->accountField = $accountField;

        return $this;
    }

    /**
     * Get accountField
     *
     * @return string
     */
    public function getAccountField()
    {
        return $this->accountField;
    }

    /**
     * Set subjectField
     *
     * @param string $subjectField
     *
     * @return self
     */
    public function setSubjectField($subjectField)
    {
        Assertion::notNull($subjectField, 'subjectField value "%s" is null, but non null value was expected.');
        Assertion::maxLength($subjectField, 32, 'subjectField value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->subjectField = $subjectField;

        return $this;
    }

    /**
     * Get subjectField
     *
     * @return string
     */
    public function getSubjectField()
    {
        return $this->subjectField;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return self
     */
    public function setCreatedAt($createdAt)
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
        return $this->createdAt;
    }

    /**
     * Set brand
     *
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand
     *
     * @return self
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandInterface $brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandInterface
     */
    public function getBrand()
    {
        return $this->brand;
    }



    // @codeCoverageIgnoreEnd
}

