<?php

namespace Ivoz\Provider\Domain\Model\TransformationRule;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface;

/**
* TransformationRuleInterface
*/
interface TransformationRuleInterface extends LoggableEntityInterface
{
    public const TYPE_CALLERIN = 'callerin';

    public const TYPE_CALLEEIN = 'calleein';

    public const TYPE_CALLEROUT = 'callerout';

    public const TYPE_CALLEEOUT = 'calleeout';

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet(): array;

    /**
     * {@inheritDoc}
     */
    public function setMatchExpr(?string $matchExpr = null): static;

    public function getType(): string;

    public function getDescription(): string;

    public function getPriority(): ?int;

    public function getMatchExpr(): ?string;

    public function getReplaceExpr(): ?string;

    public function setTransformationRuleSet(?TransformationRuleSetInterface $transformationRuleSet = null): static;

    public function getTransformationRuleSet(): ?TransformationRuleSetInterface;

    public function isInitialized(): bool;
}
