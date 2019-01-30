<?php
namespace IvozProvider\Klear\Dynamic\Config;

use IvozProvider\Mapper\Sql\Companies;

class CompanyAdmin extends Base
{

    protected $_title = '[Company Admin]';
    protected $_subTitle = '[admin operator session]';

    protected $_sessionName = 'CompanyAdminSession';

    public function postInit()
    {
        if ($this->_user) {
            $this->_title = '[' . $this->_user->companyName . ']';
            $this->_subTitle = "Main Operator: <strong>". $this->_user->getusername()."</strong>";
        }
    }
}
