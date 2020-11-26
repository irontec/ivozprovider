<?php

namespace Ivoz\Provider\Domain\Model\TransformationRule;

use Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

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
    public function setMatchExpr(string $matchExpr = null): TransformationRuleInterface;

    /**
     * Get type
     *
     * @return string
     */
    public function getType(): string;

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription(): string;

    /**
     * Get priority
     *
     * @return int | null
     */
    public function getPriority(): ?int;

    /**
     * Get matchExpr
     *
     * @return string | null
     */
    public function getMatchExpr(): ?string;

    /**
     * Get replaceExpr
     *
     * @return string | null
     */
    public function getReplaceExpr(): ?string;

    /**
     * Set transformationRuleSet
     *
     * @param TransformationRuleSetInterface | null
     *
     * @return static
     */
    public function setTransformationRuleSet(?TransformationRuleSetInterface $transformationRuleSet = null): TransformationRuleInterface;

    /**
     * Get transformationRuleSet
     *
     * @return TransformationRuleSetInterface | null
     */
    public function getTransformationRuleSet(): ?TransformationRuleSetInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

}
