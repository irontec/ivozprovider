<?php
/**
 * Auth
 */

use IvozProvider\Model as Models;
use IvozProvider\Mapper\Sql as Mappers;

class Userweb_AuthController extends Iron_Controller_Rest_BaseController
{
    public function headAction()
    {
        $this->status->setCode(200);
    }

    public function optionsAction()
    {
        $options = array(
            'POST' => array()
        );

        $this->status->setCode(200);
        $this->addViewData($options);
    }

    public function postAction()
    {
        $user = $this->_getAuthUser();

        $result = array();
        $result['statusTerminal'] = false;
        $result['userAgent'] = false;
        $result['ipRegistered'] = false;

        $terminal = $user->getTerminal();

        if (!empty($terminal)) {

            $dbAdapter = Zend_Db_Table::getDefaultAdapter();
            $terminalName = $terminal->getName();

            $query = "SELECT user_agent, contact FROM kam_users_location";
            $query .= " WHERE username LIKE '" . $terminalName . "%'";

            $resultQuery = $dbAdapter->fetchAll($query);
            $restult = reset($resultQuery);

            if (!empty($restult)) {

                $ip = explode(';', $restult['contact']);

                $result['statusTerminal'] = true;
                $result['userAgent'] = $restult['user_agent'];
                $result['ipRegistered'] = $ip[0];
            }
        }

        $result['success'] = true;
        $result['message'] = 'Login Correcto';
        $result['userName'] = $user->getFullName();
        $result['companyName'] = $user->getCompany()->getName();

        $this->status->setCode(200);
        $this->addViewData($result);
    }

    protected function _getAuthUser()
    {
        $token = $this->getRequest()->getHeader('Authorization', false);
        $requestDate = $this->getRequest()->getHeader('Request-Date', false);

        $tokenParts = explode(' ', $token);

        $mapper = new Mappers\Users();

        $auth = new \Iron_Auth_RestHmac();
        $user = $auth->authenticate($tokenParts[1], $requestDate, $mapper, ['user' => 'email']);

        return $user;
    }
}
