<?php

namespace Ivoz\Provider\Domain\Model\TransformationRule;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;

interface TransformationRuleInterface extends LoggableEntityInterface
{
    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * {@inheritDoc}
     */
    public function setMatchExpr($matchExpr = null);

    /**
     * Get type
     *
     * @return string
     */
    public function getType();

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription();

    /**
     * Get priority
     *
     * @return integer | null
     */
    public function getPriority();

    /**
     * Get matchExpr
     *
     * @return string | null
     */
    public function getMatchExpr();

    /**
     * Get replaceExpr
     *
     * @return string | null
     */
    public function getReplaceExpr();

    /**
     * Set transformationRuleSet
     *
     * @param \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface $transformationRuleSet
     *
     * @return self
     */
    public function setTransformationRuleSet(\Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface $transformationRuleSet = null);

    /**
     * Get transformationRuleSet
     *
     * @return \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface | null
     */
    public function getTransformationRuleSet();
}
