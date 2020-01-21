<?php

namespace Ivoz\Provider\Domain\Model\OutgoingDdiRulesPattern;

use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Application\Model\DtoNormalizer;

/**
 * @codeCoverageIgnore
 */
abstract class OutgoingDdiRulesPatternDtoAbstract implements DataTransferObjectInterface
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $prefix;

    /**
     * @var string
     */
    private $action;

    /**
     * @var integer
     */
    private $priority = 1;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleDto | null
     */
    private $outgoingDdiRule;

    /**
     * @var \Ivoz\Provider\Domain\Model\MatchList\MatchListDto | null
     */
    private $matchList;

    /**
     * @var \Ivoz\Provider\Domain\Model\Ddi\DdiDto | null
     */
    private $forcedDdi;


    use DtoNormalizer;

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
        return [
            'type' => $this->getType(),
            'prefix' => $this->getPrefix(),
            'action' => $this->getAction(),
            'priority' => $this->getPriority(),
            'id' => $this->getId(),
            'outgoingDdiRule' => $this->getOutgoingDdiRule(),
            'matchList' => $this->getMatchList(),
            'forcedDdi' => $this->getForcedDdi()
        ];
    }

    /**
     * @param string $type
     *
     * @return static
     */
    public function setType($type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $prefix
     *
     * @return static
     */
    public function setPrefix($prefix = null)
    {
        $this->prefix = $prefix;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * @param string $action
     *
     * @return static
     */
    public function setAction($action = null)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * @return string | null
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param integer $priority
     *
     * @return static
     */
    public function setPriority($priority = null)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * @return integer | null
     */
    public function getPriority()
    {
        return $this->priority;
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
     * @return integer | null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param \Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleDto $outgoingDdiRule
     *
     * @return static
     */
    public function setOutgoingDdiRule(\Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleDto $outgoingDdiRule = null)
    {
        $this->outgoingDdiRule = $outgoingDdiRule;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleDto | null
     */
    public function getOutgoingDdiRule()
    {
        return $this->outgoingDdiRule;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setOutgoingDdiRuleId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleDto($id)
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
     * @param \Ivoz\Provider\Domain\Model\MatchList\MatchListDto $matchList
     *
     * @return static
     */
    public function setMatchList(\Ivoz\Provider\Domain\Model\MatchList\MatchListDto $matchList = null)
    {
        $this->matchList = $matchList;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\MatchList\MatchListDto | null
     */
    public function getMatchList()
    {
        return $this->matchList;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setMatchListId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\MatchList\MatchListDto($id)
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
     * @param \Ivoz\Provider\Domain\Model\Ddi\DdiDto $forcedDdi
     *
     * @return static
     */
    public function setForcedDdi(\Ivoz\Provider\Domain\Model\Ddi\DdiDto $forcedDdi = null)
    {
        $this->forcedDdi = $forcedDdi;

        return $this;
    }

    /**
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiDto | null
     */
    public function getForcedDdi()
    {
        return $this->forcedDdi;
    }

    /**
     * @param mixed | null $id
     *
     * @return static
     */
    public function setForcedDdiId($id)
    {
        $value = !is_null($id)
            ? new \Ivoz\Provider\Domain\Model\Ddi\DdiDto($id)
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
