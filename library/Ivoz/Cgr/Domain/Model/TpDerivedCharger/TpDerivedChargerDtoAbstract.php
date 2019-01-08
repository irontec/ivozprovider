<?php

namespace Ivoz\Cgr\Domain\Model\TpDerivedCharger;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class TpDerivedChargerDtoAbstract implements DataTransferObjectInterface
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
    private $destinationIds = '*any';

    /**
     * @var string
     */
    private $runid = 'carrier';

    /**
     * @var string
     */
    private $runFilters = 'carrierId';

    /**
     * @var string
     */
    private $reqTypeField = 'carrierReqtype';

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
        return [
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
     * @param string $destinationIds
     *
     * @return static
     */
    public function setDestinationIds($destinationIds = null)
    {
        $this->destinationIds = $destinationIds;

        return $this;
    }

    /**
     * @return string
     */
    public function getDestinationIds()
    {
        return $this->destinationIds;
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
     * @param string $reqTypeField
     *
     * @return static
     */
    public function setReqTypeField($reqTypeField = null)
    {
        $this->reqTypeField = $reqTypeField;

        return $this;
    }

    /**
     * @return string
     */
    public function getReqTypeField()
    {
        return $this->reqTypeField;
    }

    /**
     * @param string $directionField
     *
     * @return static
     */
    public function setDirectionField($directionField = null)
    {
        $this->directionField = $directionField;

        return $this;
    }

    /**
     * @return string
     */
    public function getDirectionField()
    {
        return $this->directionField;
    }

    /**
     * @param string $tenantField
     *
     * @return static
     */
    public function setTenantField($tenantField = null)
    {
        $this->tenantField = $tenantField;

        return $this;
    }

    /**
     * @return string
     */
    public function getTenantField()
    {
        return $this->tenantField;
    }

    /**
     * @param string $categoryField
     *
     * @return static
     */
    public function setCategoryField($categoryField = null)
    {
        $this->categoryField = $categoryField;

        return $this;
    }

    /**
     * @return string
     */
    public function getCategoryField()
    {
        return $this->categoryField;
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
     * @param string $destinationField
     *
     * @return static
     */
    public function setDestinationField($destinationField = null)
    {
        $this->destinationField = $destinationField;

        return $this;
    }

    /**
     * @return string
     */
    public function getDestinationField()
    {
        return $this->destinationField;
    }

    /**
     * @param string $setupTimeField
     *
     * @return static
     */
    public function setSetupTimeField($setupTimeField = null)
    {
        $this->setupTimeField = $setupTimeField;

        return $this;
    }

    /**
     * @return string
     */
    public function getSetupTimeField()
    {
        return $this->setupTimeField;
    }

    /**
     * @param string $pddField
     *
     * @return static
     */
    public function setPddField($pddField = null)
    {
        $this->pddField = $pddField;

        return $this;
    }

    /**
     * @return string
     */
    public function getPddField()
    {
        return $this->pddField;
    }

    /**
     * @param string $answerTimeField
     *
     * @return static
     */
    public function setAnswerTimeField($answerTimeField = null)
    {
        $this->answerTimeField = $answerTimeField;

        return $this;
    }

    /**
     * @return string
     */
    public function getAnswerTimeField()
    {
        return $this->answerTimeField;
    }

    /**
     * @param string $usageField
     *
     * @return static
     */
    public function setUsageField($usageField = null)
    {
        $this->usageField = $usageField;

        return $this;
    }

    /**
     * @return string
     */
    public function getUsageField()
    {
        return $this->usageField;
    }

    /**
     * @param string $supplierField
     *
     * @return static
     */
    public function setSupplierField($supplierField = null)
    {
        $this->supplierField = $supplierField;

        return $this;
    }

    /**
     * @return string
     */
    public function getSupplierField()
    {
        return $this->supplierField;
    }

    /**
     * @param string $disconnectCauseField
     *
     * @return static
     */
    public function setDisconnectCauseField($disconnectCauseField = null)
    {
        $this->disconnectCauseField = $disconnectCauseField;

        return $this;
    }

    /**
     * @return string
     */
    public function getDisconnectCauseField()
    {
        return $this->disconnectCauseField;
    }

    /**
     * @param string $ratedTimeField
     *
     * @return static
     */
    public function setRatedTimeField($ratedTimeField = null)
    {
        $this->ratedTimeField = $ratedTimeField;

        return $this;
    }

    /**
     * @return string
     */
    public function getRatedTimeField()
    {
        return $this->ratedTimeField;
    }

    /**
     * @param string $costField
     *
     * @return static
     */
    public function setCostField($costField = null)
    {
        $this->costField = $costField;

        return $this;
    }

    /**
     * @return string
     */
    public function getCostField()
    {
        return $this->costField;
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
