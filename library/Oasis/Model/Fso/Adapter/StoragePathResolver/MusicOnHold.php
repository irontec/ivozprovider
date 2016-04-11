<?php
/***
 * File system object
*/
namespace Oasis\Model\Fso\Adapter\StoragePathResolver;
class MusicOnHold extends \Iron_Model_Fso_Adapter_StoragePathResolver_Default
{
    protected function _buildBasePath()
    {
        $basePath = parent::_buildBasePath() .
                    DIRECTORY_SEPARATOR .
                    $this->_model->getCompanyId();

        return strtolower($basePath);
    }
}