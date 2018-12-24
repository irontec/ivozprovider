<?php

namespace Ivoz\Cgr\Domain\Model\TpCdrStat;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * TpCdrStatAbstract
 * @codeCoverageIgnore
 */
abstract class TpCdrStatAbstract
{
    /**
     * @var string
     */
    protected $tpid = 'ivozprovider';

    /**
     * @var string
     */
    protected $tag;

    /**
     * column: queue_length
     * @var integer
     */
    protected $queueLength = 0;

    /**
     * column: time_window
     * @var string
     */
    protected $timeWindow = '';

    /**
     * column: save_interval
     * @var string
     */
    protected $saveInterval = '';

    /**
     * @var string
     */
    protected $metrics;

    /**
     * column: setup_interval
     * @var string
     */
    protected $setupInterval = '';

    /**
     * @var string
     */
    protected $tors = '';

    /**
     * column: cdr_hosts
     * @var string
     */
    protected $cdrHosts = '';

    /**
     * column: cdr_sources
     * @var string
     */
    protected $cdrSources = '';

    /**
     * column: req_types
     * @var string
     */
    protected $reqTypes = '';

    /**
     * @var string
     */
    protected $directions = '';

    /**
     * @var string
     */
    protected $tenants = '';

    /**
     * @var string
     */
    protected $categories = '';

    /**
     * @var string
     */
    protected $accounts = '';

    /**
     * @var string
     */
    protected $subjects = '';

    /**
     * column: destination_ids
     * @var string
     */
    protected $destinationIds = '';

    /**
     * column: ppd_interval
     * @var string
     */
    protected $ppdInterval = '';

    /**
     * column: usage_interval
     * @var string
     */
    protected $usageInterval = '';

    /**
     * @var string
     */
    protected $suppliers = '';

    /**
     * column: disconnect_causes
     * @var string
     */
    protected $disconnectCauses = '';

    /**
     * column: mediation_runids
     * @var string
     */
    protected $mediationRunids = '';

    /**
     * column: rated_accounts
     * @var string
     */
    protected $ratedAccounts = '';

    /**
     * column: rated_subjects
     * @var string
     */
    protected $ratedSubjects = '';

    /**
     * column: cost_interval
     * @var string
     */
    protected $costInterval = '';

    /**
     * column: action_triggers
     * @var string
     */
    protected $actionTriggers = '';

