<?php
namespace Ivoz\Kam\Domain\Service\TrunksLcrRule;

use Doctrine\Common\Collections\ArrayCollection;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRule;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleInterface;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRoutingInterface;
use Ivoz\Provider\Domain\Model\RoutingPattern\RoutingPatternInterface;
use Ivoz\Provider\Domain\Service\OutgoingRouting\OutgoingRoutingLifecycleEventHandlerInterface;

/**
 * Class UpdateByOutgoingRouting
 * @package Ivoz\Kam\Domain\Service\TrunksLcrRule
 */
class UpdateByOutgoingRouting implements OutgoingRoutingLifecycleEventHandlerInterface
{
    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    /**
     * @var CreateByOutgoingRoutingAndRoutingPattern
     */
    protected $lcrRuleFactory;

    public function __construct(
        EntityPersisterInterface $entityPersister,
        CreateByOutgoingRoutingAndRoutingPattern $lcrRuleFactory
    ) {
        $this->entityPersister = $entityPersister;
        $this->lcrRuleFactory = $lcrRuleFactory;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => 10
        ];
    }

    /**
     * @param OutgoingRoutingInterface $outgoingRouting
     */
    public function execute(OutgoingRoutingInterface $outgoingRouting)
    {
        // If edit, delete everything and fresh-start
        /** @var TrunksLcrRuleInterface[] $lcrRules */
        $lcrRules = $outgoingRouting->getLcrRules();
        foreach ($lcrRules as $lcrRule) {
            $this->entityPersister->remove($lcrRule);
            $outgoingRouting->removeLcrRule($lcrRule);
        }

        /**
         * @var TrunksLcrRuleInterface[] $lcrRules
         */
        $routingPatterns = $this->getPatterns($outgoingRouting);

        $lcrRules = new ArrayCollection();
        foreach ($routingPatterns as $routingPattern) {
            $lcrRule = $this->lcrRuleFactory->execute($outgoingRouting, $routingPattern);
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
        $routingPatterns = [];

        if ($outgoingRouting->getType() === 'group') {
            $patterns = $outgoingRouting->getRoutingPatternGroup()->getRoutingPatterns();
            $routingPatterns = $patterns;
        } elseif ($outgoingRouting->getType() === 'pattern') {
            $routingPatterns[] = $outgoingRouting->getRoutingPattern();
        } elseif ($outgoingRouting->getType() === 'fax') {
            $routingPatterns[] = null;
        } else {
            throw new \DomainException('Incorrect Outgoing Routing Type');
        }

        return $routingPatterns;
    }
}