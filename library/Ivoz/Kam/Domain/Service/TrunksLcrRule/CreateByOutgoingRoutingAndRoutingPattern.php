<?php

namespace Ivoz\Kam\Domain\Service\TrunksLcrRule;

use Ivoz\Core\Application\Service\EntityTools;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRule;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleInterface;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleRepository;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface;

class CreateByOutgoingRoutingAndRoutingPattern
{
    /**
     * @var TrunksLcrRuleRepository
     */
    protected $lcrRuleRepository;

    /**
     * @var EntityTools
     */
    protected $entityTools;

    public function __construct(
        TrunksLcrRuleRepository $lcrRuleRepository,
        EntityTools $entityTools
    ) {
        $this->lcrRuleRepository = $lcrRuleRepository;
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
        $routingPatternId = ($routingPattern)
            ? $routingPattern->getId()
            : null;

        $routingTag = ($outgoingRouting->getRoutingTag())
            ? $outgoingRouting->getRoutingTag()->getTag()
            : '';

        /** @var TrunksLcrRuleInterface $lcrRule */
        $lcrRule = $this->lcrRuleRepository->findOneBy([
            'outgoingRouting' => $outgoingRouting->getId(),
            'routingPattern' => $routingPatternId
        ]);

        $lcrRuleDto = ($lcrRule)
            ? $lcrRule->toDto()
            : TrunksLcrRule::createDto();

        if (is_null($routingPattern)) {
            // Fax route
            $lcrRuleDto
                ->setPrefix('fax');
        } else {
            // Non-fax route
            $lcrRuleDto
                ->setPrefix($routingTag . $routingPattern->getPrefix())
                ->setRoutingPatternId($routingPattern->getId());
        }

        $brandId = $outgoingRouting->getBrand()->getId();

        // Setting LcrRule FromURI pattern
        if (!is_null($outgoingRouting->getCompany())) {
            $companyId = $outgoingRouting->getCompany()->getId();
            $lcrRuleDto->setFromUri(
                sprintf(
                    '^b%dc%d$',
                    $brandId,
                    $companyId
                )
            );
        } else {
            $lcrRuleDto->setFromUri(
                sprintf(
                    '^b%dc[0-9]+$',
                    $brandId
                )
            );
        }

        // Setting Outgoing Routing also sets from_uri (see model)
        $lcrRuleDto->setOutgoingRoutingId($outgoingRouting->getId());

        return $this
            ->entityTools
            ->persistDto($lcrRuleDto, $lcrRule, true);
    }
}