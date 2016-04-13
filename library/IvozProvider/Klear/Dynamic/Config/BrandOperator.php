<?php
namespace IvozProvider\Klear\Dynamic\Config;

class BrandOperator extends Base
{

    protected $_title = '[Brand]';
    protected $_subTitle = '[brand operator session]';
    protected $_year = '2015';

    protected $_sessionName = 'BrandOperatorSession';
    protected $_userMapper = 'IvozProvider\Klear\Auth\BrandOperators\Mapper';


    public function postInit()
    {
        $this->_title = '[' . $this->_brand->getName(). ']';
        if ($this->_user) {
            $this->_subTitle = "Main Operator: <strong>". $this->_user->getusername()."</strong>";

            if ($this->_user->companyId) {
                //TODO: translate
                $this->_subTitle .= '<br /> Empresa emulada: ' . $this->_user->companyName;
            }
        }

    }
}