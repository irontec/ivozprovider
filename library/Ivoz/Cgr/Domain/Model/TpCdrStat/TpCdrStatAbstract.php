<?php

declare(strict_types=1);

namespace Ivoz\Cgr\Domain\Model\TpCdrStat;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Core\Domain\Model\Helper\DateTimeHelper;
use Ivoz\Provider\Domain\Model\Carrier\CarrierInterface;
use Ivoz\Provider\Domain\Model\Carrier\Carrier;

/**
* TpCdrStatAbstract
* @codeCoverageIgnore
*/
abstract class TpCdrStatAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     */
    protected $tpid = 'ivozprovider';

    /**
     * @var string
     */
    protected $tag;

    /**
     * @var int
     * column: queue_length
     */
    protected $queueLength = 0;

    /**
     * @var string
     * column: time_window
     */
    protected $timeWindow = '';

    /**
     * @var string
     * column: save_interval
     */
    protected $saveInterval = '';

    /**
     * @var string
     */
    protected $metrics;

    /**
     * @var string
     * column: setup_interval
     */
    protected $setupInterval = '';

    /**
     * @var string
     */
    protected $tors = '';

    /**
     * @var string
     * column: cdr_hosts
     */
    protected $cdrHosts = '';

    /**
     * @var string
     * column: cdr_sources
     */
    protected $cdrSources = '';

    /**
     * @var string
     * column: req_types
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
     * @var string
     * column: destination_ids
     */
    protected $destinationIds = '';

    /**
     * @var string
     * column: ppd_interval
     */
    protected $ppdInterval = '';

    /**
     * @var string
     * column: usage_interval
     */
    protected $usageInterval = '';

    /**
     * @var string
     */
    protected $suppliers = '';

    /**
     * @var string
     * column: disconnect_causes
     */
    protected $disconnectCauses = '';

    /**
     * @var string
     * column: mediation_runids
     */
    protected $mediationRunids = '';

    /**
     * @var string
     * column: rated_accounts
     */
    protected $ratedAccounts = '';

    /**
     * @var string
     * column: rated_subjects
     */
    protected $ratedSubjects = '';

    /**
     * @var string
     * column: cost_interval
     */
    protected $costInterval = '';

    /**
     * @var string
     * column: action_triggers
     */
    protected $actionTriggers = '';

    /**
     * @var \DateTime
     * column: created_at
     */
    protected $createdAt;

    /**
     * @var CarrierInterface
     * inversedBy tpCdrStats
     */
    protected $carrier;

    /**
     * Constructor
     */
    protected function __construct(
        string $tpid,
        string $tag,
        int $queueLength,
        string $timeWindow,
        string $saveInterval,
        string $metrics,
        string $setupInterval,
        string $tors,
        string $cdrHosts,
        string $cdrSources,
        string $reqTypes,
        string $directions,
        string $tenants,
        string $categories,
        string $accounts,
        string $subjects,
        string $destinationIds,
        string $ppdInterval,
        string $usageInterval,
        string $suppliers,
        string $disconnectCauses,
        string $mediationRunids,
        string $ratedAccounts,
        string $ratedSubjects,
        string $costInterval,
        string $actionTriggers,
        \DateTimeInterface|string $createdAt
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

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "TpCdrStat",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): TpCdrStatDto
    {
        return new TpCdrStatDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|TpCdrStatInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?TpCdrStatDto
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

        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param TpCdrStatDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, TpCdrStatDto::class);
        $tpid = $dto->getTpid();
        Assertion::notNull($tpid, 'getTpid value is null, but non null value was expected.');
        $tag = $dto->getTag();
        Assertion::notNull($tag, 'getTag value is null, but non null value was expected.');
        $queueLength = $dto->getQueueLength();
        Assertion::notNull($queueLength, 'getQueueLength value is null, but non null value was expected.');
        $timeWindow = $dto->getTimeWindow();
        Assertion::notNull($timeWindow, 'getTimeWindow value is null, but non null value was expected.');
        $saveInterval = $dto->getSaveInterval();
        Assertion::notNull($saveInterval, 'getSaveInterval value is null, but non null value was expected.');
        $metrics = $dto->getMetrics();
        Assertion::notNull($metrics, 'getMetrics value is null, but non null value was expected.');
        $setupInterval = $dto->getSetupInterval();
        Assertion::notNull($setupInterval, 'getSetupInterval value is null, but non null value was expected.');
        $tors = $dto->getTors();
        Assertion::notNull($tors, 'getTors value is null, but non null value was expected.');
        $cdrHosts = $dto->getCdrHosts();
        Assertion::notNull($cdrHosts, 'getCdrHosts value is null, but non null value was expected.');
        $cdrSources = $dto->getCdrSources();
        Assertion::notNull($cdrSources, 'getCdrSources value is null, but non null value was expected.');
        $reqTypes = $dto->getReqTypes();
        Assertion::notNull($reqTypes, 'getReqTypes value is null, but non null value was expected.');
        $directions = $dto->getDirections();
        Assertion::notNull($directions, 'getDirections value is null, but non null value was expected.');
        $tenants = $dto->getTenants();
        Assertion::notNull($tenants, 'getTenants value is null, but non null value was expected.');
        $categories = $dto->getCategories();
        Assertion::notNull($categories, 'getCategories value is null, but non null value was expected.');
        $accounts = $dto->getAccounts();
        Assertion::notNull($accounts, 'getAccounts value is null, but non null value was expected.');
        $subjects = $dto->getSubjects();
        Assertion::notNull($subjects, 'getSubjects value is null, but non null value was expected.');
        $destinationIds = $dto->getDestinationIds();
        Assertion::notNull($destinationIds, 'getDestinationIds value is null, but non null value was expected.');
        $ppdInterval = $dto->getPpdInterval();
        Assertion::notNull($ppdInterval, 'getPpdInterval value is null, but non null value was expected.');
        $usageInterval = $dto->getUsageInterval();
        Assertion::notNull($usageInterval, 'getUsageInterval value is null, but non null value was expected.');
        $suppliers = $dto->getSuppliers();
        Assertion::notNull($suppliers, 'getSuppliers value is null, but non null value was expected.');
        $disconnectCauses = $dto->getDisconnectCauses();
        Assertion::notNull($disconnectCauses, 'getDisconnectCauses value is null, but non null value was expected.');
        $mediationRunids = $dto->getMediationRunids();
        Assertion::notNull($mediationRunids, 'getMediationRunids value is null, but non null value was expected.');
        $ratedAccounts = $dto->getRatedAccounts();
        Assertion::notNull($ratedAccounts, 'getRatedAccounts value is null, but non null value was expected.');
        $ratedSubjects = $dto->getRatedSubjects();
        Assertion::notNull($ratedSubjects, 'getRatedSubjects value is null, but non null value was expected.');
        $costInterval = $dto->getCostInterval();
        Assertion::notNull($costInterval, 'getCostInterval value is null, but non null value was expected.');
        $actionTriggers = $dto->getActionTriggers();
        Assertion::notNull($actionTriggers, 'getActionTriggers value is null, but non null value was expected.');
        $createdAt = $dto->getCreatedAt();
        Assertion::notNull($createdAt, 'getCreatedAt value is null, but non null value was expected.');
        $carrier = $dto->getCarrier();
        Assertion::notNull($carrier, 'getCarrier value is null, but non null value was expected.');

        $self = new static(
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
        );

        $self
            ->setCarrier($fkTransformer->transform($carrier));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param TpCdrStatDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, TpCdrStatDto::class);

        $tpid = $dto->getTpid();
        Assertion::notNull($tpid, 'getTpid value is null, but non null value was expected.');
        $tag = $dto->getTag();
        Assertion::notNull($tag, 'getTag value is null, but non null value was expected.');
        $queueLength = $dto->getQueueLength();
        Assertion::notNull($queueLength, 'getQueueLength value is null, but non null value was expected.');
        $timeWindow = $dto->getTimeWindow();
        Assertion::notNull($timeWindow, 'getTimeWindow value is null, but non null value was expected.');
        $saveInterval = $dto->getSaveInterval();
        Assertion::notNull($saveInterval, 'getSaveInterval value is null, but non null value was expected.');
        $metrics = $dto->getMetrics();
        Assertion::notNull($metrics, 'getMetrics value is null, but non null value was expected.');
        $setupInterval = $dto->getSetupInterval();
        Assertion::notNull($setupInterval, 'getSetupInterval value is null, but non null value was expected.');
        $tors = $dto->getTors();
        Assertion::notNull($tors, 'getTors value is null, but non null value was expected.');
        $cdrHosts = $dto->getCdrHosts();
        Assertion::notNull($cdrHosts, 'getCdrHosts value is null, but non null value was expected.');
        $cdrSources = $dto->getCdrSources();
        Assertion::notNull($cdrSources, 'getCdrSources value is null, but non null value was expected.');
        $reqTypes = $dto->getReqTypes();
        Assertion::notNull($reqTypes, 'getReqTypes value is null, but non null value was expected.');
        $directions = $dto->getDirections();
        Assertion::notNull($directions, 'getDirections value is null, but non null value was expected.');
        $tenants = $dto->getTenants();
        Assertion::notNull($tenants, 'getTenants value is null, but non null value was expected.');
        $categories = $dto->getCategories();
        Assertion::notNull($categories, 'getCategories value is null, but non null value was expected.');
        $accounts = $dto->getAccounts();
        Assertion::notNull($accounts, 'getAccounts value is null, but non null value was expected.');
        $subjects = $dto->getSubjects();
        Assertion::notNull($subjects, 'getSubjects value is null, but non null value was expected.');
        $destinationIds = $dto->getDestinationIds();
        Assertion::notNull($destinationIds, 'getDestinationIds value is null, but non null value was expected.');
        $ppdInterval = $dto->getPpdInterval();
        Assertion::notNull($ppdInterval, 'getPpdInterval value is null, but non null value was expected.');
        $usageInterval = $dto->getUsageInterval();
        Assertion::notNull($usageInterval, 'getUsageInterval value is null, but non null value was expected.');
        $suppliers = $dto->getSuppliers();
        Assertion::notNull($suppliers, 'getSuppliers value is null, but non null value was expected.');
        $disconnectCauses = $dto->getDisconnectCauses();
        Assertion::notNull($disconnectCauses, 'getDisconnectCauses value is null, but non null value was expected.');
        $mediationRunids = $dto->getMediationRunids();
        Assertion::notNull($mediationRunids, 'getMediationRunids value is null, but non null value was expected.');
        $ratedAccounts = $dto->getRatedAccounts();
        Assertion::notNull($ratedAccounts, 'getRatedAccounts value is null, but non null value was expected.');
        $ratedSubjects = $dto->getRatedSubjects();
        Assertion::notNull($ratedSubjects, 'getRatedSubjects value is null, but non null value was expected.');
        $costInterval = $dto->getCostInterval();
        Assertion::notNull($costInterval, 'getCostInterval value is null, but non null value was expected.');
        $actionTriggers = $dto->getActionTriggers();
        Assertion::notNull($actionTriggers, 'getActionTriggers value is null, but non null value was expected.');
        $createdAt = $dto->getCreatedAt();
        Assertion::notNull($createdAt, 'getCreatedAt value is null, but non null value was expected.');
        $carrier = $dto->getCarrier();
        Assertion::notNull($carrier, 'getCarrier value is null, but non null value was expected.');

        $this
            ->setTpid($tpid)
            ->setTag($tag)
            ->setQueueLength($queueLength)
            ->setTimeWindow($timeWindow)
            ->setSaveInterval($saveInterval)
            ->setMetrics($metrics)
            ->setSetupInterval($setupInterval)
            ->setTors($tors)
            ->setCdrHosts($cdrHosts)
            ->setCdrSources($cdrSources)
            ->setReqTypes($reqTypes)
            ->setDirections($directions)
            ->setTenants($tenants)
            ->setCategories($categories)
            ->setAccounts($accounts)
            ->setSubjects($subjects)
            ->setDestinationIds($destinationIds)
            ->setPpdInterval($ppdInterval)
            ->setUsageInterval($usageInterval)
            ->setSuppliers($suppliers)
            ->setDisconnectCauses($disconnectCauses)
            ->setMediationRunids($mediationRunids)
            ->setRatedAccounts($ratedAccounts)
            ->setRatedSubjects($ratedSubjects)
            ->setCostInterval($costInterval)
            ->setActionTriggers($actionTriggers)
            ->setCreatedAt($createdAt)
            ->setCarrier($fkTransformer->transform($carrier));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): TpCdrStatDto
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
            ->setCarrier(Carrier::entityToDto(self::getCarrier(), $depth));
    }

    /**
     * @return array<string, mixed>
     */
    protected function __toArray(): array
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
            'carrierId' => self::getCarrier()->getId()
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

    protected function setTag(string $tag): static
    {
        Assertion::maxLength($tag, 64, 'tag value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->tag = $tag;

        return $this;
    }

    public function getTag(): string
    {
        return $this->tag;
    }

    protected function setQueueLength(int $queueLength): static
    {
        $this->queueLength = $queueLength;

        return $this;
    }

    public function getQueueLength(): int
    {
        return $this->queueLength;
    }

    protected function setTimeWindow(string $timeWindow): static
    {
        Assertion::maxLength($timeWindow, 8, 'timeWindow value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->timeWindow = $timeWindow;

        return $this;
    }

    public function getTimeWindow(): string
    {
        return $this->timeWindow;
    }

    protected function setSaveInterval(string $saveInterval): static
    {
        Assertion::maxLength($saveInterval, 8, 'saveInterval value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->saveInterval = $saveInterval;

        return $this;
    }

    public function getSaveInterval(): string
    {
        return $this->saveInterval;
    }

    protected function setMetrics(string $metrics): static
    {
        Assertion::maxLength($metrics, 64, 'metrics value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->metrics = $metrics;

        return $this;
    }

    public function getMetrics(): string
    {
        return $this->metrics;
    }

    protected function setSetupInterval(string $setupInterval): static
    {
        Assertion::maxLength($setupInterval, 64, 'setupInterval value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->setupInterval = $setupInterval;

        return $this;
    }

    public function getSetupInterval(): string
    {
        return $this->setupInterval;
    }

    protected function setTors(string $tors): static
    {
        Assertion::maxLength($tors, 64, 'tors value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->tors = $tors;

        return $this;
    }

    public function getTors(): string
    {
        return $this->tors;
    }

    protected function setCdrHosts(string $cdrHosts): static
    {
        Assertion::maxLength($cdrHosts, 64, 'cdrHosts value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->cdrHosts = $cdrHosts;

        return $this;
    }

    public function getCdrHosts(): string
    {
        return $this->cdrHosts;
    }

    protected function setCdrSources(string $cdrSources): static
    {
        Assertion::maxLength($cdrSources, 64, 'cdrSources value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->cdrSources = $cdrSources;

        return $this;
    }

    public function getCdrSources(): string
    {
        return $this->cdrSources;
    }

    protected function setReqTypes(string $reqTypes): static
    {
        Assertion::maxLength($reqTypes, 64, 'reqTypes value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->reqTypes = $reqTypes;

        return $this;
    }

    public function getReqTypes(): string
    {
        return $this->reqTypes;
    }

    protected function setDirections(string $directions): static
    {
        Assertion::maxLength($directions, 8, 'directions value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->directions = $directions;

        return $this;
    }

    public function getDirections(): string
    {
        return $this->directions;
    }

    protected function setTenants(string $tenants): static
    {
        Assertion::maxLength($tenants, 64, 'tenants value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->tenants = $tenants;

        return $this;
    }

    public function getTenants(): string
    {
        return $this->tenants;
    }

    protected function setCategories(string $categories): static
    {
        Assertion::maxLength($categories, 32, 'categories value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->categories = $categories;

        return $this;
    }

    public function getCategories(): string
    {
        return $this->categories;
    }

    protected function setAccounts(string $accounts): static
    {
        Assertion::maxLength($accounts, 32, 'accounts value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->accounts = $accounts;

        return $this;
    }

    public function getAccounts(): string
    {
        return $this->accounts;
    }

    protected function setSubjects(string $subjects): static
    {
        Assertion::maxLength($subjects, 64, 'subjects value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->subjects = $subjects;

        return $this;
    }

    public function getSubjects(): string
    {
        return $this->subjects;
    }

    protected function setDestinationIds(string $destinationIds): static
    {
        Assertion::maxLength($destinationIds, 64, 'destinationIds value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->destinationIds = $destinationIds;

        return $this;
    }

    public function getDestinationIds(): string
    {
        return $this->destinationIds;
    }

    protected function setPpdInterval(string $ppdInterval): static
    {
        Assertion::maxLength($ppdInterval, 64, 'ppdInterval value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->ppdInterval = $ppdInterval;

        return $this;
    }

    public function getPpdInterval(): string
    {
        return $this->ppdInterval;
    }

    protected function setUsageInterval(string $usageInterval): static
    {
        Assertion::maxLength($usageInterval, 64, 'usageInterval value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->usageInterval = $usageInterval;

        return $this;
    }

    public function getUsageInterval(): string
    {
        return $this->usageInterval;
    }

    protected function setSuppliers(string $suppliers): static
    {
        Assertion::maxLength($suppliers, 64, 'suppliers value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->suppliers = $suppliers;

        return $this;
    }

    public function getSuppliers(): string
    {
        return $this->suppliers;
    }

    protected function setDisconnectCauses(string $disconnectCauses): static
    {
        Assertion::maxLength($disconnectCauses, 64, 'disconnectCauses value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->disconnectCauses = $disconnectCauses;

        return $this;
    }

    public function getDisconnectCauses(): string
    {
        return $this->disconnectCauses;
    }

    protected function setMediationRunids(string $mediationRunids): static
    {
        Assertion::maxLength($mediationRunids, 64, 'mediationRunids value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->mediationRunids = $mediationRunids;

        return $this;
    }

    public function getMediationRunids(): string
    {
        return $this->mediationRunids;
    }

    protected function setRatedAccounts(string $ratedAccounts): static
    {
        Assertion::maxLength($ratedAccounts, 32, 'ratedAccounts value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->ratedAccounts = $ratedAccounts;

        return $this;
    }

    public function getRatedAccounts(): string
    {
        return $this->ratedAccounts;
    }

    protected function setRatedSubjects(string $ratedSubjects): static
    {
        Assertion::maxLength($ratedSubjects, 64, 'ratedSubjects value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->ratedSubjects = $ratedSubjects;

        return $this;
    }

    public function getRatedSubjects(): string
    {
        return $this->ratedSubjects;
    }

    protected function setCostInterval(string $costInterval): static
    {
        Assertion::maxLength($costInterval, 24, 'costInterval value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->costInterval = $costInterval;

        return $this;
    }

    public function getCostInterval(): string
    {
        return $this->costInterval;
    }

    protected function setActionTriggers(string $actionTriggers): static
    {
        Assertion::maxLength($actionTriggers, 64, 'actionTriggers value "%s" is too long, it should have no more than %d characters, but has %d characters.');

        $this->actionTriggers = $actionTriggers;

        return $this;
    }

    public function getActionTriggers(): string
    {
        return $this->actionTriggers;
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

    public function setCarrier(CarrierInterface $carrier): static
    {
        $this->carrier = $carrier;

        return $this;
    }

    public function getCarrier(): CarrierInterface
    {
        return $this->carrier;
    }
}
