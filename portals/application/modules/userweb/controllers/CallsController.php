<?php
/**
 * Calls
 */

use IvozProvider\Model as Models;
use IvozProvider\Mapper\Sql as Mappers;

class Userweb_CallsController extends Iron_Controller_Rest_BaseController
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

        $companyId = $user->getCompanyId();
        $extension = $user->getExtension();

        if (empty($extension)) {
            throw new Zend_Exception('extension not defined', 417);
        }

        $extensionNumber = $extension->getNumber();

        /**
         * Headers/Params
         */
        $page = $this->getRequest()->getHeader('page', 0);
        $orderParam = $this->getRequest()->getParam('order', false);
        $searchParams = $this->getRequest()->getParam('search', false);
        $csv = $this->getRequest()->getParam('csv', false);

        $order = $this->_prepareOrder($orderParam);
        $where = $this->_prepareCallsWhere(
            $companyId,
            $extensionNumber,
            $searchParams
        );

        $offset = $this->_prepareOffset(
            array(
                'page' => $page,
                'limit' => $this->_limitPage
            )
        );

        $mapper = new Mappers\ParsedCDRs();
        if ($csv == 'true') {

            $items = $mapper->fetchList(
                $where,
                $order
            );

        } else {

            $items = $mapper->fetchList(
                $where,
                $order,
                $this->_limitPage,
                $offset
            );

            $countItems = $mapper->countByQuery($where);

            $this->getResponse()->setHeader('totalItems', $countItems);
            $this->getResponse()->setHeader('range', '0-9');

        }

        if (empty($items)) {
            $this->addViewData(array());
            $this->status->setCode(204);
            return;
        }

        $data = array();

        foreach ($items as $item) {
            $data[] = $item->toArray();
        }

        $this->addViewData($data);
        $this->status->setCode(200);

    }

    protected function _prepareOffset($params = array())
    {
        if (isset($params["page"]) && $params["page"] > 0) {
            $offset = ($params["page"] - 1) * $params["limit"];
        } else {
            $offset = 0;
        }

        return $offset;
    }

    protected function _prepareOrder($orderParam)
    {

        if ($orderParam === false) {
            return 'calldate DESC';
        }

        if ($orderParam === '{}') {
            return 'calldate DESC';
        }

        if ($orderParam === '') {
            return 'calldate DESC';
        }

        return $orderParam;

    }

    protected function _prepareCallsWhere($companyId, $extension, $search)
    {

        $prepareWhere = array();
        $prepareWhere[] = 'aParty = "' . $extension . '"';
        $prepareWhere[] = 'bParty = "' . $extension . '"';
        $whereOrs = implode(' OR ', $prepareWhere);

        $whereUser = $whereOrs . ' AND companyId = "' . $companyId . '"';

        if ($search === false) {
            return $whereUser;
        }

        if ($search === '{}') {
            return $whereUser;
        }

        $search = json_decode($search);
        $itemsSearch = array();
        foreach ($search as $key => $val) {
            if ($val != '') {
                switch ($key) {
                    case 'calldate':
                        $newFrt = date('Y-m-d', strtotime($val));
                        $itemsSearch[] = 'DATE(calldate) = "' . $newFrt . '"';
                        break;

                    case 'desc':
                    case 'type':
                        $itemsSearch[] = '`' . $key . '` LIKE "%' . $val . '%"';
                        break;

                    default:
                        $itemsSearch[] = $key . ' = "' . $val . '"';
                        break;
                }

            }
        }

        if (empty($itemsSearch)) {
            return $whereUser;
        }

        $whereSearch = implode(' AND ', $itemsSearch);

        return '( ' . $whereUser . ' )' . ' AND ( ' . $whereSearch . ' )';

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
