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
    public static function getPropertyMap(string $context = '')
    {
        if ($context === self::CONTEXT_COLLECTION) {
            return ['id' => 'id'];
        }

        return [
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
            'action' => $this->getAction(),
            'priority' => $this->getPriority(),
            'id' => $this->getId(),
            'outgoingDdiRule' => $this->getOutgoingDdiRule(),
            'matchList' => $this->getMatchList(),
            'forcedDdi' => $this->getForcedDdi()
        ];
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
     * @return string
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
     * @return integer
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
     * @return integer
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
     * @return \Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleDto
     */
    public function getOutgoingDdiRule()
    {
        return $this->outgoingDdiRule;
    }

    /**
     * @param integer $id | null
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
     * @return integer | null
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
     * @return \Ivoz\Provider\Domain\Model\MatchList\MatchListDto
     */
    public function getMatchList()
    {
        return $this->matchList;
    }

    /**
     * @param integer $id | null
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
     * @return integer | null
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
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiDto
     */
    public function getForcedDdi()
    {
        return $this->forcedDdi;
    }

    /**
     * @param integer $id | null
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
     * @return integer | null
     */
    public function getForcedDdiId()
    {
        if ($dto = $this->getForcedDdi()) {
            return $dto->getId();
        }

        return null;
    }
}
