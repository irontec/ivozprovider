<?php
namespace Ivoz\Provider\Domain\Service\LcrRule;

use Doctrine\Common\Collections\ArrayCollection;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Provider\Domain\Model\LcrRule\LcrRule;
use Ivoz\Provider\Domain\Model\LcrRule\LcrRuleInterface;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface;
use Ivoz\Provider\Domain\Service\OutgoingRouting\OutgoingRoutingLifecycleEventHandlerInterface;

/**
 * Class UpdateByOutgoingRouting
 * @package Ivoz\Provider\Domain\Service\LcrRule
 */
class UpdateByOutgoingRouting implements OutgoingRoutingLifecycleEventHandlerInterface
{
    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    public function __construct(
        EntityPersisterInterface $entityPersister
    ) {
        $this->entityPersister = $entityPersister;
    }

    /**
     * @param OutgoingRoutingInterface $outgoingRouting
     */
    public function execute(OutgoingRoutingInterface $outgoingRouting)
    {
        // If edit, delete everything and fresh-start
        /** @var LcrRuleInterface[] $lcrRules */
        $lcrRules = $outgoingRouting->getLcrRules();
        foreach ($lcrRules as $lcrRule) {
            $this->entityPersister->remove($lcrRule);
            $outgoingRouting->removeLcrRule($lcrRule);
        }

        /**
         * @var LcrRuleInterface[] $lcrRules
         */
        $routingPatterns = $this->getPatterns($outgoingRouting);

        $lcrRules = new ArrayCollection();

        foreach ($routingPatterns as $routingPattern) {
            $lcrRule = $this->addLcrRulePerPattern($outgoingRouting, $routingPattern);
            $lcrRules->add($lcrRule);
        }

        $outgoingRouting->replaceLcrRules($lcrRules);
    }

    /**
     * @param OutgoingRoutingInterface $outgoingRouting
     * @return array
     * @throws \Exception
     */
    protected function getPatterns(OutgoingRoutingInterface $outgoingRouting)
    {
        $routingPatterns = array();

        if ($outgoingRouting->getType() === 'group') {
            $patterns = $outgoingRouting->getRoutingPatternGroup()->getRoutingPatterns();
            $routingPatterns = array_merge($routingPatterns, $patterns);
        } elseif ($outgoingRouting->getType() === 'pattern') {
            $routingPatterns[] = $outgoingRouting->getRoutingPattern();
        } elseif ($outgoingRouting->getType() === 'fax') {
            $routingPatterns[] = null;
        } else {
            throw new \Exception('Incorrect Outgoing Routing Type');
        }

        return $routingPatterns;
    }
    /**
     * @param OutgoingRoutingInterface $entity
     * @param RoutingPatternInterface|null $pattern
     * @return LcrRuleInterface
     */
    protected function addLcrRulePerPattern(
        OutgoingRoutingInterface $entity,
        RoutingPatternInterface $pattern = null
    ) {
        $lcrRuleDto = LcrRule::createDTO();
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

        $lcrRule = LcrRule::fromDTO($lcrRuleDto);
        $lcrRule->setCondition($condition);

        // Setting Outgoing Routing also sets from_uri (see model)
        $lcrRule->setOutgoingRouting($entity);

        $this
            ->entityPersister
            ->persist($lcrRule, true);

        return $lcrRule;
    }

}