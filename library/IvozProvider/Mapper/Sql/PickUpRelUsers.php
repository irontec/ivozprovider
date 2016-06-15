<?php

/**
 * Application Model Mapper
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 * @copyright ZF model generator
 * @license http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * Data Mapper implementation for IvozProvider\Model\PickUpRelUsers
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 */
namespace IvozProvider\Mapper\Sql;
class PickUpRelUsers extends Raw\PickUpRelUsers
{
    protected function _save(\IvozProvider\Model\Raw\PickUpRelUsers $model,
                    $recursive = false, $useTransaction = true, $transactionTag = null, $forceInsert = false
                    )
    {
        $response = parent::_save($model, $recursive, $useTransaction, $transactionTag, $forceInsert);
        $this->_updateEndpointGroups($model->getUser());
        return $response;
    }

    /**
     * Deletes the current model
     *
     * @param IvozProvider\Model\Raw\PickUpRelUsers $model The model to delete
     * @see IvozProvider\Mapper\DbTable\TableAbstract::delete()
     * @return int
     */
    public function delete(\IvozProvider\Model\Raw\ModelAbstract $model)
    {
        $user = $model->getUser();
        $response = parent::delete($model);
        $this->_updateEndpointGroups($user);
        return $response;
    }

    /**
     * Update the endpoint pickup groups with related groups to the user
     * @param $user User who's endpoint will be updated
     */
    private function _updateEndpointGroups(\IvozProvider\Model\Raw\Users $user)
    {
        // Update the endpoint
        $endpoint = $user->getEndpoint();
        if ($endpoint) {
            $endpoint
            ->setPickupGroup($user->getPickUpGroupsIds())
            ->save();
        }
    }


}
