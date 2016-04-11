<?php
namespace Oasis\Klear\Dynamic\Config;

use Oasis\Mapper\Sql\Companies;
class CompanyAdmin extends Base
{

    protected $_title = '[Company Admin]';
    protected $_subTitle = '[admin operator session]';
    protected $_year = '2015';

    protected $_sessionName = 'CompanyAdminSession';
    protected $_userMapper = 'Oasis\Klear\Auth\CompanyAdmins\Mapper';
    
    public function postInit()
    {

        if ($this->_user) {
            $this->_title = '[' . $this->_user->companyName . ']';
            $this->_subTitle = "Main Operator: <strong>". $this->_user->getusername()."</strong>";
        }
        
    }
}