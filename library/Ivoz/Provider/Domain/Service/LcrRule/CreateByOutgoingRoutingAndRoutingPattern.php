<?php

namespace Ivoz\Provider\Domain\Service\LcrRule;

use Ivoz\Core\Application\Service\CreateEntityFromDTO;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\LcrRule\LcrRule;
use Ivoz\Provider\Domain\Model\LcrRule\LcrRuleInterface;
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
     * @return LcrRuleInterface
     */
    public function execute(
        OutgoingRoutingInterface $entity,
        RoutingPatternInterface $pattern = null
    ) {
        $lcrRuleDto = LcrRule::createDto();
        $condition = 'fax';
        if (is_null($pattern)) {
            // Fax route
            $lcrRuleDto
                ->setTag('fax')
                ->setDescription('Special route for fax');
        } else {
            // Non-fax route
            $lcrRuleDto
                ->setTag(
                    $pattern->getName()->getEn()
                )
                ->setDescription(
                    $pattern->getDescription()->getEn()
                )
                ->setRoutingPatternId($pattern->getId());

            $condition = $pattern->getRegExp();
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

        /** @var LcrRule $lcrRule */
        $lcrRule = $this
            ->createEntityFromDTO
            ->execute(LcrRule::class, $lcrRuleDto);

        $lcrRule->setCondition($condition);

        // Setting Outgoing Routing also sets from_uri (see model)
        $lcrRule->setOutgoingRouting($entity);

        $this
            ->entityPersister
            ->persist($lcrRule, true);

        return $lcrRule;
    }

}