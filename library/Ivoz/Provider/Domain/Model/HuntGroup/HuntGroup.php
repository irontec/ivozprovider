<?php

namespace Ivoz\Provider\Domain\Model\HuntGroup;

use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\HuntGroupsRelUser\HuntGroupsRelUserInterface;
use Ivoz\Provider\Domain\Traits\RoutableTrait;

/**
 * HuntGroup
 */
class HuntGroup extends HuntGroupAbstract implements HuntGroupInterface
{
    use HuntGroupTrait;
    use RoutableTrait;

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

    protected function sanitizeValues()
    {
        $this->sanitizeRouteValues('NoAnswer');

        $isRingAll = $this->getStrategy() === HuntGroupInterface::STRATEGY_RINGALL;
        $nullTimeout = is_null($this->getRingAllTimeout());
        if ($isRingAll && $nullTimeout) {
            throw new \DomainException('Empty ring all timeout');
        }
    }

    /**
     * Get this Hungroup related users
     * @return \Ivoz\Provider\Domain\Model\User\UserInterface[]
     */
    public function getHuntGroupUsersArray()
    {
        $huntGroupUsersArray = array();

        /** @var HuntGroupsRelUserInterface[] $huntGroupRelUsers */
        $huntGroupRelUsers = $this->getHuntGroupsRelUsers(
            Criteria::create()->orderBy(['priority' => Criteria::ASC])
        );

        foreach ($huntGroupRelUsers as $huntGroupRelUser) {
            $user = $huntGroupRelUser->getUser();
            if (empty($user)) {
                continue;
            }
            $huntGroupUsersArray[] = $user;
        }

        return $huntGroupUsersArray;
    }

    /**
     * @return string
     */
    public function getNoAnswerRouteType()
    {
        return $this->getNoAnswerTargetType();
    }

    /**
     * Get the timeout numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getNoAnswerNumberValueE164()
    {
        if (!$this->getNoAnswerNumberCountry()) {
            return "";
        }

        return
            $this->getNoAnswerNumberCountry()->getCountryCode() .
            $this->getNoAnswerNumberValue();
    }
}
