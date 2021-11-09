<?php

namespace Ivoz\Cgr\Domain\Model\TpCdrStat;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\Carrier\CarrierDto;

/**
* TpCdrStatDtoAbstract
* @codeCoverageIgnore
*/
abstract class TpCdrStatDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string
     */
    private $tpid = 'ivozprovider';

    /**
     * @var string
     */
    private $tag;

    /**
     * @var int
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
     * @var \DateTimeInterface|string
     */
    private $createdAt = 'CURRENT_TIMESTAMP';

    /**
     * @var int
     */
    private $id;

    /**
     * @var CarrierDto | null
     */
    private $carrier;

    public function __construct($id = null)
    {
        $this->setId($id);
    }

    /**
    * @inheritdoc
    */
    public static function getPropertyMap(string $context = '', string $role = null)
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
        $response = [
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

        if (!$hideSensitiveData) {
            return $response;
        }

        foreach ($this->sensitiveFields as $sensitiveField) {
            if (!array_key_exists($sensitiveField, $response)) {
                throw new \Exception($sensitiveField . ' field was not found');
            }
            $response[$sensitiveField] = '*****';
        }

        return $response;
    }

    public function setTpid(string $tpid): static
    {
        $this->tpid = $tpid;

        return $this;
    }

    public function getTpid(): ?string
    {
        return $this->tpid;
    }

    public function setTag(string $tag): static
    {
        $this->tag = $tag;

        return $this;
    }

    public function getTag(): ?string
    {
        return $this->tag;
    }

    public function setQueueLength(int $queueLength): static
    {
        $this->queueLength = $queueLength;

        return $this;
    }

    public function getQueueLength(): ?int
    {
        return $this->queueLength;
    }

    public function setTimeWindow(string $timeWindow): static
    {
        $this->timeWindow = $timeWindow;

        return $this;
    }

    public function getTimeWindow(): ?string
    {
        return $this->timeWindow;
    }

    public function setSaveInterval(string $saveInterval): static
    {
        $this->saveInterval = $saveInterval;

        return $this;
    }

    public function getSaveInterval(): ?string
    {
        return $this->saveInterval;
    }

    public function setMetrics(string $metrics): static
    {
        $this->metrics = $metrics;

        return $this;
    }

    public function getMetrics(): ?string
    {
        return $this->metrics;
    }

    public function setSetupInterval(string $setupInterval): static
    {
        $this->setupInterval = $setupInterval;

        return $this;
    }

    public function getSetupInterval(): ?string
    {
        return $this->setupInterval;
    }

    public function setTors(string $tors): static
    {
        $this->tors = $tors;

        return $this;
    }

    public function getTors(): ?string
    {
        return $this->tors;
    }

    public function setCdrHosts(string $cdrHosts): static
    {
        $this->cdrHosts = $cdrHosts;

        return $this;
    }

    public function getCdrHosts(): ?string
    {
        return $this->cdrHosts;
    }

    public function setCdrSources(string $cdrSources): static
    {
        $this->cdrSources = $cdrSources;

        return $this;
    }

    public function getCdrSources(): ?string
    {
        return $this->cdrSources;
    }

    public function setReqTypes(string $reqTypes): static
    {
        $this->reqTypes = $reqTypes;

        return $this;
    }

    public function getReqTypes(): ?string
    {
        return $this->reqTypes;
    }

    public function setDirections(string $directions): static
    {
        $this->directions = $directions;

        return $this;
    }

    public function getDirections(): ?string
    {
        return $this->directions;
    }

    public function setTenants(string $tenants): static
    {
        $this->tenants = $tenants;

        return $this;
    }

    public function getTenants(): ?string
    {
        return $this->tenants;
    }

    public function setCategories(string $categories): static
    {
        $this->categories = $categories;

        return $this;
    }

    public function getCategories(): ?string
    {
        return $this->categories;
    }

    public function setAccounts(string $accounts): static
    {
        $this->accounts = $accounts;

        return $this;
    }

    public function getAccounts(): ?string
    {
        return $this->accounts;
    }

    public function setSubjects(string $subjects): static
    {
        $this->subjects = $subjects;

        return $this;
    }

    public function getSubjects(): ?string
    {
        return $this->subjects;
    }

    public function setDestinationIds(string $destinationIds): static
    {
        $this->destinationIds = $destinationIds;

        return $this;
    }

    public function getDestinationIds(): ?string
    {
        return $this->destinationIds;
    }

    public function setPpdInterval(string $ppdInterval): static
    {
        $this->ppdInterval = $ppdInterval;

        return $this;
    }

    public function getPpdInterval(): ?string
    {
        return $this->ppdInterval;
    }

    public function setUsageInterval(string $usageInterval): static
    {
        $this->usageInterval = $usageInterval;

        return $this;
    }

    public function getUsageInterval(): ?string
    {
        return $this->usageInterval;
    }

    public function setSuppliers(string $suppliers): static
    {
        $this->suppliers = $suppliers;

        return $this;
    }

    public function getSuppliers(): ?string
    {
        return $this->suppliers;
    }

    public function setDisconnectCauses(string $disconnectCauses): static
    {
        $this->disconnectCauses = $disconnectCauses;

        return $this;
    }

    public function getDisconnectCauses(): ?string
    {
        return $this->disconnectCauses;
    }

    public function setMediationRunids(string $mediationRunids): static
    {
        $this->mediationRunids = $mediationRunids;

        return $this;
    }

    public function getMediationRunids(): ?string
    {
        return $this->mediationRunids;
    }

    public function setRatedAccounts(string $ratedAccounts): static
    {
        $this->ratedAccounts = $ratedAccounts;

        return $this;
    }

    public function getRatedAccounts(): ?string
    {
        return $this->ratedAccounts;
    }

    public function setRatedSubjects(string $ratedSubjects): static
    {
        $this->ratedSubjects = $ratedSubjects;

        return $this;
    }

    public function getRatedSubjects(): ?string
    {
        return $this->ratedSubjects;
    }

    public function setCostInterval(string $costInterval): static
    {
        $this->costInterval = $costInterval;

        return $this;
    }

    public function getCostInterval(): ?string
    {
        return $this->costInterval;
    }

    public function setActionTriggers(string $actionTriggers): static
    {
        $this->actionTriggers = $actionTriggers;

        return $this;
    }

    public function getActionTriggers(): ?string
    {
        return $this->actionTriggers;
    }

    public function setCreatedAt(\DateTimeInterface|string $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCreatedAt(): \DateTimeInterface|string|null
    {
        return $this->createdAt;
    }

    public function setId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setCarrier(?CarrierDto $carrier): static
    {
        $this->carrier = $carrier;

        return $this;
    }

    public function getCarrier(): ?CarrierDto
    {
        return $this->carrier;
    }

    public function setCarrierId($id): static
    {
        $value = !is_null($id)
            ? new CarrierDto($id)
            : null;

        return $this->setCarrier($value);
    }

    public function getCarrierId()
    {
        if ($dto = $this->getCarrier()) {
            return $dto->getId();
        }

        return null;
    }
}
