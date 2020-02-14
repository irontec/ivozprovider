<?php

namespace Ivoz\Provider\Domain\Model\OutgoingDdiRule;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\ArrayCollection;

interface OutgoingDdiRuleInterface extends LoggableEntityInterface
{
    const DEFAULTACTION_KEEP = 'keep';
    const DEFAULTACTION_FORCE = 'force';


    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet();

    /**
     * Return forced Ddi for this rule
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface | null
     */
    public function getForcedDdi();

    /**
     * Check final outgoing Ddi presentation for given destination
     * @param \Ivoz\Provider\Domain\Model\Ddi\DdiInterface $originalDdi
     * @param string $e164destination
     * @param string $prefix
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface | null $e164destination
     */
    public function getOutgoingDdi($originalDdi, $e164destination, $prefix = '');

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Get defaultAction
     *
     * @return string
     */
    public function getDefaultAction();

    /**
     * Get company
     *
     * @return \Ivoz\Provider\Domain\Model\Company\CompanyInterface
     */
    public function getCompany();

    /**
     * Add pattern
     *
     * @param \Ivoz\Provider\Domain\Model\OutgoingDdiRulesPattern\OutgoingDdiRulesPatternInterface $pattern
     *
     * @return static
     */
    public function addPattern(\Ivoz\Provider\Domain\Model\OutgoingDdiRulesPattern\OutgoingDdiRulesPatternInterface $pattern);

    /**
     * Remove pattern
     *
     * @param \Ivoz\Provider\Domain\Model\OutgoingDdiRulesPattern\OutgoingDdiRulesPatternInterface $pattern
     */
    public function removePattern(\Ivoz\Provider\Domain\Model\OutgoingDdiRulesPattern\OutgoingDdiRulesPatternInterface $pattern);

    /**
     * Replace patterns
     *
     * @param ArrayCollection $patterns of Ivoz\Provider\Domain\Model\OutgoingDdiRulesPattern\OutgoingDdiRulesPatternInterface
     * @return static
     */
    public function replacePatterns(ArrayCollection $patterns);

    /**
     * Get patterns
     * @param Criteria | null $criteria
     * @return \Ivoz\Provider\Domain\Model\OutgoingDdiRulesPattern\OutgoingDdiRulesPatternInterface[]
     */
    public function getPatterns(\Doctrine\Common\Collections\Criteria $criteria = null);
}
