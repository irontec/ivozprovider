<?php

namespace Ivoz\Cgr\Domain\Model\TpDerivedCharge;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Application\CollectionTransformerInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class TpDerivedChargeDtoAbstract implements DataTransferObjectInterface
{
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
     * @var string
     */
    private $subject = '*any';

    /**
     * @var string
     */
    private $runid = 'carrier';

    /**
     * @var string
     */
    private $runFilters = 'carrier_id';

    /**
     * @var string
     */
    private $accountField = 'carrier_id';

    /**
     * @var string
     */
    private $subjectField = 'carrier_id';

    /**
     * @var \DateTime
     */
    private $createdAt = 'CURRENT_TIMESTAMP';

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\Brand\BrandDto | null
     */
    private $brand;


    use DtoNormalizer;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
     * @inheritdoc
     */
    public static function getPropertyMap(string $context = '')
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
            'runid' => 'runid',
            'runFilters' => 'runFilters',
            'accountField' => 'accountField',
            'subjectField' => 'subjectField',
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
        return [
            'tpid' => $this->getTpid(),
            'loadid' => $this->getLoadid(),
            'direction' => $this->getDirection(),
            'tenant' => $this->getTenant(),
            'category' => $this->getCategory(),
            'account' => $this->getAccount(),
            'subject' => $this->getSubject(),
            'runid' => $this->getRunid(),
            'runFilters' => $this->getRunFilters(),
            'accountField' => $this->getAccountField(),
            'subjectField' => $this->getSubjectField(),
            'createdAt' => $this->getCreatedAt(),
            'id' => $this->getId(),
            'brand' => $this->getBrand()
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function transformForeignKeys(ForeignKeyTransformerInterface $transformer)
    {
        $this->brand = $transformer->transform('Ivoz\\Provider\\Domain\\Model\\Brand\\Brand', $this->getBrandId());
    }

    /**
     * {@inheritDoc}
     */
    public function transformCollections(CollectionTransformerInterface $transformer)
    {

    }

    /**
     * @param string $tpid
     *
     * @return static
     */
    public function setTpid($tpid = null)
    {
        $this->tpid = $tpid;

        return $this;
    }

    /**
     * @return string
     */
    public function getTpid()
    {
        return $this->tpid;
    }

    /**
     * @param string $loadid
     *
     * @return static
     */
    public function setLoadid($loadid = null)
    {
        $this->loadid = $loadid;

        return $this;
    }

    /**
     * @return string
     */
    public function getLoadid()
    {
        return $this->loadid;
    }

    /**
     * @param string $direction
     *
     * @return static
     */
    public function setDirection($direction = null)
    {
        $this->direction = $direction;

        return $this;
    }

    /**
     * @return string
     */
    public function getDirection()
    {
        return $this->direction;
    }

    /**
     * @param string $tenant
     *
     * @return static
     */
    public function setTenant($tenant = null)
    {
        $this->tenant = $tenant;

        return $this;
    }

    /**
     * @return string
     */
    public function getTenant()
    {
        return $this->tenant;
    }

    /**
     * @param string $category
     *
     * @return static
     */
    public function setCategory($category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param string $account
     *
     * @return static
     */
    public function setAccount($account = null)
    {
        $this->account = $account;

        return $this;
    }

    /**
     * @return string
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * @param string $subject
     *
     * @return static
     */
    public function setSubject($subject = null)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param string $runid
     *
     * @return static
     */
    public function setRunid($runid = null)
    {
        $this->runid = $runid;

        return $this;
    }

    /**
     * @return string
     */
    public function getRunid()
    {
        return $this->runid;
    }

    /**
     * @param string $runFilters
     *
     * @return static
     */
    public function setRunFilters($runFilters = null)
    {
        $this->runFilters = $runFilters;

        return $this;
    }

    /**
     * @return string
     */
    public function getRunFilters()
    {
        return $this->runFilters;
    }

    /**
     * @param string $accountField
     *
     * @return static
     */
    public function setAccountField($accountField = null)
    {
        $this->accountField = $accountField;

        return $this;
    }

    /**
     * @return string
     */
    public function getAccountField()
    {
        return $this->accountField;
    }

    /**
     * @param string $subjectField
     *
     * @return static
     */
    public function setSubjectField($subjectField = null)
    {
        $this->subjectField = $subjectField;

        return $this;
    }

    /**
     * @return string
     */
    public function getSubjectField()
    {
        return $this->subjectField;
    }

    /**
     * @param \DateTime $createdAt
     *
     * @return static
     */
    public function setCreatedAt($createdAt = null)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param integer $id
     *
     * @return static
     */
    public function setId($id = null)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\Brand\BrandDto $brand
     *
     * @return static
     */
    public function setBrand(\Ivoz\Provider\Domain\Model\Brand\BrandDto $brand = null)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Brand\BrandDto
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setBrandId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Brand\BrandDto($id)
            : null;

        return $this->setBrand($value);
    }

    /**
     * @return integer | null
     */
    public function getBrandId()
    {
        if ($dto = $this->getBrand()) {
            return $dto->getId();
        }

        return null;
    }
}


