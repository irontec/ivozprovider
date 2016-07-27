<?php

class Provision_IndexController extends Zend_Controller_Action
{

    protected $_allowedVariables = array(
            'mac'=>array(
                    'mapperName' => 'IvozProvider\Mapper\Sql\Terminals',
                    'field'=>'mac',
                    'viewName'=>'terminal'
            )
         );
    protected $_firstMatch = 1;

    protected $_logActive;
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

       $terminalUrl = $this->getRequest()->getParam('requested_url');

       $path = $this->_getFilePath();

       $terminalMapper = new \IvozProvider\Mapper\Sql\TerminalModels();
       $terminalModel = $this->_searchGenericPattern($terminalMapper, $terminalUrl);

       if ( $terminalModel == null ) {

           if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != "on") {
               $this->_error('Trying to access using incorrect protocol', 'Forbidden', 403);
               return;
           }

           $data = $this->_searchSpecificPattern($terminalMapper, $terminalUrl);
           if($data) {
               $terminalModel = $data['terminalModel'];
               $urlVariables = $data['urlVariables'];

               $userMapper = new \IvozProvider\Mapper\Sql\Users();

               foreach( $this->_allowedVariables as $key=>$variable){
                   $mapper = new $variable['mapperName']();
                   $model = $mapper->findOneByField($variable['field'], $urlVariables[$key]);
                   if($model){
                       if($model instanceof IvozProvider\Model\Terminals){
                           $userModel = $userMapper->findOneByField('terminalId', $model->getId() );
                           $this->view->user = $userModel;

                           $companyModel = $model->getCompany();
                           $this->view->company = $companyModel;

                           $brandModel = $companyModel->getBrand();
                           $this->view->brand = $brandModel;

                           $this->view->terminal = $model;

                           $model->setLastProvisionDate(date("d-m-o h:i:s"));
                           $model->save();
                       }
                       $this->view->$variable['viewName'] = $model;
                   }
                   else{
                       $this->logger->log($variable['mapperName'] . $variable['field'] . ' = '. $urlVariables[$key] .' does not exist', Zend_Log::WARN);
                   }

               }

               $this->_renderPage('specific', $path, $terminalModel);
           }
           else{
               $this->_error('TerminalModel not found', 'Not found', 200);
           }
       }
       else{
           $this->_renderPage('generic', $path, $terminalModel);
       }
    }

    protected function _error( $logMessage, $errorMesage, $errorNumber){
        $this->logger->log($logMessage, Zend_Log::ERR);
        $this->getResponse()
            ->clearHeaders()
            ->setHttpResponseCode($errorNumber)
            ->appendBody($errorMesage)
            ->sendResponse();
    }

    protected function _renderPage($template, $path, $terminalModel){
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
    }

    protected function _searchGenericPattern(\IvozProvider\Mapper\Sql\TerminalModels $terminalMapper, $terminalUrl){
        $terminalModel = $terminalMapper->findOneByField('genericUrlPattern', $terminalUrl );

        if ( $terminalModel == null ) {
            $terminalModel = $terminalMapper->findOneByField('genericUrlPattern', '/' . $terminalUrl );
        }
        return $terminalModel;
    }

    protected function _searchSpecificPattern(\IvozProvider\Mapper\Sql\TerminalModels $terminalMapper, $terminalUrl){
        $urlVariables = array();
        $terminalModels = $terminalMapper->fetchAll();
        foreach($terminalModels as $terminalModel){
            $urlPattern = $terminalModel->getSpecificUrlPattern();
            if( $urlPattern != ''){
                /* FIXME the only thing that will be replaced in URL is mac. No need to loop over anything!!! */
                foreach($this->_allowedVariables as $variable=>$attributes){
                    // Replace '{mac}' in url for a hexadecimal pattern
                    $urlPattern = str_replace( '{' . $variable . '}', '([[:xdigit:]]+)', $urlPattern, $count);
                    if( $count > 0 ){
                        $urlVariables[$variable] = '';
                    }
                }
                $urlPattern = str_replace( '/', '\/', $urlPattern);
                if (preg_match('/' . $urlPattern . '/', $terminalUrl, $match)){
                    $urlVariables = $this->_joinKeyValues($urlVariables, $match);
                    $this->logger->debug('Url params: ' . implode(';', $urlVariables));
                    return array( 'terminalModel' => $terminalModel, 'urlVariables' => $urlVariables);
                }
            }
        }
        return null;
    }

    protected function _getFilePath(){
        $bootstrap = \Zend_Controller_Front::getInstance()->getParam('bootstrap');
        $conf = (Object) $bootstrap->getOptions();
        $path = $conf->Iron['fso']['localStoragePath'];
        return $path;
    }

    protected function _joinKeyValues($urlVariables, $match){
        $i = $this->_firstMatch;
        foreach($urlVariables as $key=>$value){
            if ( sizeof($match) > $i){
                $urlVariables[$key] = $match[$i];
                $i++;
            }
        }
        return $urlVariables;
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
