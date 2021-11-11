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

    protected $tpid = 'ivozprovider';

    protected $tag;

    /**
     * column: queue_length
     */
    protected $queueLength = 0;

    /**
     * column: time_window
     */
    protected $timeWindow = '';

    /**
     * column: save_interval
     */
    protected $saveInterval = '';

    protected $metrics;

    /**
     * column: setup_interval
     */
    protected $setupInterval = '';

    protected $tors = '';

    /**
     * column: cdr_hosts
     */
    protected $cdrHosts = '';

    /**
     * column: cdr_sources
     */
    protected $cdrSources = '';

    /**
     * column: req_types
     */
    protected $reqTypes = '';

    protected $directions = '';

    protected $tenants = '';

    protected $categories = '';

    protected $accounts = '';

    protected $subjects = '';

    /**
     * column: destination_ids
     */
    protected $destinationIds = '';

    /**
     * column: ppd_interval
     */
    protected $ppdInterval = '';

    /**
     * column: usage_interval
     */
    protected $usageInterval = '';

    protected $suppliers = '';

    /**
     * column: disconnect_causes
     */
    protected $disconnectCauses = '';

    /**
     * column: mediation_runids
     */
    protected $mediationRunids = '';

    /**
     * column: rated_accounts
     */
    protected $ratedAccounts = '';

    /**
     * column: rated_subjects
     */
    protected $ratedSubjects = '';

    /**
     * column: cost_interval
     */
    protected $costInterval = '';

    /**
     * column: action_triggers
     */
    protected $actionTriggers = '';

    /**
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
            ->setCarrier($fkTransformer->transform($dto->getCarrier()));

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
            ->setCarrier($fkTransformer->transform($dto->getCarrier()));

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

    /**
     * @return \DateTime|\DateTimeImmutable
     */
    public function getCreatedAt(): \DateTimeInterface
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
