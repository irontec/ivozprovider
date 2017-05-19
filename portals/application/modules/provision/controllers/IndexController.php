<?php

class Provision_IndexController extends Zend_Controller_Action
{
    protected $_firstMatch = 1;

    public $logger;

    public function init()
    {
        /* Initialize action controller here */
        $bootstrap = $this->_invokeArgs['bootstrap'];

        $this->logger = $bootstrap->getResource('log');

        $this->_logRequest();

    }

    public function indexAction()
    {
        // action body
    }

    public function templateAction()
    {
        $isHttps = isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']);
        $terminalUrl = $this->getRequest()->getParam('requested_url');
        $path = $this->_getFilePath();
        $terminalModelMapper = new \IvozProvider\Mapper\Sql\TerminalModels();
        $terminalModel = $this->_searchGenericPattern($terminalModelMapper, $terminalUrl);

        if ($terminalModel) {
            if ($isHttps) {
                return $this->_error(403);
            }
            return $this->_renderPage('generic', $path, $terminalModel);
        }

        if (!$isHttps) {
            return $this->_error(403);
        }

        $terminal = $this->_getTerminalByUrl($terminalUrl);
        if (!$terminal) {
            return $this->_error(404, 'Terminal not found');
        }

        $terminalModel = $terminal->getTerminalModel();
        if (!$terminalModel) {
            return $this->_error(404, 'TerminalModel not found');
        }

        $userMapper = new \IvozProvider\Mapper\Sql\Users();
        $userModel = $userMapper->findOneByField('terminalId', $terminal->getId() );
        $this->view->user = $userModel;

        $companyModel = $terminal->getCompany();
        $this->view->company = $companyModel;

        $brandModel = $companyModel->getBrand();
        $this->view->brand = $brandModel;
        $this->view->terminal = $terminal;

        $this->_renderPage('specific', $path, $terminalModel);
    }

    protected function _error($errorNumber, $logMessage = null)
    {
        if ($logMessage) {
            $this->logger->log($logMessage, Zend_Log::ERR);
        }

        $this->getResponse()
            ->clearHeaders()
            ->setHttpResponseCode($errorNumber)
            ->sendResponse();
    }

    protected function _renderPage($template, $path, $terminalModel) {

        $route = $path . DIRECTORY_SEPARATOR . "Provision_template" . DIRECTORY_SEPARATOR . $terminalModel->getId();
        $this->view->setScriptPath($route);
        $this->view->terminalModel = $terminalModel;
        $brand = $this->view->brand;
        $terminal = $this->view->terminal;
        if (!is_null($brand) && !is_null($terminal)) {
            $this->logger->debug('[b' . $brand->getId() . '] ' . $terminal->getMac() . ' ' . $template . ' url match found');
            $this->logger->debug('[b' . $brand->getId() . '] ' . $terminal->getMac() . " Response: \n" . $this->view->render($template . '.phtml'));
        } else {
            $this->logger->debug($template . ' url match found');
            $this->logger->debug('Response: ' . $this->view->render($template . '.phtml'));
        }
        $this->render($template, 'page', true);

        if ($terminal instanceof IvozProvider\Model\Terminals) {
            $now = \Zend_Date::now()->setTimezone('UTC');
            $terminal->setLastProvisionDate($now->toString('dd-MM-yyyy HH:mm:ss'));
            $terminal->save();
        }
    }

    protected function _searchGenericPattern(\IvozProvider\Mapper\Sql\TerminalModels $terminalMapper, $terminalUrl){
        $terminalModel = $terminalMapper->findOneByField('genericUrlPattern', $terminalUrl );

        if ( $terminalModel == null ) {
            $terminalModel = $terminalMapper->findOneByField('genericUrlPattern', '/' . $terminalUrl );
        }

        if ( $terminalModel == null ) {
            $terminalModel = $terminalMapper->findOneByField('genericUrlPattern', preg_replace("/^\//", "", $terminalUrl));
        }

        return $terminalModel;
    }

    /**
     * @param string $terminalUrl
     * @return \IvozProvider\Model\Terminals|null
     */
    protected function _getTerminalByUrl($terminalUrl)
    {
        $fileName = basename($terminalUrl);
        $fileExtensionPosition = strrpos($fileName, '.');
        if ($fileExtensionPosition) {
            $fileName = substr($fileName, 0, $fileExtensionPosition);
        }

        if (empty($fileName)) {
            return null;
        }

        $terminalMapper = new \IvozProvider\Mapper\Sql\Terminals();

        /**
         * @var IvozProvider\Model\Terminals $terminal
         */
        $terminal = $terminalMapper->findOneByField('mac', $fileName);

        if (!$terminal) {
            return null;
        }

        return $terminal;
    }

    protected function _getFilePath(){
        $bootstrap = \Zend_Controller_Front::getInstance()->getParam('bootstrap');
        $conf = (Object) $bootstrap->getOptions();
        $path = $conf->Iron['fso']['localStoragePath'];
        return $path;
    }

    private function _logRequest()
    {

        $module = $this->_request->getParam("module");
        $controller = $this->_request->getParam("controller");
        $action = $this->_request->getParam("action");

        $requestLog = $module . "/" . $controller . "::". $action;

        $params = $this->_request->getParams();

        foreach (array('module', 'controller', 'action') as $key) {
            unset($params[$key]);
        }

        $requestParamString = var_export($params, true);

        $requestLog .= " from " . $_SERVER["REMOTE_ADDR"];

        $this->logger->debug(
            "Requesting " . $requestLog
        );

        $resquestParams = str_replace("\n", "", $requestParamString);

        $this->logger->debug(
            "Request params: " . $resquestParams
        );
    }
}