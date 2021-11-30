<?php

declare(strict_types=1);

namespace Ivoz\Provider\Domain\Model\OutgoingDdiRulesPattern;

use Assert\Assertion;
use Ivoz\Core\Application\DataTransferObjectInterface;
use Ivoz\Core\Domain\Model\ChangelogTrait;
use Ivoz\Core\Domain\Model\EntityInterface;
use Ivoz\Core\Application\ForeignKeyTransformerInterface;
use Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRuleInterface;
use Ivoz\Provider\Domain\Model\MatchList\MatchListInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\OutgoingDdiRule\OutgoingDdiRule;
use Ivoz\Provider\Domain\Model\MatchList\MatchList;
use Ivoz\Provider\Domain\Model\Ddi\Ddi;

/**
* OutgoingDdiRulesPatternAbstract
* @codeCoverageIgnore
*/
abstract class OutgoingDdiRulesPatternAbstract
{
    use ChangelogTrait;

    /**
     * @var string
     * comment: enum:prefix|destination
     */
    protected $type;

    /**
     * @var ?string
     */
    protected $prefix = null;

    /**
     * @var string
     * comment: enum:keep|force
     */
    protected $action;

    /**
     * @var int
     */
    protected $priority = 1;

    /**
     * @var OutgoingDdiRuleInterface
     * inversedBy patterns
     */
    protected $outgoingDdiRule;

    /**
     * @var ?MatchListInterface
     */
    protected $matchList = null;

    /**
     * @var ?DdiInterface
     */
    protected $forcedDdi = null;

    /**
     * Constructor
     */
    protected function __construct(
        string $type,
        string $action,
        int $priority
    ) {
        $this->setType($type);
        $this->setAction($action);
        $this->setPriority($priority);
    }

    abstract public function getId(): null|string|int;

    public function __toString(): string
    {
        return sprintf(
            "%s#%s",
            "OutgoingDdiRulesPattern",
            (string) $this->getId()
        );
    }

    /**
     * @throws \Exception
     */
    protected function sanitizeValues(): void
    {
    }

    public static function createDto(string|int|null $id = null): OutgoingDdiRulesPatternDto
    {
        return new OutgoingDdiRulesPatternDto($id);
    }

    /**
     * @internal use EntityTools instead
     * @param null|OutgoingDdiRulesPatternInterface $entity
     */
    public static function entityToDto(?EntityInterface $entity, int $depth = 0): ?OutgoingDdiRulesPatternDto
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

        $dto = $entity->toDto($depth - 1);

