<?php
/***
 * File system object
*/
namespace IvozProvider\Model\Fso\Adapter\StoragePathResolver;
class MusicOnHold extends \Iron_Model_Fso_Adapter_StoragePathResolver_Default
{
    protected function _buildBasePath()
    {
        $basePath = parent::_buildBasePath() .
                    DIRECTORY_SEPARATOR .
                    $this->_model->getOwner();

        return strtolower($basePath);
    }
    
    protected function _buildFileTree()
    {
        return null;
    }
}
