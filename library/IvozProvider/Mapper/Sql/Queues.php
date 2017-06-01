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
 * Data Mapper implementation for IvozProvider\Model\Queues
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 */
namespace IvozProvider\Mapper\Sql;
class Queues extends Raw\Queues
{
     protected function _save(\IvozProvider\Model\Raw\Queues $model,
        $recursive = false, $useTransaction = true, $transactionTag = null, $forceInsert = false
    )
    {

        // Jquery UI Spinner doesn't allow null values
        if ($model->getMaxWaitTime() == 0) {
            $model->setMaxWaitTime(null);
        }
        if ($model->getMaxlen() == 0) {
            $model->setMaxlen(null);
        }

        $pk = parent::_save($model, $recursive, $useTransaction, $transactionTag, $forceInsert);


        $periodicAnnounceLocution = $model->getPeriodicAnnounceLocution();
        if (!is_null($periodicAnnounceLocution)) {
            $periodicAnnounceLocution = $periodicAnnounceLocution->getLocutionPath();
        }

        $astQueueName = $model->getAstQueueName();
        $astQueueMapper = new \IvozProvider\Mapper\Sql\AstQueues();
        $astQueue = $astQueueMapper->findOneByField('queueId', $model->getId());
        $forceInsert = false;

        if (is_null($astQueue)) {
            $astQueue = new \IvozProvider\Model\AstQueues();
            $forceInsert = true;
        }

        $astQueue
            ->setQueueId($model->getId())
            ->setName($astQueueName)
            ->setPeriodicAnnounce($periodicAnnounceLocution)
            ->setPeriodicAnnounceFrequency($model->getPeriodicAnnounceFrequency())
            ->setStrategy($model->getStrategy())
            ->setTimeout($model->getMemberCallTimeout())
            ->setWrapuptime($model->getMemberCallRest())
            ->setWeight($model->getWeight())
            ->setMaxlen($model->getMaxlen())
            ->save($forceInsert);

        return $pk;
    }

}