        return $dto;
    }

    /**
     * Factory method
     * @internal use EntityTools instead
     * @param OutgoingDdiRulesPatternDto $dto
     */
    public static function fromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, OutgoingDdiRulesPatternDto::class);
        $type = $dto->getType();
        Assertion::notNull($type, 'getType value is null, but non null value was expected.');
        $action = $dto->getAction();
        Assertion::notNull($action, 'getAction value is null, but non null value was expected.');
        $priority = $dto->getPriority();
        Assertion::notNull($priority, 'getPriority value is null, but non null value was expected.');
        $outgoingDdiRule = $dto->getOutgoingDdiRule();
        Assertion::notNull($outgoingDdiRule, 'getOutgoingDdiRule value is null, but non null value was expected.');

        $self = new static(
            $type,
            $action,
            $priority
        );

        $self
            ->setPrefix($dto->getPrefix())
            ->setOutgoingDdiRule($fkTransformer->transform($outgoingDdiRule))
            ->setMatchList($fkTransformer->transform($dto->getMatchList()))
            ->setForcedDdi($fkTransformer->transform($dto->getForcedDdi()));

        $self->initChangelog();

        return $self;
    }

    /**
     * @internal use EntityTools instead
     * @param OutgoingDdiRulesPatternDto $dto
     */
    public function updateFromDto(
        DataTransferObjectInterface $dto,
        ForeignKeyTransformerInterface $fkTransformer
    ): static {
        Assertion::isInstanceOf($dto, OutgoingDdiRulesPatternDto::class);

        $type = $dto->getType();
        Assertion::notNull($type, 'getType value is null, but non null value was expected.');
        $action = $dto->getAction();
        Assertion::notNull($action, 'getAction value is null, but non null value was expected.');
        $priority = $dto->getPriority();
        Assertion::notNull($priority, 'getPriority value is null, but non null value was expected.');
        $outgoingDdiRule = $dto->getOutgoingDdiRule();
        Assertion::notNull($outgoingDdiRule, 'getOutgoingDdiRule value is null, but non null value was expected.');

        $this
            ->setType($type)
            ->setPrefix($dto->getPrefix())
            ->setAction($action)
            ->setPriority($priority)
            ->setOutgoingDdiRule($fkTransformer->transform($outgoingDdiRule))
            ->setMatchList($fkTransformer->transform($dto->getMatchList()))
            ->setForcedDdi($fkTransformer->transform($dto->getForcedDdi()));

        return $this;
    }

    /**
     * @internal use EntityTools instead
     */
    public function toDto(int $depth = 0): OutgoingDdiRulesPatternDto
    {
        return self::createDto()
            ->setType(self::getType())
            ->setPrefix(self::getPrefix())
            ->setAction(self::getAction())
            ->setPriority(self::getPriority())
            ->setOutgoingDdiRule(OutgoingDdiRule::entityToDto(self::getOutgoingDdiRule(), $depth))
            ->setMatchList(MatchList::entityToDto(self::getMatchList(), $depth))
            ->setForcedDdi(Ddi::entityToDto(self::getForcedDdi(), $depth));
    }

    protected function __toArray(): array
    {
        return [
            'type' => self::getType(),
            'prefix' => self::getPrefix(),
            'action' => self::getAction(),
            'priority' => self::getPriority(),
            'outgoingDdiRuleId' => self::getOutgoingDdiRule()->getId(),
            'matchListId' => self::getMatchList()?->getId(),
            'forcedDdiId' => self::getForcedDdi()?->getId()
        ];
    }

    protected function setType(string $type): static
    {
        Assertion::maxLength($type, 20, 'type value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice(
            $type,
            [
                OutgoingDdiRulesPatternInterface::TYPE_PREFIX,
                OutgoingDdiRulesPatternInterface::TYPE_DESTINATION,
            ],
            'typevalue "%s" is not an element of the valid values: %s'
        );

        $this->type = $type;

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    protected function setPrefix(?string $prefix = null): static
    {
        if (!is_null($prefix)) {
            Assertion::maxLength($prefix, 10, 'prefix value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        }

        $this->prefix = $prefix;

        return $this;
    }

    public function getPrefix(): ?string
    {
        return $this->prefix;
    }

    protected function setAction(string $action): static
    {
        Assertion::maxLength($action, 10, 'action value "%s" is too long, it should have no more than %d characters, but has %d characters.');
        Assertion::choice(
            $action,
            [
                OutgoingDdiRulesPatternInterface::ACTION_KEEP,
                OutgoingDdiRulesPatternInterface::ACTION_FORCE,
            ],
            'actionvalue "%s" is not an element of the valid values: %s'
        );

        $this->action = $action;

        return $this;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    protected function setPriority(int $priority): static
    {
        $this->priority = $priority;

        return $this;
    }

    public function getPriority(): int
    {
        return $this->priority;
    }

    public function setOutgoingDdiRule(OutgoingDdiRuleInterface $outgoingDdiRule): static
    {
        $this->outgoingDdiRule = $outgoingDdiRule;

        return $this;
    }

    public function getOutgoingDdiRule(): OutgoingDdiRuleInterface
    {
        return $this->outgoingDdiRule;
    }

    protected function setMatchList(?MatchListInterface $matchList = null): static
    {
        $this->matchList = $matchList;

        return $this;
    }

    public function getMatchList(): ?MatchListInterface
    {
        return $this->matchList;
    }

    protected function setForcedDdi(?DdiInterface $forcedDdi = null): static
    {
        $this->forcedDdi = $forcedDdi;

        return $this;
    }

    public function getForcedDdi(): ?DdiInterface
    {
        return $this->forcedDdi;
    }
}
