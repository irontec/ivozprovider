<?php

namespace Ivoz\Cgr\Domain\Model\TpCdrStat;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class TpCdrStatDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $tpid = 'ivozprovider';

    /**
     * @var string
     */
    private $tag;

    /**
     * @var integer
     */
    private $queueLength = 0;

    /**
     * @var string
     */
    private $timeWindow = '';

    /**
     * @var string
     */
    private $saveInterval = '';

    /**
     * @var string
     */
    private $metrics;

    /**
     * @var string
     */
    private $setupInterval = '';

    /**
     * @var string
     */
    private $tors = '';

    /**
     * @var string
     */
    private $cdrHosts = '';

    /**
     * @var string
     */
    private $cdrSources = '';

    /**
     * @var string
     */
    private $reqTypes = '';

    /**
     * @var string
     */
    private $directions = '';

    /**
     * @var string
     */
    private $tenants = '';

    /**
     * @var string
     */
    private $categories = '';

    /**
     * @var string
     */
    private $accounts = '';

    /**
     * @var string
     */
    private $subjects = '';

    /**
     * @var string
     */
    private $destinationIds = '';

    /**
     * @var string
     */
    private $ppdInterval = '';

    /**
     * @var string
     */
    private $usageInterval = '';

    /**
     * @var string
     */
    private $suppliers = '';

    /**
     * @var string
     */
    private $disconnectCauses = '';

    /**
     * @var string
     */
    private $mediationRunids = '';

    /**
     * @var string
     */
    private $ratedAccounts = '';

    /**
     * @var string
     */
    private $ratedSubjects = '';

    /**
     * @var string
     */
    private $costInterval = '';

    /**
     * @var string
     */
    private $actionTriggers = '';

    /**
     * @var \DateTime
     */
    private $createdAt = 'CURRENT_TIMESTAMP';

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\Carrier\CarrierDto | null
     */
    private $carrier;


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
            'tag' => 'tag',
            'queueLength' => 'queueLength',
            'timeWindow' => 'timeWindow',
            'saveInterval' => 'saveInterval',
            'metrics' => 'metrics',
            'setupInterval' => 'setupInterval',
            'tors' => 'tors',
            'cdrHosts' => 'cdrHosts',
            'cdrSources' => 'cdrSources',
            'reqTypes' => 'reqTypes',
            'directions' => 'directions',
            'tenants' => 'tenants',
            'categories' => 'categories',
            'accounts' => 'accounts',
            'subjects' => 'subjects',
            'destinationIds' => 'destinationIds',
            'ppdInterval' => 'ppdInterval',
            'usageInterval' => 'usageInterval',
            'suppliers' => 'suppliers',
            'disconnectCauses' => 'disconnectCauses',
            'mediationRunids' => 'mediationRunids',
            'ratedAccounts' => 'ratedAccounts',
            'ratedSubjects' => 'ratedSubjects',
            'costInterval' => 'costInterval',
            'actionTriggers' => 'actionTriggers',
            'createdAt' => 'createdAt',
            'id' => 'id',
            'carrierId' => 'carrier'
        ];
    }

    /**
     * @return array
     */
    public function toArray($hideSensitiveData = false)
    {
        return [
            'tpid' => $this->getTpid(),
            'tag' => $this->getTag(),
            'queueLength' => $this->getQueueLength(),
            'timeWindow' => $this->getTimeWindow(),
            'saveInterval' => $this->getSaveInterval(),
            'metrics' => $this->getMetrics(),
            'setupInterval' => $this->getSetupInterval(),
            'tors' => $this->getTors(),
            'cdrHosts' => $this->getCdrHosts(),
            'cdrSources' => $this->getCdrSources(),
            'reqTypes' => $this->getReqTypes(),
            'directions' => $this->getDirections(),
            'tenants' => $this->getTenants(),
            'categories' => $this->getCategories(),
            'accounts' => $this->getAccounts(),
            'subjects' => $this->getSubjects(),
            'destinationIds' => $this->getDestinationIds(),
            'ppdInterval' => $this->getPpdInterval(),
            'usageInterval' => $this->getUsageInterval(),
            'suppliers' => $this->getSuppliers(),
            'disconnectCauses' => $this->getDisconnectCauses(),
            'mediationRunids' => $this->getMediationRunids(),
            'ratedAccounts' => $this->getRatedAccounts(),
            'ratedSubjects' => $this->getRatedSubjects(),
            'costInterval' => $this->getCostInterval(),
            'actionTriggers' => $this->getActionTriggers(),
            'createdAt' => $this->getCreatedAt(),
            'id' => $this->getId(),
            'carrier' => $this->getCarrier()
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
     * @param string $tag
     *
     * @return static
     */
    public function setTag($tag = null)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @param integer $queueLength
     *
     * @return static
     */
    public function setQueueLength($queueLength = null)
    {
        $this->queueLength = $queueLength;

        return $this;
    }

    /**
     * @return integer
     */
    public function getQueueLength()
    {
        return $this->queueLength;
    }

    /**
     * @param string $timeWindow
     *
     * @return static
     */
    public function setTimeWindow($timeWindow = null)
    {
        $this->timeWindow = $timeWindow;

        return $this;
    }

    /**
     * @return string
     */
    public function getTimeWindow()
    {
        return $this->timeWindow;
    }

    /**
     * @param string $saveInterval
     *
     * @return static
     */
    public function setSaveInterval($saveInterval = null)
    {
        $this->saveInterval = $saveInterval;

        return $this;
    }

    /**
     * @return string
     */
    public function getSaveInterval()
    {
        return $this->saveInterval;
    }

    /**
     * @param string $metrics
     *
     * @return static
     */
    public function setMetrics($metrics = null)
    {
        $this->metrics = $metrics;

        return $this;
    }

    /**
     * @return string
     */
    public function getMetrics()
    {
        return $this->metrics;
    }

    /**
     * @param string $setupInterval
     *
     * @return static
     */
    public function setSetupInterval($setupInterval = null)
    {
        $this->setupInterval = $setupInterval;

        return $this;
    }

    /**
     * @return string
     */
    public function getSetupInterval()
    {
        return $this->setupInterval;
    }

    /**
     * @param string $tors
     *
     * @return static
     */
    public function setTors($tors = null)
    {
        $this->tors = $tors;

        return $this;
    }

    /**
     * @return string
     */
    public function getTors()
    {
        return $this->tors;
    }

    /**
     * @param string $cdrHosts
     *
     * @return static
     */
    public function setCdrHosts($cdrHosts = null)
    {
        $this->cdrHosts = $cdrHosts;

        return $this;
    }

    /**
     * @return string
     */
    public function getCdrHosts()
    {
        return $this->cdrHosts;
    }

    /**
     * @param string $cdrSources
     *
     * @return static
     */
    public function setCdrSources($cdrSources = null)
    {
        $this->cdrSources = $cdrSources;

        return $this;
    }

    /**
     * @return string
     */
    public function getCdrSources()
    {
        return $this->cdrSources;
    }

    /**
     * @param string $reqTypes
     *
     * @return static
     */
    public function setReqTypes($reqTypes = null)
    {
        $this->reqTypes = $reqTypes;

        return $this;
    }

    /**
     * @return string
     */
    public function getReqTypes()
    {
        return $this->reqTypes;
    }

    /**
     * @param string $directions
     *
     * @return static
     */
    public function setDirections($directions = null)
    {
        $this->directions = $directions;

        return $this;
    }

    /**
     * @return string
     */
    public function getDirections()
    {
        return $this->directions;
    }

    /**
     * @param string $tenants
     *
     * @return static
     */
    public function setTenants($tenants = null)
    {
        $this->tenants = $tenants;

        return $this;
    }

    /**
     * @return string
     */
    public function getTenants()
    {
        return $this->tenants;
    }

    /**
     * @param string $categories
     *
     * @return static
     */
    public function setCategories($categories = null)
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * @return string
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param string $accounts
     *
     * @return static
     */
    public function setAccounts($accounts = null)
    {
        $this->accounts = $accounts;

        return $this;
    }

    /**
     * @return string
     */
    public function getAccounts()
    {
        return $this->accounts;
    }

    /**
     * @param string $subjects
     *
     * @return static
     */
    public function setSubjects($subjects = null)
    {
        $this->subjects = $subjects;

        return $this;
    }

    /**
     * @return string
     */
    public function getSubjects()
    {
        return $this->subjects;
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
     * @param string $ppdInterval
     *
     * @return static
     */
    public function setPpdInterval($ppdInterval = null)
    {
        $this->ppdInterval = $ppdInterval;

        return $this;
    }

    /**
     * @return string
     */
    public function getPpdInterval()
    {
        return $this->ppdInterval;
    }

    /**
     * @param string $usageInterval
     *
     * @return static
     */
    public function setUsageInterval($usageInterval = null)
    {
        $this->usageInterval = $usageInterval;

        return $this;
    }

    /**
     * @return string
     */
    public function getUsageInterval()
    {
        return $this->usageInterval;
    }

    /**
     * @param string $suppliers
     *
     * @return static
     */
    public function setSuppliers($suppliers = null)
    {
        $this->suppliers = $suppliers;

        return $this;
    }

    /**
     * @return string
     */
    public function getSuppliers()
    {
        return $this->suppliers;
    }

    /**
     * @param string $disconnectCauses
     *
     * @return static
     */
    public function setDisconnectCauses($disconnectCauses = null)
    {
        $this->disconnectCauses = $disconnectCauses;

        return $this;
    }

    /**
     * @return string
     */
    public function getDisconnectCauses()
    {
        return $this->disconnectCauses;
    }

    /**
     * @param string $mediationRunids
     *
     * @return static
     */
    public function setMediationRunids($mediationRunids = null)
    {
        $this->mediationRunids = $mediationRunids;

        return $this;
    }

    /**
     * @return string
     */
    public function getMediationRunids()
    {
        return $this->mediationRunids;
    }

    /**
     * @param string $ratedAccounts
     *
     * @return static
     */
    public function setRatedAccounts($ratedAccounts = null)
    {
        $this->ratedAccounts = $ratedAccounts;

        return $this;
    }

    /**
     * @return string
     */
    public function getRatedAccounts()
    {
        return $this->ratedAccounts;
    }

    /**
     * @param string $ratedSubjects
     *
     * @return static
     */
    public function setRatedSubjects($ratedSubjects = null)
    {
        $this->ratedSubjects = $ratedSubjects;

        return $this;
    }

    /**
     * @return string
     */
    public function getRatedSubjects()
    {
        return $this->ratedSubjects;
    }

    /**
     * @param string $costInterval
     *
     * @return static
     */
    public function setCostInterval($costInterval = null)
    {
        $this->costInterval = $costInterval;

        return $this;
    }

    /**
     * @return string
     */
    public function getCostInterval()
    {
        return $this->costInterval;
    }

    /**
     * @param string $actionTriggers
     *
     * @return static
     */
    public function setActionTriggers($actionTriggers = null)
    {
        $this->actionTriggers = $actionTriggers;

        return $this;
    }

    /**
     * @return string
     */
    public function getActionTriggers()
    {
        return $this->actionTriggers;
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
     * @param \Ivoz\Provider\Domain\Model\Carrier\CarrierDto $carrier
     *
     * @return static
     */
    public function setCarrier(\Ivoz\Provider\Domain\Model\Carrier\CarrierDto $carrier = null)
    {
        $this->carrier = $carrier;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Carrier\CarrierDto
     */
    public function getCarrier()
    {
        return $this->carrier;
    }

    /**
     * @param integer $id | null
     *
     * @return static
     */
    public function setCarrierId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Carrier\CarrierDto($id)
            : null;

        return $this->setCarrier($value);
    }

    /**
     * @return integer | null
     */
    public function getCarrierId()
    {
        if ($dto = $this->getCarrier()) {
            return $dto->getId();
        }

        return null;
    }
}
