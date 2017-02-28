<?php
namespace IvozProvider\Klear\Dynamic\Config;

class MainOperator extends Base
{

    protected $_title = '[Platform Administration Portal]';
    protected $_subTitle = '[global operator session]';

    protected $_sessionName = 'MainOperatorSession';
    protected $_userMapper = 'IvozProvider\Klear\Auth\MainOperators\Mapper';

    public function postInit()
    {
        if ($this->_user) {

            $this->_subTitle = "Operator: <strong>". $this->_user->getusername()."</strong>";

            if ($this->_user->brandId) {
                $this->_subTitle .= sprintf('<br />Emulated brand: <strong>%s</strong>', $this->_user->brandName);
            }

            if ($this->_user->companyId) {
                $this->_subTitle .= sprintf('<br />Emulated company: <strong>%s</strong>',  $this->_user->companyName);
            }
        }
    }

    public function processSignature($signature)
    {
        return $this->_brandURL->name;
    }
}
