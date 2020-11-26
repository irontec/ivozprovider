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
     * @var \DateTimeInterface
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

    /**
     * @param string $tpid | null
     *
     * @return static
     */
    public function setTpid(?string $tpid = null): self
    {
        $this->tpid = $tpid;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getTpid(): ?string
    {
        return $this->tpid;
    }

    /**
     * @param string $tag | null
     *
     * @return static
     */
    public function setTag(?string $tag = null): self
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getTag(): ?string
    {
        return $this->tag;
    }

    /**
     * @param int $queueLength | null
     *
     * @return static
     */
    public function setQueueLength(?int $queueLength = null): self
    {
        $this->queueLength = $queueLength;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getQueueLength(): ?int
    {
        return $this->queueLength;
    }

    /**
     * @param string $timeWindow | null
     *
     * @return static
     */
    public function setTimeWindow(?string $timeWindow = null): self
    {
        $this->timeWindow = $timeWindow;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getTimeWindow(): ?string
    {
        return $this->timeWindow;
    }

    /**
     * @param string $saveInterval | null
     *
     * @return static
     */
    public function setSaveInterval(?string $saveInterval = null): self
    {
        $this->saveInterval = $saveInterval;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getSaveInterval(): ?string
    {
        return $this->saveInterval;
    }

    /**
     * @param string $metrics | null
     *
     * @return static
     */
    public function setMetrics(?string $metrics = null): self
    {
        $this->metrics = $metrics;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getMetrics(): ?string
    {
        return $this->metrics;
    }

    /**
     * @param string $setupInterval | null
     *
     * @return static
     */
    public function setSetupInterval(?string $setupInterval = null): self
    {
        $this->setupInterval = $setupInterval;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getSetupInterval(): ?string
    {
        return $this->setupInterval;
    }

    /**
     * @param string $tors | null
     *
     * @return static
     */
    public function setTors(?string $tors = null): self
    {
        $this->tors = $tors;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getTors(): ?string
    {
        return $this->tors;
    }

    /**
     * @param string $cdrHosts | null
     *
     * @return static
     */
    public function setCdrHosts(?string $cdrHosts = null): self
    {
        $this->cdrHosts = $cdrHosts;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getCdrHosts(): ?string
    {
        return $this->cdrHosts;
    }

    /**
     * @param string $cdrSources | null
     *
     * @return static
     */
    public function setCdrSources(?string $cdrSources = null): self
    {
        $this->cdrSources = $cdrSources;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getCdrSources(): ?string
    {
        return $this->cdrSources;
    }

    /**
     * @param string $reqTypes | null
     *
     * @return static
     */
    public function setReqTypes(?string $reqTypes = null): self
    {
        $this->reqTypes = $reqTypes;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getReqTypes(): ?string
    {
        return $this->reqTypes;
    }

    /**
     * @param string $directions | null
     *
     * @return static
     */
    public function setDirections(?string $directions = null): self
    {
        $this->directions = $directions;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDirections(): ?string
    {
        return $this->directions;
    }

    /**
     * @param string $tenants | null
     *
     * @return static
     */
    public function setTenants(?string $tenants = null): self
    {
        $this->tenants = $tenants;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getTenants(): ?string
    {
        return $this->tenants;
    }

    /**
     * @param string $categories | null
     *
     * @return static
     */
    public function setCategories(?string $categories = null): self
    {
        $this->categories = $categories;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getCategories(): ?string
    {
        return $this->categories;
    }

    /**
     * @param string $accounts | null
     *
     * @return static
     */
    public function setAccounts(?string $accounts = null): self
    {
        $this->accounts = $accounts;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getAccounts(): ?string
    {
        return $this->accounts;
    }

    /**
     * @param string $subjects | null
     *
     * @return static
     */
    public function setSubjects(?string $subjects = null): self
    {
        $this->subjects = $subjects;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getSubjects(): ?string
    {
        return $this->subjects;
    }

    /**
     * @param string $destinationIds | null
     *
     * @return static
     */
    public function setDestinationIds(?string $destinationIds = null): self
    {
        $this->destinationIds = $destinationIds;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDestinationIds(): ?string
    {
        return $this->destinationIds;
    }

    /**
     * @param string $ppdInterval | null
     *
     * @return static
     */
    public function setPpdInterval(?string $ppdInterval = null): self
    {
        $this->ppdInterval = $ppdInterval;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getPpdInterval(): ?string
    {
        return $this->ppdInterval;
    }

    /**
     * @param string $usageInterval | null
     *
     * @return static
     */
    public function setUsageInterval(?string $usageInterval = null): self
    {
        $this->usageInterval = $usageInterval;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getUsageInterval(): ?string
    {
        return $this->usageInterval;
    }

    /**
     * @param string $suppliers | null
     *
     * @return static
     */
    public function setSuppliers(?string $suppliers = null): self
    {
        $this->suppliers = $suppliers;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getSuppliers(): ?string
    {
        return $this->suppliers;
    }

    /**
     * @param string $disconnectCauses | null
     *
     * @return static
     */
    public function setDisconnectCauses(?string $disconnectCauses = null): self
    {
        $this->disconnectCauses = $disconnectCauses;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getDisconnectCauses(): ?string
    {
        return $this->disconnectCauses;
    }

    /**
     * @param string $mediationRunids | null
     *
     * @return static
     */
    public function setMediationRunids(?string $mediationRunids = null): self
    {
        $this->mediationRunids = $mediationRunids;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getMediationRunids(): ?string
    {
        return $this->mediationRunids;
    }

    /**
     * @param string $ratedAccounts | null
     *
     * @return static
     */
    public function setRatedAccounts(?string $ratedAccounts = null): self
    {
        $this->ratedAccounts = $ratedAccounts;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getRatedAccounts(): ?string
    {
        return $this->ratedAccounts;
    }

    /**
     * @param string $ratedSubjects | null
     *
     * @return static
     */
    public function setRatedSubjects(?string $ratedSubjects = null): self
    {
        $this->ratedSubjects = $ratedSubjects;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getRatedSubjects(): ?string
    {
        return $this->ratedSubjects;
    }

    /**
     * @param string $costInterval | null
     *
     * @return static
     */
    public function setCostInterval(?string $costInterval = null): self
    {
        $this->costInterval = $costInterval;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getCostInterval(): ?string
    {
        return $this->costInterval;
    }

    /**
     * @param string $actionTriggers | null
     *
     * @return static
     */
    public function setActionTriggers(?string $actionTriggers = null): self
    {
        $this->actionTriggers = $actionTriggers;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getActionTriggers(): ?string
    {
        return $this->actionTriggers;
    }

    /**
     * @param \DateTimeInterface $createdAt | null
     *
     * @return static
     */
    public function setCreatedAt($createdAt = null): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return \DateTimeInterface | null
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param int $id | null
     *
     * @return static
     */
    public function setId(?int $id = null): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param CarrierDto | null
     *
     * @return static
     */
    public function setCarrier(?CarrierDto $carrier = null): self
    {
        $this->carrier = $carrier;

        return $this;
    }

    /**
     * @return CarrierDto | null
     */
    public function getCarrier(): ?CarrierDto
    {
        return $this->carrier;
    }

    /**
     * @return static
     */
    public function setCarrierId($id): self
    {
        $value = !is_null($id)
            ? new CarrierDto($id)
            : null;

        return $this->setCarrier($value);
    }

    /**
     * @return mixed | null
     */
    public function getCarrierId()
    {
        if ($dto = $this->getCarrier()) {
            return $dto->getId();
        }

        return null;
    }

}
