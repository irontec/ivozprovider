<?php

namespace Ivoz\Provider\Domain\Model\OutgoingDdiRule;

use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\Ddi\DdiInterface;
use Ivoz\Provider\Domain\Model\OutgoingDdiRulesPattern\OutgoingDdiRulesPatternInterface;

/**
 * OutgoingDdiRule
 */
class OutgoingDdiRule extends OutgoingDdiRuleAbstract implements OutgoingDdiRuleInterface
{
    use OutgoingDdiRuleTrait;

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Return string representation of this entity
     * @return string
     */
    public function __toString()
    {
        return sprintf(
            "%s[%s]",
            $this->getName(),
            parent::__toString()
        );
    }

    protected function sanitizeValues()
    {
        $nullableFields = [
            'force' => 'forcedDdi',
        ];

        $defaultAction = $this->getDefaultAction();
        foreach ($nullableFields as $type => $fieldName) {
            if ($defaultAction === $type) {
                continue;
            }
            $setter = 'set' . ucfirst($fieldName);
            $this->{$setter}(null);
        }
    }

    /**
     * Return forced Ddi for this rule
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface | null
     */
    public function getForcedDdi(): ?DdiInterface
    {
        $ddi = parent::getForcedDdi();
        if ($ddi) {
            return $ddi;
        }

        return $this
            ->getCompany()
            ->getOutgoingDdi();
    }

    /**
     * Check final outgoing Ddi presentation for given destination
     * @param \Ivoz\Provider\Domain\Model\Ddi\DdiInterface $originalDdi
     * @param string $e164destination
     * @param string $prefix
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface | null $e164destination
     */
    public function getOutgoingDdi($originalDdi, $e164destination, $prefix = "")
    {
        // Default Rule action
        if ($this->getDefaultAction() === OutgoingDdiRule::DEFAULTACTION_FORCE) {
            $finalDdi = $this->getForcedDdi();
        } else {
            $finalDdi = $originalDdi;
        }

        // Check rule patterns
        $criteria = Criteria::create()->orderBy([
            'priority' => Criteria::ASC
        ]);
        $rulePatterns = $this->getPatterns($criteria);

        foreach ($rulePatterns as $rulePattern) {
            if ($rulePattern->getType() === OutgoingDdiRulesPatternInterface::TYPE_PREFIX) {
                // skip pattern if doesn't match the prefix
                if ($rulePattern->getPrefix() != $prefix) {
                    continue;
                }
            } elseif ($rulePattern->getType() === OutgoingDdiRulesPatternInterface::TYPE_DESTINATION) {
                $list = $rulePattern->getMatchList();
                // skip pattern if doesn't match pattern
                if (!$list->numberMatches($e164destination)) {
                    continue;
                }
            } else {
                // Invalid pattern type, this must be a bug!
                continue;
            }

            // If we reached here, pattern matched: apply action
            if ($rulePattern->getAction() === OutgoingDdiRulesPatternInterface::ACTION_FORCE) {
                $finalDdi = $rulePattern->getForcedDdi();
            } else {
                $finalDdi = $originalDdi;
            }

            break;
        }

        return $finalDdi;
    }
}
