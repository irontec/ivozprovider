<?php
namespace IvozProvider\Klear\Dynamic\Config;

class BrandOperator extends Base
{

    protected $_title = '[Brand]';
    protected $_subTitle = '[brand operator session]';

    protected $_sessionName = 'BrandOperatorSession';


    public function postInit()
    {
        $this->_title = '[' . $this->_brand->getName(). ']';
        if ($this->_user) {
            $this->_subTitle = "Main Operator: <strong>". $this->_user->getusername()."</strong>";

            if ($this->_user->companyId) {
                $this->_subTitle .= sprintf('<br />Emulated client: <strong>%s</strong>', $this->_user->companyName);
            }
        }
    }
}
