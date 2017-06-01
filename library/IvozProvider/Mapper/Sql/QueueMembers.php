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
 * Data Mapper implementation for IvozProvider\Model\QueueMembers
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 */
namespace IvozProvider\Mapper\Sql;
class QueueMembers extends Raw\QueueMembers
{
     protected function _save(\IvozProvider\Model\Raw\QueueMembers $model,
        $recursive = false, $useTransaction = true, $transactionTag = null, $forceInsert = false
    )
    {
        $pk = parent::_save($model, $recursive, $useTransaction, $transactionTag, $forceInsert);

        $user = $model->getUser();
        $userName = $user->getFullName();
        $userEndpointName = $user->getEndpoint()->getSorceryId();

        $queue = $model->getQueue();
        $company = $queue->getCompany();

        $queueMemberCode = sprintf("b%dc%dq%dm%d",
            $company->getBrandId(),
            $company->getId(),
            $queue->getId(),
            $model->getId()
        );

        $astQueueMembersMapper = new \IvozProvider\Mapper\Sql\AstQueueMembers();
        $astQueueMember = $astQueueMembersMapper->findOneByField('queueMemberId', $model->getId());
        $forceInsert = false;

        if (is_null($astQueueMember)) {
            $astQueueMember = new \IvozProvider\Model\AstQueueMembers();
            $forceInsert = true;
        }

        $astQueueMember
            ->setQueueMemberId($model->getId())
            ->setUniqueid($model->getId())
            ->setQueueName($model->getQueue()->getAstQueueName())
            ->setInterface(sprintf("Local/%d@queues", $model->getId()))
            ->setStateInterface(sprintf("PJSIP/%s", $userEndpointName))
            ->setPenalty($model->getPenalty())
            ->setMembername($queueMemberCode)
            ->save($forceInsert);

        return $pk;
    }

}
