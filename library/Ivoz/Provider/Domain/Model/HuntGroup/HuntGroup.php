<?php

namespace Ivoz\Provider\Domain\Model\HuntGroup;

use Ivoz\Provider\Domain\Model\HuntGroupsRelUser\HuntGroupsRelUserInterface;
use Ivoz\Provider\Domain\Model\User\User;
use Doctrine\Common\Collections\Criteria;
use Ivoz\Provider\Domain\Model\User\UserInterface;

/**
 * HuntGroup
 */
class HuntGroup extends HuntGroupAbstract implements HuntGroupInterface
{
    use HuntGroupTrait;

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
        $nullableFields = array(
            'number'    => 'noAnswerNumberValue',
            'extension' => 'noAnswerExtension',
            'voicemail' => 'noAnswerVoiceMailUser'
        );

        $routeType = $this->getNoAnswerTargetType();
        foreach ($nullableFields as $type => $fieldName) {
            if ($routeType == $type) {
                continue;
            }
            $setter = 'set' . ucfirst($fieldName);
            $this->{$setter}(null);
        }
    }

    /**
     * Get this Hungroup related users
     * @return UserInterface[]
     */
    public function getHuntGroupUsersArray()
    {
        $huntGroupUsersArray = array();

        /** @var HuntGroupsRelUserInterface[] $huntGroupRelUsers */
        $huntGroupRelUsers = $this->getHuntGroupsRelUsers(
            Criteria::create()->orderBy(['priority' => Criteria::ASC])
        );

        foreach($huntGroupRelUsers as $huntGroupRelUser) {
            $user = $huntGroupRelUser->getUser();
            if (empty($user)) {
                continue;
            }
            $huntGroupUsersArray[] = $user;
        }

        return $huntGroupUsersArray;
    }

    /**
     * Get the timeout numberValue in E.164 format when routing to 'number'
     *
     * @return string
     */
    public function getNoAnswerNumberValueE164()
    {
        return
           // TODO $this->getNoAnswerNumberCountry()->getCountryCode() .
            $this->getNoAnswerNumberValue();
    }
}

