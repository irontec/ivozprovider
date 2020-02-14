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
     * comment: enum:prefix|destination
     * @var string
     */
    protected $type;

    /**
     * @var string | null
     */
    protected $prefix;

    /**
     * comment: enum:keep|force
     * @var string
     */
    protected $action;

    /**
     * @var integer
     */
    protected $priority = 1;

    /**
     * @var \Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleInterface
     */
    protected $outgoingDdiRule;

    /**
     * @var \Ivoz\Provider\Domain\Model\MatchList\MatchListInterface | null
     */
    protected $matchList;

    /**
     * @var \Ivoz\Provider\Domain\Model\Ddi\DdiInterface | null
     */
    protected $forcedDdi;


    use ChangelogTrait;

    /**
     * Constructor
     */
    protected function __construct($type, $action, $priority)
    {
        $this->setType($type);
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
     * @param OutgoingDdiRulesPatternInterface|null $entity
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

        /** @var OutgoingDdiRulesPatternDto $dto */
        $dto = $entity->toDto($depth-1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param OutgoingDdiRulesPatternDto $dto
     * @return self
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, OutgoingDdiRulesPatternDto::class);

        $self = new static(
            $dto->getType(),
            $dto->getAction(),
            $dto->getPriority()
        );

        $self
            ->setPrefix($dto->getPrefix())
            ->setOutgoingDdiRule($fkTransformer->transform($dto->getOutgoingDdiRule()))
            ->setMatchList($fkTransformer->transform($dto->getMatchList()))
            ->setForcedDdi($fkTransformer->transform($dto->getForcedDdi()))
        ;

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param OutgoingDdiRulesPatternDto $dto
     * @return self
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        \Ivoz\Core\Application\ForeignKeyTransformerInterface $fkTransformer
    ) {
        Assertion::isInstanceOf($dto, OutgoingDdiRulesPatternDto::class);

        $this
            ->setType($dto->getType())
            ->setPrefix($dto->getPrefix())
            ->setAction($dto->getAction())
            ->setPriority($dto->getPriority())
            ->setOutgoingDdiRule($fkTransformer->transform($dto->getOutgoingDdiRule()))
            ->setMatchList($fkTransformer->transform($dto->getMatchList()))
            ->setForcedDdi($fkTransformer->transform($dto->getForcedDdi()));



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
            ->setType(self::getType())
            ->setPrefix(self::getPrefix())
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
            'type' => self::getType(),
            'prefix' => self::getPrefix(),
            'action' => self::getAction(),
            'priority' => self::getPriority(),
            'outgoingDdiRuleId' => self::getOutgoingDdiRule()->getId(),
            'matchListId' => self::getMatchList() ? self::getMatchList()->getId() : null,
            'forcedDdiId' => self::getForcedDdi() ? self::getForcedDdi()->getId() : null
        ];
    }
    // @codeCoverageIgnoreStart

    /**
     * Set type
     *
     * @param string $type
     *
     * @return static
     */
    protected function setType($type)
    {
        Assertion::notNull($type, 'type value "%s" is null, but non null value was expected.');
        Assertion::maxLength($type, 20, 'type value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice($type, [
            OutgoingDdiRulesPatternInterface::TYPE_PREFIX,
            OutgoingDdiRulesPatternInterface::TYPE_DESTINATION
        ], 'typevalue "%s" is not an element of the valid values: %s');

        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set prefix
     *
     * @param string $prefix | null
     *
     * @return static
     */
    protected function setPrefix($prefix = null)
    {
        if (!is_null($prefix)) {
            Assertion::maxLength($prefix, 10, 'prefix value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->prefix = $prefix;

        return $this;
    }

    /**
     * Get prefix
     *
     * @return string | null
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * Set action
     *
     * @param string $action
     *
     * @return static
     */
    protected function setAction($action)
    {
        Assertion::notNull($action, 'action value "%s" is null, but non null value was expected.');
        Assertion::maxLength($action, 10, 'action value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice($action, [
            OutgoingDdiRulesPatternInterface::ACTION_KEEP,
            OutgoingDdiRulesPatternInterface::ACTION_FORCE
        ], 'actionvalue "%s" is not an element of the valid values: %s');

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
     * @return static
     */
    protected function setPriority($priority)
    {
        Assertion::notNull($priority, 'priority value "%s" is null, but non null value was expected.');
        Assertion::integerish($priority, 'priority value "%s" is not an integer or a number castable to integer.');

        $this->priority = (int) $priority;

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
     * @return static
     */
    public function setOutgoingDdiRule(\Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleInterface $outgoingDdiRule)
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
     * @param \Ivoz\Provider\Domain\Model\MatchList\MatchListInterface $matchList | null
     *
     * @return static
     */
    protected function setMatchList(\Ivoz\Provider\Domain\Model\MatchList\MatchListInterface $matchList = null)
    {
        $this->matchList = $matchList;

        return $this;
    }

    /**
     * Get matchList
     *
     * @return \Ivoz\Provider\Domain\Model\MatchList\MatchListInterface | null
     */
    public function getMatchList()
    {
        return $this->matchList;
    }

    /**
     * Set forcedDdi
     *
     * @param \Ivoz\Provider\Domain\Model\Ddi\DdiInterface $forcedDdi | null
     *
     * @return static
     */
    protected function setForcedDdi(\Ivoz\Provider\Domain\Model\Ddi\DdiInterface $forcedDdi = null)
    {
        $this->forcedDdi = $forcedDdi;

        return $this;
    }

    /**
     * Get forcedDdi
     *
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface | null
     */
    public function getForcedDdi()
    {
        return $this->forcedDdi;
    }

    // @codeCoverageIgnoreEnd
}
