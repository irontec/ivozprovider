<?php

namespace Ivoz\Provider\Domain\Service\MusicOnHold;

use Ivoz\Provider\Domain\Model\MusicOnHold\MusicOnHoldInterface;

/**
 * Class SanitizeValues
 * @package Ivoz\Provider\Domain\Service\MusicOnHold
 * @lifecycle pre_persist
 */
class SanitizeValues implements MusicOnHoldLifecycleEventHandlerInterface
{
    public function __construct() {}

    public function execute(MusicOnHoldInterface $entity)
    {
        /**
         * @todo
         */
        throw new \Exception('FSO not implemented yet');

//        $mustRecode = false;
//
//        $fso = $model->fetchOriginalFile(false);
//
//        if ($fso instanceof \Iron_Model_Fso && $fso->mustFlush()) {
//            $mustRecode = true;
//            // TODO: Set status a pending de reencoder (pending, encoding, ready, error)
//            $model->setStatus('pending');
//        }
//
//        $response = parent::_save($model,$recursive,$useTransaction,$transactionTag, $forceInsert);
//
//        if ($mustRecode) {
//            $recoderJob = new Recoder();
//            $recoderJob
//                ->setId($model->getPrimaryKey())
//                ->setModelName("MusicOnHold")
//                ->send();
//        }
//
//        return $response;
//    }
    }
}