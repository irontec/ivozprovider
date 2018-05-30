<?php

namespace Ivoz\Kam\Domain\Service\TrunksLcrRule;

use Ivoz\Core\Application\Service\CreateEntityFromDTO;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRule;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleInterface;
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

    public function __construct(
        EntityPersisterInterface $entityPersister,
        CreateEntityFromDTO $createEntityFromDTO
    ) {
        $this->entityPersister = $entityPersister;
        $this->createEntityFromDTO = $createEntityFromDTO;
    }

    /**
     * @param OutgoingRoutingInterface $entity
     * @param RoutingPatternInterface|null $pattern
     * @return TrunksLcrRuleInterface
     */
    public function execute(
        OutgoingRoutingInterface $entity,
        RoutingPatternInterface $pattern = null
    ) {
        $lcrRuleDto = TrunksLcrRule::createDto();

        $routingTag = ($entity->getRoutingTag())
            ? $entity->getRoutingTag()->getTag()
            : "";

        if (is_null($pattern)) {
            // Fax route
            $lcrRuleDto
                ->setPrefix('fax');
        } else {
            // Non-fax route
            $lcrRuleDto
                ->setPrefix($routingTag . $pattern->getPrefix())
                ->setRoutingPatternId($pattern->getId());
        }

        $brandId = $entity->getBrand()->getId();

        // Setting LcrRule FromURI pattern
        if (!is_null($entity->getCompany())) {
            $companyId = $entity->getCompany()->getId();
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
        $lcrRule->setOutgoingRouting($entity);

        $this
            ->entityPersister
            ->persist($lcrRule, true);

        return $lcrRule;
    }

}