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
 * Data Mapper implementation for Oasis\Model\GenericMusicOnHold
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 */
namespace Oasis\Mapper\Sql;

use Oasis\Gearmand\Jobs\Recoder;
class GenericMusicOnHold extends Raw\GenericMusicOnHold
{
    
    protected function _save(\Oasis\Model\Raw\GenericMusicOnHold $model,
            $recursive = false, $useTransaction = true, $transactionTag = null, $forceInsert = false
    )
    {
        $mustRecode = false;
        
        $fso = $model->fetchOriginalFile(false);
        
        if ($fso instanceof \Iron_Model_Fso && $fso->mustFlush()) {
            $mustRecode = true;
            $model->setStatus('pending');
        }
        
        $response = parent::_save($model,$recursive,$useTransaction,$transactionTag, $forceInsert);
        
        if ($mustRecode) {
            $recoderJob = new Recoder();
            $recoderJob
            ->setId($model->getPrimaryKey())
            ->setModelName("GenericMusicOnHold")
            ->send();
        }
        
        return $response;
    }

}
