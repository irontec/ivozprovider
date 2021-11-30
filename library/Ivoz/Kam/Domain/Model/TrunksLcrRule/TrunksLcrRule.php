<?php

namespace Ivoz\Kam\Domain\Model\TrunksLcrRule;

use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;

/**
 * LcrRule
 */
class TrunksLcrRule extends TrunksLcrRuleAbstract implements TrunksLcrRuleInterface
{
    use TrunksLcrRuleTrait;

    /**
     * @codeCoverageIgnore
     * @return array<string, mixed>
     */
    public function getChangeSet(): array
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Return LcrRule FromUri string based on OutgoingRouting configuration
     *
     * @param \Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface $outgoingRouting
     * @return string
     */
    public static function getFromUriForOutgoingRouting(OutgoingRoutingInterface $outgoingRouting): string
    {
        $company = $outgoingRouting->getCompany();

        if (is_null($company)) {
            // Apply all companies
            return sprintf(
                '^b%dc[0-9]+$',
                (int) $outgoingRouting->getBrand()->getId()
            );
        }

        // Company specific rule
        return sprintf(
            '^b%dc%d$',
            (int) $outgoingRouting->getBrand()->getId(),
            (int) $company->getId()
        );
    }
}
