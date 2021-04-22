<?php

namespace Ivoz\Provider\Domain\Model\TransformationRule;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface;

/**
* TransformationRuleInterface
*/
interface TransformationRuleInterface extends LoggableEntityInterface
{
    const TYPE_CALLERIN = 'callerin';

    const TYPE_CALLEEIN = 'calleein';

    const TYPE_CALLEROUT = 'callerout';

    const TYPE_CALLEEOUT = 'calleeout';

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

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
