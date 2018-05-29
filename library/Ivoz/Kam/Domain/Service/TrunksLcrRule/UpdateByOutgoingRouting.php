<?php
namespace Ivoz\Kam\Domain\Service\TrunksLcrRule;

use Doctrine\Common\Collections\ArrayCollection;
use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRule;
use Ivoz\Kam\Domain\Model\TrunksLcrRule\TrunksLcrRuleInterface;
use Ivoz\Kam\Domain\Service\TrunksLcrRuleTarget\CreateByOutgoingRouting;
use Ivoz\Provider\Domain\Model\OutgoingRouting\OutgoingRouting;
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

    /**
     * @var CreateByOutgoingRouting
     */
    protected $lcrRuleTargetFactory;


    public function __construct(
        EntityPersisterInterface $entityPersister,
        CreateByOutgoingRoutingAndRoutingPattern $lcrRuleFactory,
        CreateByOutgoingRouting $lcrRuleTargetFactory
    ) {
        $this->entityPersister = $entityPersister;
        $this->lcrRuleFactory = $lcrRuleFactory;
        $this->lcrRuleTargetFactory = $lcrRuleTargetFactory;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => 10
        ];
    }

    /**
     * @param OutgoingRoutingInterface $outgoingRouting
     * @throws \Exception
     */
    public function execute(OutgoingRoutingInterface $outgoingRouting)
    {
        // Check if any of the lcrRules has no pattern anymore
        $this->removeObsoleteLrcRules($outgoingRouting);

        //! Fax OutgoingRoutings have no routingPattern and a single LcrRule with NULL routingPatternId
        if ($outgoingRouting->getType() == OutgoingRouting::FAX) {
            $lcrRule = $this->lcrRuleFactory->execute($outgoingRouting, null);
            if ($lcrRule->hasChanged('id')) {
                $outgoingRouting->addLcrRule($lcrRule);
            }
            return;
        }

        // Create or update existing LcrRules based on actual RoutingPatterns of OutgoingRouting
        $routingPatterns = $outgoingRouting->getRoutingPatterns();
        $lcrRules = array();
        foreach ($routingPatterns as $routingPattern) {
            $lcrRules[] = $this->lcrRuleFactory->execute($outgoingRouting, $routingPattern);
        }
        $outgoingRouting->replaceLcrRules(new ArrayCollection($lcrRules));

        // Update TrunksLcrRuleTargets with updated/created TrunksLcrRules
        $this->lcrRuleTargetFactory->execute($outgoingRouting);
    }

    /**
     * @param OutgoingRoutingInterface $outgoingRouting
     * @return void
     * @throws \Exception
     */
    protected function removeObsoleteLrcRules(OutgoingRoutingInterface $outgoingRouting)
    {
        $lcrRules = $outgoingRouting->getLcrRules();

        foreach ($lcrRules as $lcrRule) {
            $pattern = $lcrRule->getRoutingPattern();

            // For fax LcrRules, just check is OutgoingRouting type is still Fax, or remove it
            if (is_null($pattern) && $outgoingRouting->getType() != OutgoingRouting::FAX) {
                $outgoingRouting->removeLcrRule($lcrRule);

                // For the rest of the LcrRules, check the lcrRule pattern is in the OutgoingRouting patterns, or remote it
            } else if (!$outgoingRouting->hasRoutingPattern($lcrRule->getRoutingPattern())) {
                $outgoingRouting->removeLcrRule($lcrRule);
            }
        }
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