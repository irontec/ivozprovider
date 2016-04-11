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
 * Data Mapper implementation for Oasis\Model\MusicOnHold
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 */
namespace Oasis\Mapper\Sql;

use Oasis\Gearmand\Jobs\Recoder;
class MusicOnHold extends Raw\MusicOnHold
{
    protected function _save(\Oasis\Model\Raw\MusicOnHold $model,
            $recursive = false, $useTransaction = true, $transactionTag = null, $forceInsert = false
    )
    {
        $mustRecode = false;
        
        $fso = $model->fetchOriginalFile(false);

        if ($fso instanceof \Iron_Model_Fso && $fso->mustFlush()) {
            $mustRecode = true;
            // TODO: Set status a pending de reencoder (pending, encoding, ready, error)
            $model->setStatus('pending');
        }
        
        $response = parent::_save($model,$recursive,$useTransaction,$transactionTag, $forceInsert);

        if ($mustRecode) {
            $recoderJob = new Recoder();
            $recoderJob
                ->setId($model->getPrimaryKey())
                ->setModelName("MusicOnHold")
                ->send();
        }

        return $response;
    }

}
