<?php

namespace Agi\Action;

use Agi\Wrapper;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\ConditionalRoute\ConditionalRouteInterface;
use Ivoz\Provider\Domain\Model\ConditionalRoutesCondition\ConditionalRoutesConditionInterface;

class ConditionalRouteAction
{
    /**
     * @var Wrapper
     */
    protected $agi;

    /**
     * @var RouterAction
     */
    protected $routerAction;

    /**
     * @var ConditionalRouteInterface|null
     */
    protected $conditionalRoute;

    /**
     * ConditionalRouteAction constructor.
     *
     * @param Wrapper $agi
     * @param RouterAction $routerAction
     */
    public function __construct(
        Wrapper $agi,
        RouterAction $routerAction
    ) {
        $this->agi = $agi;
        $this->routerAction = $routerAction;
    }

    /**
     * @param ConditionalRouteInterface|null $conditionalRoute
     * @return $this
     */
    public function setConditionalRoute(ConditionalRouteInterface $conditionalRoute = null)
    {
        $this->conditionalRoute = $conditionalRoute;
        return $this;
    }

    public function process()
    {
        // Check route is defined
        $route = $this->conditionalRoute;

        if (is_null($route)) {
            $this->agi->error("Conditional Route is not properly defined. Check configuration.");
            return;
        }

        // Some feedback for asterisk cli
        $this->agi->notice("Processing conditional route <white>%s</white>", $route);

        // Set Default Route options
        $locution = $route->getLocution();

        // Configure router action with default handler
        $this->routerAction
            ->setRouteType($route->getRouteType())
            ->setRouteUser($route->getUser())
            ->setRouteIvr($route->getIvr())
            ->setRouteHuntGroup($route->getHuntGroup())
            ->setRouteVoicemail($route->getVoicemail())
            ->setRouteExternal($route->getNumberValueE164())
            ->setRouteFriendDestination($route->getFriendValue())
            ->setRouteQueue($route->getQueue())
            ->setRouteConferenceRoom($route->getConferenceRoom())
            ->setRouteExtension($route->getExtension());


        $criteria = new Criteria();
        $criteria->orderBy([ 'priority' => Criteria::ASC ]);

        /** @var ConditionalRoutesConditionInterface[] $conditions */
        $conditions = $route->getConditions($criteria);
        foreach ($conditions as $condition) {
            // Check origin matches route condition
            if (!$condition->matchesOrigin($this->agi->getCallerIdNum())) {
                continue;
            }

            // Check schedule matches route condition
            if (!$condition->matchesSchedule()) {
                continue;
            }

            // Check current day matches route condition
            if (!$condition->matchesCalendar()) {
                continue;
            }

            // Check any of the locks is open
            if (!$condition->matchesRouteLock()) {
                continue;
            }

            // Condition matches, change default route
            $this->agi->verbose("Conditional route priority %d matches all conditions.", $condition->getPriority());

            // All condition matches, route using its configuration
            $locution = $condition->getLocution();

            // Configure router action with condition handler
            $this->routerAction
                ->setRouteType($condition->getRouteType())
                ->setRouteUser($condition->getUser())
                ->setRouteIvr($condition->getIvr())
                ->setRouteHuntGroup($condition->getHuntGroup())
                ->setRouteVoicemail($condition->getVoicemail())
                ->setRouteExternal($condition->getNumberValueE164())
                ->setRouteFriendDestination($condition->getFriendValue())
                ->setRouteQueue($condition->getQueue())
                ->setRouteConferenceRoom($condition->getConferenceRoom())
                ->setRouteExtension($condition->getExtension());

            break;
        }

        // Play locution if requested
        $this->agi->playbackLocution($locution);

        // Route this!
        $this->routerAction->route();
    }
}
