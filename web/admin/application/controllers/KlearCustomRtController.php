<?php

use IvozProvider\Utils\TokenHelper;

class KlearCustomRtController extends Zend_Controller_Action
{
    public function init()
    {
        /* Initialize action controller here */
        $this->_helper->ContextSwitch()
            ->addActionContext('trunks', 'json')
            ->addActionContext('users', 'json')
            ->initContext('json');


        if ((!$this->_mainRouter = $this->getRequest()->getParam("mainRouter")) ||
            (!is_object($this->_mainRouter)) ) {
            throw new Zend_Exception(
                'Restricted access',
                \Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION
            );
        }

        $this->_mainRouter = $this->getRequest()->getParam("mainRouter");
        $this->_item = $this->_mainRouter->getCurrentItem();
    }

    public function trunksAction()
    {
        $auth = Zend_Auth::getInstance();
        if (!$auth->hasIdentity()) {
            throw new Klear_Exception_Default("Session expired");
        }
        $user = $auth->getIdentity();

        if ($user->isTokenExpired()) {
            TokenHelper::renewToken(
                $user,
                $user->brandId
            );
        }

        $data = array();
        $data['screen'] = $this->_mainRouter->getCurrentItemName();
        $data['title'] = $this->_item->getTitle();
        $data['secret'] = $user->token;

        $config = $this->_mainRouter->getCurrentItem()->getConfig();
        $criteria = $config->getProperty("forcedValues");

        if ($criteria) {
            $criteria = $criteria->toArray();
            $template = '/template/klearCustomRtCallBrandList.tmpl.html';
            $templateIden = 'RtCallBrandList';
        } else {
            $criteria = [];
            $template = '/template/klearCustomRtCallList.tmpl.html';
            $templateIden = 'RtCallList';
        }

        $data['channel'] = [
            'trunks' => $criteria
        ];
        $data["template"] = $templateIden;
        $data['translations'] = $this->getTransalations();

        $jsonResponse = new Klear_Model_DispatchResponse();
        $jsonResponse->setModule('default');
        $jsonResponse->setPlugin('rt');
        $jsonResponse->addJsFile("/js/plugins/jquery.rt.js");
        $jsonResponse->addTemplate($template, $templateIden);
        $jsonResponse->addCssFile("/css/klearCustomRtCallList.tmpl.css");
        $jsonResponse->setData($data);
        $jsonResponse->attachView($this->view);
    }


    public function usersAction()
    {
        $auth = Zend_Auth::getInstance();
        if (!$auth->hasIdentity()) {
            throw new Klear_Exception_Default("Session expired");
        }
        $user = $auth->getIdentity();

        if ($user->isTokenExpired()) {
            TokenHelper::renewToken(
                $user,
                $user->brandId
            );
        }

        $data = array();
        $data['screen'] = $this->_mainRouter->getCurrentItemName();
        $data['title'] = $this->_item->getTitle();
        $data['secret'] = $user->token;

        $config = $this->_mainRouter->getCurrentItem()->getConfig();
        $criteria = $config->getProperty("forcedValues");

        if ($criteria) {
            $criteria = $criteria->toArray();
            $template = isset($criteria['c'])
                ? '/template/klearCustomRtCallClientList.tmpl.html'
                : '/template/klearCustomRtCallBrandList.tmpl.html';
        } else {
            $criteria = [];
            $template = '/template/klearCustomRtCallList.tmpl.html';
        }

        $data['channel'] = [
            'users' => $criteria
        ];

        $data['translations'] = $this->getTransalations();

        $templateIden = 'RtCallClientList';
        $data["template"] = $templateIden;

        $jsonResponse = new Klear_Model_DispatchResponse();
        $jsonResponse->setModule('default');
        $jsonResponse->setPlugin('rt');
        $jsonResponse->addJsFile("/js/plugins/jquery.rt.js");
        $jsonResponse->addTemplate($template, $templateIden);
        $jsonResponse->addCssFile("/css/klearCustomRtCallList.tmpl.css");
        $jsonResponse->setData($data);
        $jsonResponse->attachView($this->view);
    }

    private function getTransalations(): array
    {
        return [
            'checkDocumentation' => $this->_helper->translate(
                "Check documentation for this section"
            ),
            'listOf' => $this->_helper->translate('List of %s'),
            'activeCalls' => $this->_helper->translate('Active calls'),
            'total' => $this->_helper->translate('Total'),
            'calls' => $this->_helper->translate('Calls'),
            'duration' => $this->_helper->translate('Duration'),
            'brand' => $this->_helper->translate(array('Brand', 'Brands', 1)),
            'carrier' => $this->_helper->translate(array('Carrier', 'Carriers', 1)),
            'client' => $this->_helper->translate(array('Client', 'Clients', 1)),
            'caller' => $this->_helper->translate('Caller'),
            'callee' => $this->_helper->translate('Callee'),
            'connecting' => $this->_helper->translate('Connecting'),
            'loading' => $this->_helper->translate('Loading'),
            'noCalls' => $this->_helper->translate('No calls'),
            'owner' => $this->_helper->translate('Owner'),
            'party' => $this->_helper->translate('Party'),
            'min' => $this->_helper->translate('min'),
            'sec' => $this->_helper->translate('sec'),
        ];
    }
}
