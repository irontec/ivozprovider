<?php

namespace Ivoz\Provider\Domain\Model\HuntGroupMember;

use Ivoz\Core\Domain\Assert\Assertion;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface;
use Ivoz\Provider\Domain\Traits\RoutableTrait;

/**
 * HuntGroupMember
 */
class HuntGroupMember extends HuntGroupMemberAbstract implements HuntGroupMemberInterface
{
    use HuntGroupMemberTrait;
    use RoutableTrait;

    protected function sanitizeValues(): void
    {
        $huntGroup = $this->getHuntGroup();
        Assertion::notNull($huntGroup, 'huntGroup value is null, but non null value was expected.');

        $priorityRequired = !in_array(
            $huntGroup->getStrategy(),
            [
                HuntGroupInterface::STRATEGY_RINGALL,
                HuntGroupInterface::STRATEGY_RANDOM
            ],
            true
        );

        if ($priorityRequired) {
            Assertion::integerish(
                $this->getPriority(),
                'priority value "%s" is not an integer or a number castable to integer.'
            );
        }


        $timeOutRequired = !in_array(
            $huntGroup->getStrategy(),
            [
                HuntGroupInterface::STRATEGY_RINGALL
            ],
            true
        );

        if ($timeOutRequired) {
            Assertion::integerish(
                $this->getTimeoutTime(),
                'timeoutTime value "%s" is not an integer or a number castable to integer.'
            );
        }

        // Set Routable options to avoid naming collision
        $this->routeTypes = [
            'number',
            'user',
        ];

        $this->sanitizeRouteValues();
    }

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
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getNumberValueE164(): string
    {
        if (is_null($this->getNumberCountry())) {
            return "";
        }

        return
            $this->getNumberCountry()->getCountryCode() .
            $this->getNumberValue();
    }
}
