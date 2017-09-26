<?php

namespace Ivoz\Provider\Domain\Model\OutgoingDdiRule;

use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\OutgoingDdiRulesPattern\OutgoingDdiRulesPatternInterface;

/**
 * OutgoingDdiRule
 */
class OutgoingDdiRule extends OutgoingDdiRuleAbstract implements OutgoingDdiRuleInterface
{
    use OutgoingDdiRuleTrait;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Return forced Ddi for this rule
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface
     */
    public function getForcedDdi()
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
     * @return \Ivoz\Provider\Domain\Model\Ddi\DdiInterface
     */
    public function getOutgoingDdi($originalDdi, $e164destination)
    {
        // Default Rule action
        if ($this->getDefaultAction() == 'keep') {
            $finalDdi = $originalDdi;
        } else if ($this->getDefaultAction() == 'force') {
            $finalDdi = $this->getForcedDdi();
        }

        // Check rule patterns
        $criteria = Criteria::create()->orderBy([
            'priority' => Criteria::ASC
        ]);
        $rulePatterns = $this->getPatterns($criteria);

        /**
         * @var OutgoingDdiRulesPatternInterface $rulePattern
         */
        foreach ($rulePatterns as $rulePattern) {
            $list = $rulePattern->getMatchList();
            // If rule pattern matches, apply action and leave
            if ($list->numberMatches($e164destination)) {
                if ($rulePattern->getAction() == 'force')  {
                    $finalDdi = $rulePattern->getForcedDdi();
                }
                break;
            }
        }

        return $finalDdi;
    }
}

