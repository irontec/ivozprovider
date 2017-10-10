<?php

namespace Ivoz\Provider\Domain\Model\OutgoingDdiRulesPattern;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;

/**
 * OutgoingDdiRulesPatternAbstract
 * @codeCoverageIgnore
 */
abstract class OutgoingDdiRulesPatternAbstract
{
    /**
     * @comment enum:keep|force
     * @var string
     */
    protected $action;

    /**
     * @var integer
     */
    protected $priority = '1';

    /**
     * @var \Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleInterface
     */
    protected $outgoingDdiRule;

    /**
     * @var \Ivoz\Provider\Domain\Model\MatchList\MatchListInterface
     */
    protected $matchList;

    /**
     * @var \Ivoz\Provider\Domain\Model\Ddi\DdiInterface
     */
    protected $forcedDdi;


    /**
     * Changelog tracking purpose
     * @var array
     */
    protected $_initialValues = [];

    /**
     * Constructor
     */
    public function __construct($action, $priority)
    {
        $this->setAction($action);
        $this->setPriority($priority);

        $this->initChangelog();
    }

    /**
     * @param string $fieldName
     * @return mixed
     * @throws \Exception
     */
    public function initChangelog()
    {
        $values = $this->__toArray();
        if (!$this->getId()) {
            // Empty values for entities with no Id
            foreach ($values as $key => $val) {
                $values[$key] = null;
            }
        }

        $this->_initialValues = $values;
    }

    /**
     * @param string $fieldName
     * @return mixed
     * @throws \Exception
     */
    public function hasChanged($fieldName)
    {
        if (!array_key_exists($fieldName, $this->_initialValues)) {
            throw new \Exception($fieldName . ' field was not found');
        }
        $currentValues = $this->__toArray();

        return $currentValues[$fieldName] != $this->_initialValues[$fieldName];
    }

    public function getInitialValue($fieldName)
    {
        if (!array_key_exists($fieldName, $this->_initialValues)) {
            throw new \Exception($fieldName . ' field was not found');
        }

        return $this->_initialValues[$fieldName];
    }

    /**
     * @return OutgoingDdiRulesPatternDTO
     */
    public static function createDTO()
    {
        return new OutgoingDdiRulesPatternDTO();
    }

    /**
     * Factory method
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public static function fromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto OutgoingDdiRulesPatternDTO
         */
        Assertion::isInstanceOf($dto, OutgoingDdiRulesPatternDTO::class);

        $self = new static(
            $dto->getAction(),
            $dto->getPriority());

        return $self
            ->setOutgoingDdiRule($dto->getOutgoingDdiRule())
            ->setMatchList($dto->getMatchList())
            ->setForcedDdi($dto->getForcedDdi())
        ;
    }

    /**
     * @param DataTransferObjectInterface $dto
     * @return self
     */
    public function updateFromDTO(DataTransferObjectInterface $dto)
    {
        /**
         * @var $dto OutgoingDdiRulesPatternDTO
         */
        Assertion::isInstanceOf($dto, OutgoingDdiRulesPatternDTO::class);

        $this
            ->setAction($dto->getAction())
            ->setPriority($dto->getPriority())
            ->setOutgoingDdiRule($dto->getOutgoingDdiRule())
            ->setMatchList($dto->getMatchList())
            ->setForcedDdi($dto->getForcedDdi());


        return $this;
    }

    /**
     * @return OutgoingDdiRulesPatternDTO
     */
    public function toDTO()
    {
        return self::createDTO()
            ->setAction($this->getAction())
            ->setPriority($this->getPriority())
            ->setOutgoingDdiRuleId($this->getOutgoingDdiRule() ? $this->getOutgoingDdiRule()->getId() : null)
            ->setMatchListId($this->getMatchList() ? $this->getMatchList()->getId() : null)
            ->setForcedDdiId($this->getForcedDdi() ? $this->getForcedDdi()->getId() : null);
    }

    /**
     * @return array
     */
    protected function __toArray()
    {
        return [
            'action' => self::getAction(),
            'priority' => self::getPriority(),
            'outgoingDdiRuleId' => self::getOutgoingDdiRule() ? self::getOutgoingDdiRule()->getId() : null,
            'matchListId' => self::getMatchList() ? self::getMatchList()->getId() : null,
            'forcedDdiId' => self::getForcedDdi() ? self::getForcedDdi()->getId() : null
        ];
    }


    // @codeCoverageIgnoreStart

    /**
     * Set action
     *
     * @param string $action
     *
     * @return self
     */
    public function setAction($action)
    {
        Assertion::notNull($action);
        Assertion::maxLength($action, 10);
        Assertion::choice($action, array (
          0 => 'keep',
          1 => 'force',
        ));

        $this->action = $action;

        return $this;
    }

    /**
     * Get action
     *
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set priority
     *
     * @param integer $priority
     *
     * @return self
     */
    public function setPriority($priority)
    {
        Assertion::notNull($priority);
        Assertion::integerish($priority);

        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return integer
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set outgoingDdiRule
     *
     * @param \Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleInterface $outgoingDdiRule
     *
     * @return self
     */
    public function setOutgoingDdiRule(\Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleInterface $outgoingDdiRule = null)
    {
        $this->outgoingDdiRule = $outgoingDdiRule;

        return $this;
    }

    /**
     * Get outgoingDdiRule
     *
     * @return \Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleInterface
     */
    public function getOutgoingDdiRule()
    {
        return $this->outgoingDdiRule;
    }

    /**
     * Set matchList
     *
     * @param \Ivoz\Provider\Domain\Model\MatchList\MatchListInterface $matchList
     *
     * @return self
     */
    public function setMatchList(\Ivoz\Provider\Domain\Model\MatchList\MatchListInterface $matchList)
    {
        $this->matchList = $matchList;

        return $this;
    }

    /**
     * Get matchList
     *
     * @return \Ivoz\Provider\Domain\Model\MatchList\MatchListInterface
     */
    public function getMatchList()
    {
        return $this->matchList;
    }

    /**
     * Set forcedDdi
     *
     * @param \Ivoz\Provider\Domain\Model\Ddi\DdiInterface $forcedDdi
     *
     * @return self
     */
    public function setForcedDdi(\Ivoz\Provider\Domain\Model\Ddi\DdiInterface $forcedDdi = null)
    {
        $this->forcedDdi = $forcedDdi;

        return $this;
    }

    /**
     * Get forcedDdi
     *
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface
     */
    public function getForcedDdi()
    {
        return $this->forcedDdi;
    }



    // @codeCoverageIgnoreEnd
}

