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
     * Set type
     *
     * @param string $type
     *
     * @return self
     */
    public function setType($type);

    /**
     * Get type
     *
     * @return string
     */
    public function getType();

    /**
     * Set description
     *
     * @param string $description
     *
     * @return self
     */
    public function setDescription($description);

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription();

    /**
     * Set priority
     *
     * @param integer $priority
     *
     * @return self
     */
    public function setPriority($priority = null);

    /**
     * Get priority
     *
     * @return integer
     */
    public function getPriority();

    /**
     * Get matchExpr
     *
     * @return string
     */
    public function getMatchExpr();

    /**
     * Set replaceExpr
     *
     * @param string $replaceExpr
     *
     * @return self
     */
    public function setReplaceExpr($replaceExpr = null);

    /**
     * Get replaceExpr
     *
     * @return string
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
     * @return \Ivoz\Provider\Domain\Model\TransformationRuleSet\TransformationRuleSetInterface
     */
    public function getTransformationRuleSet();

}

