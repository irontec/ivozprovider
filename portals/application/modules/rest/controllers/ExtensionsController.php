<?php
/**
 * Extensions
 */

use IvozProvider\Model as Models;
use IvozProvider\Mapper\Sql as Mappers;

class Rest_ExtensionsController extends Iron_Controller_Rest_BaseController
{

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

        $data = array();
        $where = array(
            'companyId = ?' => $user->getCompanyId()
        );

        $mapper = new Mappers\Extensions();
        $extensions = $mapper->fetchList($where);

        if (!empty($extensions)) {

            foreach ($extensions as $extension) {
                $data[] = $extension->toArrayPortal();
            }

            $this->addViewData($data);
            $this->status->setCode(200);
        } else {
            $this->addViewData(array());
            $this->status->setCode(204);
        }

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