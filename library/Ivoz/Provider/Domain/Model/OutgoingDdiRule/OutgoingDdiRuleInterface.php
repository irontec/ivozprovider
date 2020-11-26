<?php

namespace Ivoz\Provider\Domain\Model\OutgoingDdiRule;

use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\OutgoingDdiRulesPattern\OutgoingDdiRulesPatternInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Core\Domain\Model\LoggableEntityInterface;

/**
* OutgoingDdiRuleInterface
*/
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
    public function getForcedDdi(): ?DdiInterface;

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
    public function getName(): string;

    /**
     * Get defaultAction
     *
     * @return string
     */
    public function getDefaultAction(): string;

    /**
     * Get company
     *
     * @return CompanyInterface
     */
    public function getCompany(): CompanyInterface;

    /**
     * @return bool
     */
    public function isInitialized(): bool;

    /**
     * Add pattern
     *
     * @param OutgoingDdiRulesPatternInterface $pattern
     *
     * @return static
     */
    public function addPattern(OutgoingDdiRulesPatternInterface $pattern): OutgoingDdiRuleInterface;

    /**
     * Remove pattern
     *
     * @param OutgoingDdiRulesPatternInterface $pattern
     *
     * @return static
     */
    public function removePattern(OutgoingDdiRulesPatternInterface $pattern): OutgoingDdiRuleInterface;

    /**
     * Replace patterns
     *
     * @param ArrayCollection $patterns of OutgoingDdiRulesPatternInterface
     *
     * @return static
     */
    public function replacePatterns(ArrayCollection $patterns): OutgoingDdiRuleInterface;

    /**
     * Get patterns
     * @param Criteria | null $criteria
     * @return OutgoingDdiRulesPatternInterface[]
     */
    public function getPatterns(?Criteria $criteria = null): array;

}
