<?php

namespace Ivoz\Provider\Domain\Model\OutgoingDdiRule;

use Ivoz\Core\Domain\Model\LoggableEntityInterface;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\Company\CompanyInterface;
use Ivoz\Provider\Domain\Model\OutgoingDdiRulesPattern\OutgoingDdiRulesPatternInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;

/**
* OutgoingDdiRuleInterface
*/
interface OutgoingDdiRuleInterface extends LoggableEntityInterface
{
    public const DEFAULTACTION_KEEP = 'keep';

    public const DEFAULTACTION_FORCE = 'force';

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet(): array;

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

    public function getName(): string;

    public function getDefaultAction(): string;

    public function getCompany(): CompanyInterface;

    public function isInitialized(): bool;

    public function addPattern(OutgoingDdiRulesPatternInterface $pattern): OutgoingDdiRuleInterface;

    public function removePattern(OutgoingDdiRulesPatternInterface $pattern): OutgoingDdiRuleInterface;

    public function replacePatterns(ArrayCollection $patterns): OutgoingDdiRuleInterface;

    public function getPatterns(?Criteria $criteria = null): array;
}
