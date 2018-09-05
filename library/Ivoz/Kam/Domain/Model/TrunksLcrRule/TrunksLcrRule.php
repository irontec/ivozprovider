<?php

namespace Ivoz\Kam\Domain\Model\TrunksLcrRule;

use Assert\Assertion;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;

/**
 * LcrRule
 */
class TrunksLcrRule extends TrunksLcrRuleAbstract implements TrunksLcrRuleInterface
{
    use TrunksLcrRuleTrait;

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
     * Return LcrRule FromUri string based on OutgoingRouting configuration
     *
     * @param OutgoingRoutingInterface $outgoingRouting
     * @return string
     */
    public static function getFromUriForOutgoingRouting(OutgoingRoutingInterface $outgoingRouting)
    {
        $company = $outgoingRouting->getCompany();

        if (is_null($company)) {
            // Apply all companies
            return sprintf(
                '^b%dc[0-9]+$',
                $outgoingRouting->getBrand()->getId()
            );
        }

        // Company specific rule
        return sprintf(
            '^b%dc%d$',
            $outgoingRouting->getBrand()->getId(),
            $company->getId()
        );
    }
}
