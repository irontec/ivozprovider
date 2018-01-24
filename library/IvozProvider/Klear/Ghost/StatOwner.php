<?php

use Ivoz\Kam\Domain\Model\UsersCdr\UsersCdrDto;
use Ivoz\Provider\Domain\Model\Friend\Friend;
use Ivoz\Provider\Domain\Model\Friend\FriendDto;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccount;
use Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountDto;
use Ivoz\Provider\Domain\Model\User\User;
use Ivoz\Provider\Domain\Model\User\UserDto;

class IvozProvider_Klear_Ghost_StatOwner extends KlearMatrix_Model_Field_Ghost_Abstract
{
    /**
     * @param UsersCdrDto $model
     * @return mixed
     * @throws Zend_Exception
     */
    public function getStatOwner(UsersCdrDto $model)
    {
        $dataGateway = \Zend_Registry::get('data_gateway');

        if (!is_null($model->getUserId())) {
            /** @var UserDto $user */
            $user = $dataGateway->find(
                User::class,
                $model->getUserId()
            );
            return $user->getName() . " " . $user->getLastname();
        }

        if (!is_null($model->getFriendId())) {
            /** @var FriendDto $friend */
            $friend = $dataGateway->find(
                Friend::class,
                $model->getFriendId()
            );

            return $friend->getName();
        }

        if (!is_null($model->getRetailAccountId())) {
            /** @var RetailAccountDto $retailAccount */
            $retailAccount = $dataGateway->find(
                RetailAccount::class,
                $model->getRetailAccountId()
            );
            return $retailAccount->getName();
        }

        return null;
    }
}
