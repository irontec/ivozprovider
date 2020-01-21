<?php
namespace Ivoz\Provider\Domain\Model\HuntGroupsRelUser;

use Ivoz\Core\Domain\Assert\Assertion;
use Ivoz\Provider\Domain\Model\HuntGroup\HuntGroupInterface;

/**
 * HuntGroupsRelUser
 */
class HuntGroupsRelUser extends HuntGroupsRelUserAbstract implements HuntGroupsRelUserInterface
{
    use HuntGroupsRelUserTrait;

    protected function sanitizeValues()
    {
        $huntGroup = $this->getHuntGroup();

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
    }

    /**
     * @codeCoverageIgnore
     * @return array
     */
    public function getChangeSet()
    {
        return parent::getChangeSet();
    }

    /**
     * Get id
     * @codeCoverageIgnore
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}
