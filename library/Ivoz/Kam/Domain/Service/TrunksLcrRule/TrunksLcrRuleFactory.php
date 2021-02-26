<?php

namespace Ivoz\Kam\Domain\Service\TrunksLcrRule;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Core\Infrastructure\Persistence\Doctrine\Model\Helper\CriteriaHelper;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRule;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleDto;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleInterface;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface;
use Ivoz\Provider\Domain\Model\RoutingPatternGroupsRelPattern\RoutingPatternGroupsRelPatternInterface;

class TrunksLcrRuleFactory
{
    /**
     * @var EntityTools
     */
    protected $entityTools;

    /**
     * TrunksLcrRuleFactory constructor.
     *
     * @param EntityTools $entityTools
     */
    public function __construct(
        EntityTools $entityTools
    ) {
        $this->entityTools = $entityTools;
    }

    /**
     * @param OutgoingRoutingInterface $outgoingRouting
     * @param RoutingPatternInterface|null $routingPattern
     * @return TrunksLcrRuleInterface
     */
    public function execute(
        OutgoingRoutingInterface $outgoingRouting,
        RoutingPatternInterface $routingPattern = null
    ) {
        // Check if this rule  already exists for current Outgoing Routing
        if (!is_null($routingPattern)) {
            $lcrRules = $outgoingRouting->getLcrRules(
                CriteriaHelper::fromArray([
                    [ "routingPattern", "eq", $routingPattern ]
                ])
            );
        } else {
            $lcrRules = $outgoingRouting->getLcrRules(
                CriteriaHelper::fromArray([
                    [ "prefix", "eq", "fax" ]
                ])
            );
        }

        $lcrRule = array_shift($lcrRules);
        /** @var TrunksLcrRuleDto $lcrRuleDto */
        $lcrRuleDto = ($lcrRule)
            ? $this->entityTools->entityToDto($lcrRule)
            : TrunksLcrRule::createDto();

        if (is_null($routingPattern)) {
            // Fax route
            $lcrRuleDto
                ->setPrefix('fax');
        } else {
            // Non-fax route
            $routingTag = ($outgoingRouting->getRoutingTag())
                ? $outgoingRouting->getRoutingTag()->getTag()
                : '';

            $routingPatternGroup = $outgoingRouting->getRoutingPatternGroup();
            if (!is_null($routingPatternGroup)) {
                $routingPatternGroupsRelPatterns = $routingPatternGroup->getRelPatterns(
                    CriteriaHelper::fromArray([
                        [ "routingPattern", "eq", $routingPattern ]
                    ])
                );

                /** @var RoutingPatternGroupsRelPatternInterface|null $routingPatternGroupsRelPattern */
                $routingPatternGroupsRelPattern = array_shift($routingPatternGroupsRelPatterns);
                if ($routingPatternGroupsRelPattern) {
                    $lcrRuleDto->setRoutingPatternGroupsRelPatternId(
                        $routingPatternGroupsRelPattern->getId()
                    );
                }
            }

            $lcrRuleDto
                ->setPrefix($routingTag . $routingPattern->getPrefix())
                ->setRoutingPatternId($routingPattern->getId());
        }

        $lcrRuleDto
            ->setFromUri(TrunksLcrRule::getFromUriForOutgoingRouting($outgoingRouting))
            ->setOutgoingRoutingId($outgoingRouting->getId());

        /** @var TrunksLcrRuleInterface $lcrRule */
        $lcrRule = $this->entityTools->persistDto(
            $lcrRuleDto,
            $lcrRule,
            true
        );

        return $lcrRule;
    }
}
