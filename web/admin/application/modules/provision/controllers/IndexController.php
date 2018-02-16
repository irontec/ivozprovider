<?php

class Provision_IndexController extends Zend_Controller_Action
{
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
        if ($isHttps && $_SERVER['SERVER_PORT'] == 443) {
            return $this->_error(403, "No provisioning over 443");
        }
        $terminalUrl = $this->getRequest()->getParam('requested_url');
        $path = $this->_getFilePath();
        $terminalModelMapper = new \IvozProvider\Mapper\Sql\TerminalModels();
        $terminalModel = $this->_searchGenericPattern($terminalModelMapper, $terminalUrl);

        if ($terminalModel) {
            // Generic Template requests must be served over HTTP
            if ($isHttps) {
                return $this->_error(403);
            }
            return $this->_renderPage('generic', $path, $terminalModel);
        }

        // Specific Template requests must be served over HTTPS
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

        $this->view->user = $terminal->getUser();

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

    protected function _renderPage($template, $path, $terminalModel)
    {
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
        $fileName = $this->extractFileName($terminalUrl);
        $fileExtension = $this->extractFileExtension($terminalUrl);

        if (empty($fileName)) {
            return null;
        }

        $terminalMapper = new \IvozProvider\Mapper\Sql\Terminals();
        $macRegExp = '/(?=(([0-9a-f]{2}[:-]{0,1}){5}([0-9a-f]){2}))/i';
        preg_match_all($macRegExp, $fileName, $matches);
        $macCandidates = array_key_exists(1, $matches)
            ? $matches[1]
            : null;

        array_walk($macCandidates, function (&$value, $key) {
            // We only allow a-f0-9 for macs in database
            // ensure that format in results
            $value = preg_replace('/[^0-9a-f]/i', '', $value);
        });

        if (empty($macCandidates)) {
            return null;
        }

        /**
         * @var IvozProvider\Model\Terminals[] $terminals
         */
        $terminals = $terminalMapper->fetchList('mac in ("'. implode('","', $macCandidates) .'")');
        foreach ($terminals as $candidate) {

            /**
             * @var IvozProvider\Model\TerminalModels $terminalModel
             */
            $terminalModel = $candidate->getTerminalModel();
            if (!$terminalModel) {
                continue;
            }

            $specificUrl = $this->extractFileName(
                $terminalModel->getSpecificUrlPattern()
            );

            $specificUrlExtension = $this->extractFileExtension(
                $terminalModel->getSpecificUrlPattern()
            );

            $fixedUrlSegments = explode('{mac}', strtolower($specificUrl), 2);
            $fixedSpecificUrl = str_ireplace('{mac}', $candidate->getMac(), $specificUrl);

            $fixedFileName = $fileName;
            if (count($fixedUrlSegments) > 1) {

                $start = strlen($fixedUrlSegments[0]);
                $end = strlen($fixedUrlSegments[1]) * -1;

                $fileNameMac = $end < 0
                    ? substr($fileName, $start, $end)
                    : substr($fileName, $start);
                $fileNameMac = preg_replace('/[\:\-]/', '', $fileNameMac);

                $fixedFileName = $fixedUrlSegments[0] . $fileNameMac . $fixedUrlSegments[1];
            }

            if (strtolower($fixedSpecificUrl) === strtolower($fixedFileName)) {
                $extensionMismatch = ($fileExtension !== $specificUrlExtension);
                if (!empty($specificUrlExtension) && $extensionMismatch) {
                    continue;
                }

                return $candidate;
            }
        }

        return null;
    }

    protected function extractFileName($route)
    {
        return pathinfo($route, PATHINFO_FILENAME);
    }

    protected function extractFileExtension($route)
    {
        return pathinfo($route, PATHINFO_EXTENSION);
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