<?php
namespace IvozProvider\Klear\Auth;

use IvozProvider\Mapper\Sql\Brands as BrandsMapper;
use IvozProvider\Model\Brands;

class Adapter implements \Klear_Auth_Adapter_KlearAuthInterface
{
    protected $_username;
    protected $_password;

    /**
     * @var Brands
     */
    protected $_currentBrand;

    /**
     *
     * @var Klear_Auth_Adapter_Interfaces_BasicUserModel
     */
    protected $_user;

    public function __construct(\Zend_Controller_Request_Abstract $request, \Klear_Model_ConfigParser $authConfig = null)
    {
        $this->_username = $request->getPost('username', '');
        $this->_password = $request->getPost('password', '');

        if (is_null($authConfig)) {
            return;
        }

        if ($authConfig->getProperty("brandId")) {
            $brandMapper = new BrandsMapper();
            $this->_brand = $brandMapper->find($authConfig->getProperty("brandId"));

            if (!$this->_brand instanceof Brands) {
                throw new \Klear_Exception_Default('Not a valid brand instanciated');
            }
        }

        $this->_initUserMapper($authConfig);
    }

    protected function _initUserMapper(\Klear_Model_ConfigParser $authConfig = null)
    {
        $userMapperName = false;
        if ($authConfig->exists('userMapper')) {
            $userMapperName = $authConfig->getProperty('userMapper');
        }

        if (empty($userMapperName)) {
            throw new \Klear_Exception_Default('userMapper not configured', 500);
        }

        $this->_userMapper = new $userMapperName;

        if (isset($this->_brand)) {
            $this->_userMapper->setBrand($this->_brand);
        }

        if (!$this->_userMapper instanceof \Klear_Auth_Adapter_Interfaces_BasicUserMapper) {
            throw new \Klear_Exception_Default('Auth userMapper must implement \Klear_Auth_Adapter_Interfaces_BasicUserMapper');
        }
    }

    public function authenticate()
    {
        try {

            $user = $this->_userMapper->findByLogin($this->_username);

            if ($this->_userHasValidCredentials($user) ) {

                $this->_user = $user;
                $authResult = \Zend_Auth_Result::SUCCESS;
                $authMessage = array("message"=>"Welcome!");
            } else {
                $authResult = \Zend_Auth_Result::FAILURE_CREDENTIAL_INVALID;
                $authMessage = array("message"=>"Usuario o contraseña incorrectos.");
            }
            return new \Zend_Auth_Result($authResult, $this->_username, $authMessage);
        } catch (Exception $e) {
            $authResult = \Zend_Auth_Result::FAILURE_UNCATEGORIZED;
            $authMessage['message'] = $e->getMessage();
            return new \Zend_Auth_Result($authResult, $this->_username, $authMessage);
        }
    }

    protected function _userHasValidCredentials(\Klear_Auth_Adapter_Interfaces_BasicUserModel $user = null)
    {
        if (!is_null($user)) {
            $hash = $user->getPassword();
            if ($user->isActive() && $this->_checkPassword($this->_password, $hash)) {
                return true;
            }
        }
        return false;
    }

    protected function _checkPassword($clearPass, $hash)
    {
        $hashParts = explode('$', trim($hash, '$'), 2);

        switch ($hashParts[0]) {

          case '1': //md5

              list(,,$salt,) = explode("$", $hash);
              $salt = '$1$' . $salt . '$';
              break;

          case '5': //sha

              list(,,$rounds,$salt,) = explode("$", $hash);
              $salt = '$5$' . $rounds . '$' . $salt . '$';
              break;

          case '2a': //blowfish

              $salt = substr($hash, 0, 29);
              break;
        }

        $res = crypt($clearPass, $salt . '$');

        return $res == $hash;
    }

    public function saveStorage()
    {
        $auth = \Zend_Auth::getInstance();
        $authStorage = $auth->getStorage();
        $this->_user->id = $this->_user->getId();
        $this->_user->isNotMainOperator = !$this->_user->isMainOperator;
        $this->_user->isBrandOperator = $this->_user->canSeeBrand && !$this->_user->canSeeMain;
        $this->_user->isNotBrandOperator = !$this->_user->isBrandOperator;
        $this->_user->isCompanyOperator = !$this->_user->canSeeBrand && $this->_user->canSeeCompany;
        $this->_user->isNotCompanyOperator = !$this->_user->isCompanyOperator;
        $authStorage->write($this->_user);
    }
}
