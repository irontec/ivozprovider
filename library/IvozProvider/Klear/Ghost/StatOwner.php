<?php

class IvozProvider_Klear_Ghost_StatOwner extends KlearMatrix_Model_Field_Ghost_Abstract
{
    /**
     * @param $model
     * @return mixed
     */
    public function getStatOwner(\Ivoz\Kam\Domain\Model\UsersCdr\UsersCdrDTO $model)
    {
        $dataGateway = \Zend_Registry::get('data_gateway');

        if (!is_null($model->getUserId())) {
            /** @var \Ivoz\Provider\Domain\Model\User\UserDTO $user */
            $user = $dataGateway->find(
                \Ivoz\Provider\Domain\Model\User\User::class,
                $model->getUserId()
            );
            return $user->getName() . " " . $user->getLastname();
        }

        if (!is_null($model->getFriendId())) {
            /** @var \Ivoz\Provider\Domain\Model\Friend\FriendDTO $friend */
            $friend = $dataGateway->find(
                \Ivoz\Provider\Domain\Model\Friend\Friend::class,
                $model->getFriendId()
            );

            return $friend->getName();
        }

        if (!is_null($model->getRetailAccountId())) {
            /** @var \Ivoz\Provider\Domain\Model\RetailAccount\RetailAccountDTO $retailAccount */
            $retailAccount = $dataGateway->find(
                \Ivoz\Provider\Domain\Model\RetailAccount\RetailAccount::class,
                $model->getRetailAccountId()
            );
            return $retailAccount->getName();
        }

        return null;
    }
}
