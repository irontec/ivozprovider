<?php

namespace Ivoz\Provider\Domain\Model\OutgoingDdiRulesPattern;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;

/**
 * OutgoingDdiRulesPatternAbstract
 * @codeCoverageIgnore
 */
abstract class OutgoingDdiRulesPatternAbstract
{
    /**
     * comment: enum:keep|force
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


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct($action, $priority)
    {
        $this->setAction($action);
        $this->setPriority($priority);
    }

    abstract public function getId();

    public function __toString()
    {
        return sprintf(
            "%s#%s",
            "OutgoingDdiRulesPattern",
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
     * @return OutgoingDdiRulesPatternDto
     */
    public static function createDto($id = null)
    {
        return new OutgoingDdiRulesPatternDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param EntityInterface|null $entity
     * @param int $depth
     * @return OutgoingDdiRulesPatternDto|null
     */
    public static function entityToDto(EntityInterface $entity = null, $depth = 0)
    {
        if (!$entity) {
            return null;
        }

        Assertion::isInstanceOf($entity, OutgoingDdiRulesPatternInterface::class);

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
         * @var $dto OutgoingDdiRulesPatternDto
         */
        Assertion::isInstanceOf($dto, OutgoingDdiRulesPatternDto::class);

        $self = new static(
            $dto->getAction(),
            $dto->getPriority()
        );

        $self
            ->setOutgoingDdiRule($dto->getOutgoingDdiRule())
            ->setMatchList($dto->getMatchList())
            ->setForcedDdi($dto->getForcedDdi())
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
         * @var $dto OutgoingDdiRulesPatternDto
         */
        Assertion::isInstanceOf($dto, OutgoingDdiRulesPatternDto::class);

        $this
            ->setAction($dto->getAction())
            ->setPriority($dto->getPriority())
            ->setOutgoingDdiRule($dto->getOutgoingDdiRule())
            ->setMatchList($dto->getMatchList())
            ->setForcedDdi($dto->getForcedDdi());



        $this->sanitizeValues();
        return $this;
    }

    /**
     * @internal use EntityTools instead
     * @param int $depth
     * @return OutgoingDdiRulesPatternDto
     */
    public function toDto($depth = 0)
    {
        return self::createDto()
            ->setAction(self::getAction())
            ->setPriority(self::getPriority())
            ->setOutgoingDdiRule(\Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRule::entityToDto(self::getOutgoingDdiRule(), $depth))
            ->setMatchList(\Ivoz\Provider\Domain\Model\MatchList\MatchList::entityToDto(self::getMatchList(), $depth))
            ->setForcedDdi(\Ivoz\Provider\Domain\Model\Ddi\Ddi::entityToDto(self::getForcedDdi(), $depth));
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
     * @deprecated
     * Set action
     *
     * @param string $action
     *
     * @return self
     */
    public function setAction($action)
    {
        Assertion::notNull($action, 'action value "%s" is null, but non null value was expected.');
        Assertion::maxLength($action, 10, 'action value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice($action, array (
          0 => 'keep',
          1 => 'force',
        ), 'actionvalue "%s" is not an element of the valid values: %s');

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
     * @deprecated
     * Set priority
     *
     * @param integer $priority
     *
     * @return self
     */
    public function setPriority($priority)
    {
        Assertion::notNull($priority, 'priority value "%s" is null, but non null value was expected.');
        Assertion::integerish($priority, 'priority value "%s" is not an integer or a number castable to integer.');

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
