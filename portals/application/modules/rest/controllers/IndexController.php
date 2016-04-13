<?php
/**
 * Index
 */

use IvozProvider\Model as Models;
use IvozProvider\Mapper\Sql as Mappers;

class Rest_IndexController extends Iron_Controller_Rest_BaseController
{

    protected $_limitPage = 10;

    public function headAction()
    {
        $this->_response->setHttpResponseCode(200);
    }

    public function optionsAction()
    {

        $options = array(
            'GET' => array()
        );

        $this->_response->setHttpResponseCode(200);
        $this->_helper->json($options);

    }

    public function indexAction()
    {

        $user = $this->_getAuthUser();

        $countDetours = $this->_countDetours($user);
        $countCalls = $this->_countCalls($user);

        $data = array(
            'calls' => array('total' => $countCalls),
            'detours' => array('total' => $countDetours)
        );

        $this->addViewData($data);
        $this->status->setCode(200);

    }

    protected function _countDetours($user)
    {
        $where = array(
                'userId = ?' => $user->getId()
        );

        $mapper = new Mappers\CallForwardSettings();
        $countItems = $mapper->countByQuery($where);

        return $countItems;

    }

    protected function _countCalls($user)
    {

        $companyId = $user->getCompanyId();
        $extension = $user->getExtension();

        if (empty($extension)) {
            throw new Zend_Exception('extension not defined', 417);
        }

        $extensionNumber = $extension->getNumber();

        $where = $this->_prepareWhere(
            $companyId,
            $extensionNumber
        );

        $mapper = new Mappers\ParsedCDRs();
        $countItems = $mapper->countByQuery($where);

        return $countItems;
    }

    protected function _prepareWhere($companyId, $extension)
    {

        $prepareWhere = array();
        $prepareWhere[] = 'src = "' . $extension . '"';
        $prepareWhere[] = 'src_dialed = "' . $extension . '"';
        $prepareWhere[] = 'dst = "' . $extension . '"';
        $prepareWhere[] = 'dst_src_cid = "' . $extension . '"';
        $prepareWhere[] = 'ext_forwarder = "' . $extension . '"';
        $prepareWhere[] = 'oasis_forwarder = "' . $extension . '"';
        $prepareWhere[] = 'forward_to = "' . $extension . '"';

        $whereOrs = implode(' OR ', $prepareWhere);

        $whereUser = $whereOrs . ' AND companyId = "' . $companyId . '"';

        return $whereUser;

    }

    protected function _getAuthUser()
    {

        $token = $this->getRequest()->getHeader('Authorization', false);
        $requestDate = $this->getRequest()->getHeader('Request-Date', false);

        $tokenParts = explode(' ', $token);

        $mapper = new Mappers\Users();

        $auth = new \Iron_Auth_RestHmac();
        $user = $auth->authenticate($tokenParts[1], $requestDate, $mapper);

        return $user;

    }

}