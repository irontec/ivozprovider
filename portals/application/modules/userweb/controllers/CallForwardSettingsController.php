<?php
/**
 * CallForwardSettings
 */

use IvozProvider\Model as Models;
use IvozProvider\Mapper\Sql as Mappers;

class Userweb_CallForwardSettingsController extends Iron_Controller_Rest_BaseController
{

    public function optionsAction()
    {

        $this->view->GET = array();
        $this->view->POST = array();
        $this->view->PUT = array();
        $this->view->DELETE = array();

        $this->status->setCode(200);

    }

    public function indexAction()
    {

        $data = array();

        $user = $this->_getAuthUser();

        $where = array(
            'userId = ?' => $user->getId()
        );

        $mapper = new Mappers\CallForwardSettings();
        $list = $mapper->fetchList($where);

        if (!empty($list)) {
            foreach ($list as $item) {
                $data[] = $item->toArrayPortal();
            }
            $this->status->setCode(200);
        } else {
            $this->status->setCode(204);
        }

        $this->addViewData($data);

    }

    public function getAction()
    {

        $primaryKey = $this->getRequest()->getParam('id', false);

        if ($primaryKey === false) {
            $this->addViewData(array());
            $this->status->setCode(204);
            return;
        }

        $mapper = new Mappers\CallForwardSettings();
        $item = $mapper->find($primaryKey);

        if (empty($item)) {
            $this->status->setCode(404);
            return;
        }

        $this->status->setCode(200);
        $this->addViewData($item->toArrayPortal());

    }

    public function postAction()
    {

        $params = $this->getRequest()->getParams();

        $model = new Models\CallForwardSettings();

        try {

            $model = $this->_setParams($model, $params);
            $model->save();
            $this->status->setCode(201);

        } catch (\Exception $e) {
            $this->addViewData(
                array('error' => $e->getMessage())
            );
            $this->status->setCode(404);
        }

    }

    public function putAction()
    {

        $params = $this->getRequest()->getParams();

        $mapper = new Mappers\CallForwardSettings();
        $model = $mapper->find($params['id']);

        if (empty($model)) {
            $this->status->setCode(404);
            return;
        }

        try {
            $model = $this->_setParams($model, $params);
            $model->save();
            $this->status->setCode(200);
        } catch (\Exception $e) {
            $this->addViewData(
                array('error' => $e->getMessage())
            );
            $this->status->setCode(404);
        }

    }

    public function deleteAction()
    {

        $primaryKey = $this->getRequest()->getParam('id', false);

        if ($primaryKey === false) {
            $this->status->setCode(400);
            return;
        }

        $mapper = new Mappers\CallForwardSettings();
        $model = $mapper->find($primaryKey);

        if (empty($model)) {
            $this->status->setCode(204);
            return;
        }

        try {
            $model->delete();
        } catch (\Exception $e) {
            $this->addViewData(
                array('error' => $e->getMessage())
            );
            $this->status->setCode(404);
        } finally {
            $this->status->setCode(200);
        }

    }

    protected function _setParams($model, $params)
    {

        $user = $this->_getAuthUser();

        $model->setUserId($user->getId());

        if (isset($params['numberValue'])) {
            if (trim($params['numberValue']) != '') {
                $model->setNumberValue($params['numberValue']);
            }
        }

        if (isset($params['extensionId'])) {
            if (trim($params['extensionId']) != '') {
                $model->setExtensionId($params['extensionId']);
            }
        }

        if (isset($params['voiceMailUserId'])) {
            if (trim($params['voiceMailUserId']) != '') {
                $model->setVoiceMailUserId($params['voiceMailUserId']);
            }
        }

        if (isset($params['noAnswerTimeout'])) {
            if (trim($params['noAnswerTimeout']) != '') {
                $model->setNoAnswerTimeout($params['noAnswerTimeout']);
            }
        }

        $model->setCallTypeFilter($params['callTypeFilter']);
        $model->setCallForwardType($params['callForwardType']);
        $model->setTargetType($params['targetType']);
        $model->setEnabled($params['enabled']);

        return $model;

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