    /**
     * column: created_at
     * @var \DateTime
     */
    protected $createdAt;

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
        $tag,
        $queueLength,
        $timeWindow,
        $saveInterval,
        $metrics,
        $setupInterval,
        $tors,
        $cdrHosts,
        $cdrSources,
        $reqTypes,
        $directions,
        $tenants,
        $categories,
        $accounts,
        $subjects,
        $destinationIds,
        $ppdInterval,
        $usageInterval,
        $suppliers,
        $disconnectCauses,
        $mediationRunids,
        $ratedAccounts,
        $ratedSubjects,
        $costInterval,
        $actionTriggers,
        $createdAt
    ) {
        $this->setTpid($tpid);
        $this->setTag($tag);
        $this->setQueueLength($queueLength);
        $this->setTimeWindow($timeWindow);
        $this->setSaveInterval($saveInterval);
        $this->setMetrics($metrics);
        $this->setSetupInterval($setupInterval);
        $this->setTors($tors);
        $this->setCdrHosts($cdrHosts);
        $this->setCdrSources($cdrSources);
        $this->setReqTypes($reqTypes);
        $this->setDirections($directions);
        $this->setTenants($tenants);
        $this->setCategories($categories);
        $this->setAccounts($accounts);
        $this->setSubjects($subjects);
        $this->setDestinationIds($destinationIds);
        $this->setPpdInterval($ppdInterval);
        $this->setUsageInterval($usageInterval);
        $this->setSuppliers($suppliers);
        $this->setDisconnectCauses($disconnectCauses);
        $this->setMediationRunids($mediationRunids);
        $this->setRatedAccounts($ratedAccounts);
        $this->setRatedSubjects($ratedSubjects);
        $this->setCostInterval($costInterval);
        $this->setActionTriggers($actionTriggers);
        $this->setCreatedAt($createdAt);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "TpCdrStat",
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
     * @return TpCdrStatDto
     */
    public static function createDto($id = null)
    {
        return new TpCdrStatDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param EntityInterface|null $entity
     * @param int $depth
     * @return TpCdrStatDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, TpCdrStatInterface::class);

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
    public static function fromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto TpCdrStatDto
         */
        Assertion::isInstanceOf($dto, TpCdrStatDto::class);

        $self = new static(
            $dto->getTpid(),
            $dto->getTag(),
            $dto->getQueueLength(),
            $dto->getTimeWindow(),
            $dto->getSaveInterval(),
            $dto->getMetrics(),
            $dto->getSetupInterval(),
            $dto->getTors(),
            $dto->getCdrHosts(),
            $dto->getCdrSources(),
            $dto->getReqTypes(),
            $dto->getDirections(),
            $dto->getTenants(),
            $dto->getCategories(),
            $dto->getAccounts(),
            $dto->getSubjects(),
            $dto->getDestinationIds(),
            $dto->getPpdInterval(),
            $dto->getUsageInterval(),
            $dto->getSuppliers(),
            $dto->getDisconnectCauses(),
            $dto->getMediationRunids(),
            $dto->getRatedAccounts(),
            $dto->getRatedSubjects(),
            $dto->getCostInterval(),
            $dto->getActionTriggers(),
            $dto->getCreatedAt()
        );

        $self
            ->setCarrier($dto->getCarrier())
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
    public function updateFromDto(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto TpCdrStatDto
         */
        Assertion::isInstanceOf($dto, TpCdrStatDto::class);

        $this
            ->setTpid($dto->getTpid())
            ->setTag($dto->getTag())
            ->setQueueLength($dto->getQueueLength())
            ->setTimeWindow($dto->getTimeWindow())
            ->setSaveInterval($dto->getSaveInterval())
            ->setMetrics($dto->getMetrics())
            ->setSetupInterval($dto->getSetupInterval())
            ->setTors($dto->getTors())
            ->setCdrHosts($dto->getCdrHosts())
            ->setCdrSources($dto->getCdrSources())
            ->setReqTypes($dto->getReqTypes())
            ->setDirections($dto->getDirections())
            ->setTenants($dto->getTenants())
            ->setCategories($dto->getCategories())
            ->setAccounts($dto->getAccounts())
            ->setSubjects($dto->getSubjects())
            ->setDestinationIds($dto->getDestinationIds())
            ->setPpdInterval($dto->getPpdInterval())
            ->setUsageInterval($dto->getUsageInterval())
            ->setSuppliers($dto->getSuppliers())
            ->setDisconnectCauses($dto->getDisconnectCauses())
            ->setMediationRunids($dto->getMediationRunids())
            ->setRatedAccounts($dto->getRatedAccounts())
            ->setRatedSubjects($dto->getRatedSubjects())
            ->setCostInterval($dto->getCostInterval())
            ->setActionTriggers($dto->getActionTriggers())
            ->setCreatedAt($dto->getCreatedAt())
            ->setCarrier($dto->getCarrier());



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return TpCdrStatDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setTpid(self::getTpid())
            ->setTag(self::getTag())
            ->setQueueLength(self::getQueueLength())
            ->setTimeWindow(self::getTimeWindow())
            ->setSaveInterval(self::getSaveInterval())
            ->setMetrics(self::getMetrics())
            ->setSetupInterval(self::getSetupInterval())
            ->setTors(self::getTors())
            ->setCdrHosts(self::getCdrHosts())
            ->setCdrSources(self::getCdrSources())
            ->setReqTypes(self::getReqTypes())
            ->setDirections(self::getDirections())
            ->setTenants(self::getTenants())
            ->setCategories(self::getCategories())
            ->setAccounts(self::getAccounts())
            ->setSubjects(self::getSubjects())
            ->setDestinationIds(self::getDestinationIds())
            ->setPpdInterval(self::getPpdInterval())
            ->setUsageInterval(self::getUsageInterval())
            ->setSuppliers(self::getSuppliers())
            ->setDisconnectCauses(self::getDisconnectCauses())
            ->setMediationRunids(self::getMediationRunids())
            ->setRatedAccounts(self::getRatedAccounts())
            ->setRatedSubjects(self::getRatedSubjects())
            ->setCostInterval(self::getCostInterval())
            ->setActionTriggers(self::getActionTriggers())
            ->setCreatedAt(self::getCreatedAt())
            ->setCarrier(\Ivoz\Provider\Domain\Model\Carrier\Carrier::entityToDto(self::getCarrier(), $depth));
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'tpid' => self::getTpid(),
            'tag' => self::getTag(),
            'queue_length' => self::getQueueLength(),
            'time_window' => self::getTimeWindow(),
            'save_interval' => self::getSaveInterval(),
            'metrics' => self::getMetrics(),
            'setup_interval' => self::getSetupInterval(),
            'tors' => self::getTors(),
            'cdr_hosts' => self::getCdrHosts(),
            'cdr_sources' => self::getCdrSources(),
            'req_types' => self::getReqTypes(),
            'directions' => self::getDirections(),
            'tenants' => self::getTenants(),
            'categories' => self::getCategories(),
            'accounts' => self::getAccounts(),
            'subjects' => self::getSubjects(),
            'destination_ids' => self::getDestinationIds(),
            'ppd_interval' => self::getPpdInterval(),
            'usage_interval' => self::getUsageInterval(),
            'suppliers' => self::getSuppliers(),
            'disconnect_causes' => self::getDisconnectCauses(),
            'mediation_runids' => self::getMediationRunids(),
            'rated_accounts' => self::getRatedAccounts(),
            'rated_subjects' => self::getRatedSubjects(),
            'cost_interval' => self::getCostInterval(),
            'action_triggers' => self::getActionTriggers(),
            'created_at' => self::getCreatedAt(),
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
     * Set tag
     *
     * @param string $tag
     *
     * @return self
     */
    protected function setTag($tag)
    {
        Assertion::notNull($tag, 'tag value "%s" is null, but non null value was expected.');
        Assertion::maxLength($tag, 64, 'tag value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return string
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Set queueLength
     *
     * @param integer $queueLength
     *
     * @return self
     */
    protected function setQueueLength($queueLength)
    {
        Assertion::notNull($queueLength, 'queueLength value "%s" is null, but non null value was expected.');
        Assertion::integerish($queueLength, 'queueLength value "%s" is not an integer or a number castable to integer.');

        $this->queueLength = $queueLength;

        return $this;
    }

    /**
     * Get queueLength
     *
     * @return integer
     */
    public function getQueueLength()
    {
        return $this->queueLength;
    }

    /**
     * Set timeWindow
     *
     * @param string $timeWindow
     *
     * @return self
     */
    protected function setTimeWindow($timeWindow)
    {
        Assertion::notNull($timeWindow, 'timeWindow value "%s" is null, but non null value was expected.');
        Assertion::maxLength($timeWindow, 8, 'timeWindow value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->timeWindow = $timeWindow;

        return $this;
    }

    /**
     * Get timeWindow
     *
     * @return string
     */
    public function getTimeWindow()
    {
        return $this->timeWindow;
    }

    /**
     * Set saveInterval
     *
     * @param string $saveInterval
     *
     * @return self
     */
    protected function setSaveInterval($saveInterval)
    {
        Assertion::notNull($saveInterval, 'saveInterval value "%s" is null, but non null value was expected.');
        Assertion::maxLength($saveInterval, 8, 'saveInterval value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->saveInterval = $saveInterval;

        return $this;
    }

    /**
     * Get saveInterval
     *
     * @return string
     */
    public function getSaveInterval()
    {
        return $this->saveInterval;
    }

    /**
     * Set metrics
     *
     * @param string $metrics
     *
     * @return self
     */
    protected function setMetrics($metrics)
    {
        Assertion::notNull($metrics, 'metrics value "%s" is null, but non null value was expected.');
        Assertion::maxLength($metrics, 64, 'metrics value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->metrics = $metrics;

        return $this;
    }

    /**
     * Get metrics
     *
     * @return string
     */
    public function getMetrics()
    {
        return $this->metrics;
    }

    /**
     * Set setupInterval
     *
     * @param string $setupInterval
     *
     * @return self
     */
    protected function setSetupInterval($setupInterval)
    {
        Assertion::notNull($setupInterval, 'setupInterval value "%s" is null, but non null value was expected.');
        Assertion::maxLength($setupInterval, 64, 'setupInterval value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->setupInterval = $setupInterval;

        return $this;
    }

    /**
     * Get setupInterval
     *
     * @return string
     */
    public function getSetupInterval()
    {
        return $this->setupInterval;
    }

    /**
     * Set tors
     *
     * @param string $tors
     *
     * @return self
     */
    protected function setTors($tors)
    {
        Assertion::notNull($tors, 'tors value "%s" is null, but non null value was expected.');
        Assertion::maxLength($tors, 64, 'tors value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->tors = $tors;

        return $this;
    }

    /**
     * Get tors
     *
     * @return string
     */
    public function getTors()
    {
        return $this->tors;
    }

    /**
     * Set cdrHosts
     *
     * @param string $cdrHosts
     *
     * @return self
     */
    protected function setCdrHosts($cdrHosts)
    {
        Assertion::notNull($cdrHosts, 'cdrHosts value "%s" is null, but non null value was expected.');
        Assertion::maxLength($cdrHosts, 64, 'cdrHosts value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->cdrHosts = $cdrHosts;

        return $this;
    }

    /**
     * Get cdrHosts
     *
     * @return string
     */
    public function getCdrHosts()
    {
        return $this->cdrHosts;
    }

    /**
     * Set cdrSources
     *
     * @param string $cdrSources
     *
     * @return self
     */
    protected function setCdrSources($cdrSources)
    {
        Assertion::notNull($cdrSources, 'cdrSources value "%s" is null, but non null value was expected.');
        Assertion::maxLength($cdrSources, 64, 'cdrSources value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->cdrSources = $cdrSources;

        return $this;
    }

    /**
     * Get cdrSources
     *
     * @return string
     */
    public function getCdrSources()
    {
        return $this->cdrSources;
    }

    /**
     * Set reqTypes
     *
     * @param string $reqTypes
     *
     * @return self
     */
    protected function setReqTypes($reqTypes)
    {
        Assertion::notNull($reqTypes, 'reqTypes value "%s" is null, but non null value was expected.');
        Assertion::maxLength($reqTypes, 64, 'reqTypes value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->reqTypes = $reqTypes;

        return $this;
    }

    /**
     * Get reqTypes
     *
     * @return string
     */
    public function getReqTypes()
    {
        return $this->reqTypes;
    }

    /**
     * Set directions
     *
     * @param string $directions
     *
     * @return self
     */
    protected function setDirections($directions)
    {
        Assertion::notNull($directions, 'directions value "%s" is null, but non null value was expected.');
        Assertion::maxLength($directions, 8, 'directions value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->directions = $directions;

        return $this;
    }

    /**
     * Get directions
     *
     * @return string
     */
    public function getDirections()
    {
        return $this->directions;
    }

    /**
     * Set tenants
     *
     * @param string $tenants
     *
     * @return self
     */
    protected function setTenants($tenants)
    {
        Assertion::notNull($tenants, 'tenants value "%s" is null, but non null value was expected.');
        Assertion::maxLength($tenants, 64, 'tenants value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->tenants = $tenants;

        return $this;
    }

    /**
     * Get tenants
     *
     * @return string
     */
    public function getTenants()
    {
        return $this->tenants;
    }

    /**
     * Set categories
     *
     * @param string $categories
     *
     * @return self
     */
    protected function setCategories($categories)
    {
        Assertion::notNull($categories, 'categories value "%s" is null, but non null value was expected.');
        Assertion::maxLength($categories, 32, 'categories value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->categories = $categories;

        return $this;
    }

    /**
     * Get categories
     *
     * @return string
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Set accounts
     *
     * @param string $accounts
     *
     * @return self
     */
    protected function setAccounts($accounts)
    {
        Assertion::notNull($accounts, 'accounts value "%s" is null, but non null value was expected.');
        Assertion::maxLength($accounts, 32, 'accounts value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->accounts = $accounts;

        return $this;
    }

    /**
     * Get accounts
     *
     * @return string
     */
    public function getAccounts()
    {
        return $this->accounts;
    }

    /**
     * Set subjects
     *
     * @param string $subjects
     *
     * @return self
     */
    protected function setSubjects($subjects)
    {
        Assertion::notNull($subjects, 'subjects value "%s" is null, but non null value was expected.');
        Assertion::maxLength($subjects, 64, 'subjects value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->subjects = $subjects;

        return $this;
    }

    /**
     * Get subjects
     *
     * @return string
     */
    public function getSubjects()
    {
        return $this->subjects;
    }

    /**
     * Set destinationIds
     *
     * @param string $destinationIds
     *
     * @return self
     */
    protected function setDestinationIds($destinationIds)
    {
        Assertion::notNull($destinationIds, 'destinationIds value "%s" is null, but non null value was expected.');
        Assertion::maxLength($destinationIds, 64, 'destinationIds value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->destinationIds = $destinationIds;

        return $this;
    }

    /**
     * Get destinationIds
     *
     * @return string
     */
    public function getDestinationIds()
    {
        return $this->destinationIds;
    }

    /**
     * Set ppdInterval
     *
     * @param string $ppdInterval
     *
     * @return self
     */
    protected function setPpdInterval($ppdInterval)
    {
        Assertion::notNull($ppdInterval, 'ppdInterval value "%s" is null, but non null value was expected.');
        Assertion::maxLength($ppdInterval, 64, 'ppdInterval value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->ppdInterval = $ppdInterval;

        return $this;
    }

    /**
     * Get ppdInterval
     *
     * @return string
     */
    public function getPpdInterval()
    {
        return $this->ppdInterval;
    }

    /**
     * Set usageInterval
     *
     * @param string $usageInterval
     *
     * @return self
     */
    protected function setUsageInterval($usageInterval)
    {
        Assertion::notNull($usageInterval, 'usageInterval value "%s" is null, but non null value was expected.');
        Assertion::maxLength($usageInterval, 64, 'usageInterval value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->usageInterval = $usageInterval;

        return $this;
    }

    /**
     * Get usageInterval
     *
     * @return string
     */
    public function getUsageInterval()
    {
        return $this->usageInterval;
    }

    /**
     * Set suppliers
     *
     * @param string $suppliers
     *
     * @return self
     */
    protected function setSuppliers($suppliers)
    {
        Assertion::notNull($suppliers, 'suppliers value "%s" is null, but non null value was expected.');
        Assertion::maxLength($suppliers, 64, 'suppliers value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->suppliers = $suppliers;

        return $this;
    }

    /**
     * Get suppliers
     *
     * @return string
     */
    public function getSuppliers()
    {
        return $this->suppliers;
    }

    /**
     * Set disconnectCauses
     *
     * @param string $disconnectCauses
     *
     * @return self
     */
    protected function setDisconnectCauses($disconnectCauses)
    {
        Assertion::notNull($disconnectCauses, 'disconnectCauses value "%s" is null, but non null value was expected.');
        Assertion::maxLength($disconnectCauses, 64, 'disconnectCauses value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->disconnectCauses = $disconnectCauses;

        return $this;
    }

    /**
     * Get disconnectCauses
     *
     * @return string
     */
    public function getDisconnectCauses()
    {
        return $this->disconnectCauses;
    }

    /**
     * Set mediationRunids
     *
     * @param string $mediationRunids
     *
     * @return self
     */
    protected function setMediationRunids($mediationRunids)
    {
        Assertion::notNull($mediationRunids, 'mediationRunids value "%s" is null, but non null value was expected.');
        Assertion::maxLength($mediationRunids, 64, 'mediationRunids value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->mediationRunids = $mediationRunids;

        return $this;
    }

    /**
     * Get mediationRunids
     *
     * @return string
     */
    public function getMediationRunids()
    {
        return $this->mediationRunids;
    }

    /**
     * Set ratedAccounts
     *
     * @param string $ratedAccounts
     *
     * @return self
     */
    protected function setRatedAccounts($ratedAccounts)
    {
        Assertion::notNull($ratedAccounts, 'ratedAccounts value "%s" is null, but non null value was expected.');
        Assertion::maxLength($ratedAccounts, 32, 'ratedAccounts value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->ratedAccounts = $ratedAccounts;

        return $this;
    }

    /**
     * Get ratedAccounts
     *
     * @return string
     */
    public function getRatedAccounts()
    {
        return $this->ratedAccounts;
    }

    /**
     * Set ratedSubjects
     *
     * @param string $ratedSubjects
     *
     * @return self
     */
    protected function setRatedSubjects($ratedSubjects)
    {
        Assertion::notNull($ratedSubjects, 'ratedSubjects value "%s" is null, but non null value was expected.');
        Assertion::maxLength($ratedSubjects, 64, 'ratedSubjects value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->ratedSubjects = $ratedSubjects;

        return $this;
    }

    /**
     * Get ratedSubjects
     *
     * @return string
     */
    public function getRatedSubjects()
    {
        return $this->ratedSubjects;
    }

    /**
     * Set costInterval
     *
     * @param string $costInterval
     *
     * @return self
     */
    protected function setCostInterval($costInterval)
    {
        Assertion::notNull($costInterval, 'costInterval value "%s" is null, but non null value was expected.');
        Assertion::maxLength($costInterval, 24, 'costInterval value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->costInterval = $costInterval;

        return $this;
    }

    /**
     * Get costInterval
     *
     * @return string
     */
    public function getCostInterval()
    {
        return $this->costInterval;
    }

    /**
     * Set actionTriggers
     *
     * @param string $actionTriggers
     *
     * @return self
     */
    protected function setActionTriggers($actionTriggers)
    {
        Assertion::notNull($actionTriggers, 'actionTriggers value "%s" is null, but non null value was expected.');
        Assertion::maxLength($actionTriggers, 64, 'actionTriggers value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->actionTriggers = $actionTriggers;

        return $this;
    }

    /**
     * Get actionTriggers
     *
     * @return string
     */
    public function getActionTriggers()
    {
        return $this->actionTriggers;
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
        return $this->createdAt;
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
     * @return \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface
     */
    public function getCarrier()
    {
        return $this->carrier;
    }

    // @codeCoverageIgnoreEnd
}
