<?php

namespace Ivoz\Provider\Domain\Model\OutgoingDdiRulesPattern;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;
use Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleDto;
use Ivoz\Provider\Domain\Model\MatchList\MatchListDto;
use Ivoz\Provider\Domain\Model\Ddi\DdiDto;

/**
* OutgoingDdiRulesPatternDtoAbstract
* @codeCoverageIgnore
*/
abstract class OutgoingDdiRulesPatternDtoAbstract implements DataTransferObjectInterface
{
    use DtoNormalizer;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string | null
     */
    private $prefix;

    /**
     * @var string
     */
    private $action;

    /**
     * @var int
     */
    private $priority = 1;

    /**
     * @var int
     */
    private $id;

    /**
     * @var OutgoingDdiRuleDto | null
     */
    private $outgoingDdiRule;

    /**
     * @var MatchListDto | null
     */
    private $matchList;

    /**
     * @var DdiDto | null
     */
    private $forcedDdi;

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
            'type' => 'type',
            'prefix' => 'prefix',
            'action' => 'action',
            'priority' => 'priority',
            'id' => 'id',
            'outgoingDdiRuleId' => 'outgoingDdiRule',
            'matchListId' => 'matchList',
            'forcedDdiId' => 'forcedDdi'
        ];
    }

    /**
    * @return array
    */
    public function toArray($hideSensitiveData = false)
    {
        $response = [
            'type' => $this->getType(),
            'prefix' => $this->getPrefix(),
            'action' => $this->getAction(),
            'priority' => $this->getPriority(),
            'id' => $this->getId(),
            'outgoingDdiRule' => $this->getOutgoingDdiRule(),
            'matchList' => $this->getMatchList(),
            'forcedDdi' => $this->getForcedDdi()
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
     * @param string $type | null
     *
     * @return static
     */
    public function setType(?string $type = null): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string $prefix | null
     *
     * @return static
     */
    public function setPrefix(?string $prefix = null): self
    {
        $this->prefix = $prefix;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getPrefix(): ?string
    {
        return $this->prefix;
    }

    /**
     * @param string $action | null
     *
     * @return static
     */
    public function setAction(?string $action = null): self
    {
        $this->action = $action;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getAction(): ?string
    {
        return $this->action;
    }

    /**
     * @param int $priority | null
     *
     * @return static
     */
    public function setPriority(?int $priority = null): self
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getPriority(): ?int
    {
        return $this->priority;
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
     * @param OutgoingDdiRuleDto | null
     *
     * @return static
     */
    public function setOutgoingDdiRule(?OutgoingDdiRuleDto $outgoingDdiRule = null): self
    {
        $this->outgoingDdiRule = $outgoingDdiRule;

        return $this;
    }

    /**
     * @return OutgoingDdiRuleDto | null
     */
    public function getOutgoingDdiRule(): ?OutgoingDdiRuleDto
    {
        return $this->outgoingDdiRule;
    }

    /**
     * @return static
     */
    public function setOutgoingDdiRuleId($id): self
    {
        $value = !is_null($id)
            ? new OutgoingDdiRuleDto($id)
            : null;

        return $this->setOutgoingDdiRule($value);
    }

    /**
     * @return mixed | null
     */
    public function getOutgoingDdiRuleId()
    {
        if ($dto = $this->getOutgoingDdiRule()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param MatchListDto | null
     *
     * @return static
     */
    public function setMatchList(?MatchListDto $matchList = null): self
    {
        $this->matchList = $matchList;

        return $this;
    }

    /**
     * @return MatchListDto | null
     */
    public function getMatchList(): ?MatchListDto
    {
        return $this->matchList;
    }

    /**
     * @return static
     */
    public function setMatchListId($id): self
    {
        $value = !is_null($id)
            ? new MatchListDto($id)
            : null;

        return $this->setMatchList($value);
    }

    /**
     * @return mixed | null
     */
    public function getMatchListId()
    {
        if ($dto = $this->getMatchList()) {
            return $dto->getId();
        }

        return null;
    }

    /**
     * @param DdiDto | null
     *
     * @return static
     */
    public function setForcedDdi(?DdiDto $forcedDdi = null): self
    {
        $this->forcedDdi = $forcedDdi;

        return $this;
    }

    /**
     * @return DdiDto | null
     */
    public function getForcedDdi(): ?DdiDto
    {
        return $this->forcedDdi;
    }

    /**
     * @return static
     */
    public function setForcedDdiId($id): self
    {
        $value = !is_null($id)
            ? new DdiDto($id)
            : null;

        return $this->setForcedDdi($value);
    }

    /**
     * @return mixed | null
     */
    public function getForcedDdiId()
    {
        if ($dto = $this->getForcedDdi()) {
            return $dto->getId();
        }

        return null;
    }

}
