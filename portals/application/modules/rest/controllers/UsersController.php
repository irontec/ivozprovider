<?php
/**
 * Users
 */

use IvozProvider\Model as Models;
use IvozProvider\Mapper\Sql as Mappers;

class Rest_UsersController extends Iron_Controller_Rest_BaseController
{

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

        $detour = $this->getRequest()->getParam('detour', false);
        $user = $this->_getAuthUser();

        $data = array();
        $where = array();
        $where[] = 'companyId = "' . $user->getCompanyId() . '"';

        if ($detour !== false) {

            $callFS = new Mappers\CallForwardSettings();
            $detourData = $callFS->find($detour);
            $voiceManId = $detourData->getVoiceMailUserId();

            $inWhere = array(
                '"' . $voiceManId . '"',
                '"' . $user->getId() . '"'
            );

            $where[] = ' id in (' . implode(',', $inWhere) . ')';

        } else {
            $where[] = ' id = "' . $user->getId() . '"';
        }

        $mapper = new Mappers\Users();
        $users = $mapper->fetchList(
            implode(' AND ', $where)
        );

        if (!empty($users)) {

            foreach ($users as $user) {
                $data[] = $user->toArrayPortalForm();
            }

            $this->addViewData($data);
            $this->status->setCode(200);

        } else {
            $this->addViewData(array());
            $this->status->setCode(204);
        }

    }

    public function getAction()
    {

        $user = $this->_getAuthUser();
        $primaryKey = $user->getId();

        if ($primaryKey === false) {
            $this->addViewData(array());
            $this->status->setCode(204);
            return;
        }

        $mapper = new Mappers\Users();
        $item = $mapper->find($primaryKey);

        if (empty($item)) {
            $this->status->setCode(404);
            return;
        }

        $this->status->setCode(200);
        $this->addViewData($item->toArray());

    }

    public function putAction()
    {

        $user = $this->_getAuthUser();
        $params = $this->getRequest()->getParams();

        $mapper = new Mappers\Users();
        $model = $mapper->find($user->getId());

        if (empty($model)) {
            $this->status->setCode(404);
            return;
        }

        try {
            $model = $this->_setParams($model, $params);
            $model->save();
            $this->status->setCode(204);
        } catch (\Exception $e) {
            $this->addViewData(
                array('error' => 'Error al guardar los cambios.')
            );
            $this->status->setCode(404);
        }

    }

    protected function _setParams($model, $params)
    {

        if (!isset($params['formType'])) {
            throw new Zend_Exception(
                'Form is invalid.',
                409
            );
        }

        if ($params['formType'] === 'account') {
            return $this->_setParamsAccount($model, $params);
        } elseif ($params['formType'] === 'preferences') {
            return $this->_setParamsPreferences($model, $params);
        } else {
            throw new Zend_Exception(
                'Form is invalid.',
                409
            );
        }

    }

    protected function _setParamsAccount($model, $params)
    {

        $model->setName($params['name']);
        $model->setLastname($params['lastname']);
        $model->setEmail($params['email']);

        /**
         * currentPass
         * newPass
         * repeatPass
        */
        if (isset($params['changePass']) && $params['changePass']) {

            $token = md5(md5($params['currentPass']));
            $currentToken = $model->getTokenKey();
            if ($currentToken !== $token) {
                throw new Zend_Exception(
                    'Current password is invalid.',
                    409
                );
            }

            $newPass = $params['newPass'];
            $repeatPass = $params['repeatPass'];
            if ($newPass !== $repeatPass) {
                throw new Zend_Exception(
                    'New password not match.',
                    409
                );
            }

            $model->setPass($newPass);

        }

        return $model;

    }
    protected function _setParamsPreferences($model, $params)
    {

        $model->setTimeZoneId($params['timezoneId']);

        $model->setDoNotDisturb($params['doNotDisturb']);
        $model->setCallWaiting($params['callWaiting']);

        $bossAssistantId = $params['bossAssistantId'];
        $model->setBossAssistantId($bossAssistantId);

        if (empty($bossAssistantId)) {
            $model->setExceptionBoosAssistantRegExp('');
        } else {
            $model->setExceptionBoosAssistantRegExp($params['exceptionBoosAssistantRegExp']);
        }

        return $model;

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

    protected function _salt()
    {
        $ret = substr(md5(mt_rand(), false), 0, 8);

        return $ret;
    }

}