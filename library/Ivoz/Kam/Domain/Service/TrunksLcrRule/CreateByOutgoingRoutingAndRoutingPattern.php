<?php

namespace Ivoz\Kam\Domain\Service\TrunksLcrRule;

use Ivoz\Core\Application\Service\CreateEntityFromDTO;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRule;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleInterface;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleRepository;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface;

class CreateByOutgoingRoutingAndRoutingPattern
{
    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    /**
     * @var CreateEntityFromDTO
     */
    protected $createEntityFromDTO;

    /**
     * @var TrunksLcrRuleRepository
     */
    protected $lcrRuleRepository;

    public function __construct(
        EntityPersisterInterface $entityPersister,
        CreateEntityFromDTO $createEntityFromDTO,
        TrunksLcrRuleRepository $lcrRuleRepository
    ) {
        $this->entityPersister = $entityPersister;
        $this->createEntityFromDTO = $createEntityFromDTO;
        $this->lcrRuleRepository = $lcrRuleRepository;
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

        /** @var TrunksLcrRule $lcrRule */
        $lcrRule = $this
            ->createEntityFromDTO
            ->execute(TrunksLcrRule::class, $lcrRuleDto);

        // Setting Outgoing Routing also sets from_uri (see model)
        $lcrRule->setOutgoingRouting($outgoingRouting);

        $this
            ->entityPersister
            ->persist($lcrRule, true);

        return $lcrRule;
    }

}