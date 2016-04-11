<?php

class Provision_IndexController extends Zend_Controller_Action
{

    protected $_allowedVariables = array(
            'mac'=>array(
                    'mapperName' => 'Oasis\Mapper\Sql\Terminals',
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
        
        if( $_SERVER['SSL_CLIENT_CERT']) {
            $terminalUrl = $this->getRequest()->getParam('requested_url');
            
            $path = $this->_getFilePath();
            
            $terminalMapper = new \Oasis\Mapper\Sql\TerminalModels();
            $terminalModel = $this->_searchGenericPattern($terminalMapper, $terminalUrl);
            
            if ( $terminalModel == null ) {
                $data = $this->_searchSpecificPattern($terminalMapper, $terminalUrl);
                if($data) {
                    $terminalModel = $data['terminalModel'];
                    $urlVariables = $data['urlVariables'];
                    
                    $userMapper = new \Oasis\Mapper\Sql\Users();
                    
                    foreach( $this->_allowedVariables as $key=>$variable){
                        $mapper = new $variable['mapperName']();
                        $model = $mapper->findOneByField($variable['field'], $urlVariables[$key]);
                        if($model){
                            if($model instanceof Oasis\Model\Terminals){
                                $userModel = $userMapper->findOneByField('terminalId', $model->getId() );
                                $this->view->user = $userModel;
                                
                                $companyModel = $model->getCompany();
                                $this->view->company = $companyModel;
                                
                                $brandModel = $companyModel->getBrand();
                                $this->view->brand = $brandModel;
                                
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
                    $this->_error('TerminalModel not found', 'Not found', $errorNumber);
                }
            }
            else{
                $this->_renderPage('generic', $path, $terminalModel);
            }
        }
        else{
            $this->_error('Trying to access without certificate', 'Forbidden', 403);
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
        $this->logger->debug($template . ' url match found');
        $this->logger->debug('Response: ' . $this->view->render($template . '.phtml'));
        $this->render($template, 'page', true);
    }
    
    protected function _searchGenericPattern(\Oasis\Mapper\Sql\TerminalModels $terminalMapper, $terminalUrl){
        $terminalModel = $terminalMapper->findOneByField('genericUrlPattern', $terminalUrl );
        
        if ( $terminalModel == null ) {
            $terminalModel = $terminalMapper->findOneByField('genericUrlPattern', '/' . $terminalUrl );
        }
        return $terminalModel;
    }
    
    protected function _searchSpecificPattern(\Oasis\Mapper\Sql\TerminalModels $terminalMapper, $terminalUrl){
        $urlVariables = array();
        $terminalModels = $terminalMapper->fetchAll();
        foreach($terminalModels as $terminalModel){
            $urlPattern = $terminalModel->getSpecificUrlPattern();
            if( $urlPattern != ''){
                foreach($this->_allowedVariables as $variable=>$attributes){
                    $urlPattern = str_replace( '{' . $variable . '}', '(.*)', $urlPattern, $count);
                    if( $count > 0 ){
                        $urlVariables[$variable] = ''; 
                    }
                }
                $urlPattern = str_replace( '/', '\/', $urlPattern);
                if( preg_match('/' . $urlPattern . '/', '/'. $terminalUrl, $match)){
                    $urlVariables = $this->_joinKeyValues($urlVariables, $match);
                    $this->logger->debug('Url params: ' . implode(';', $urlVariables));
                    return array( 'terminalModel' => $terminalModel, 'urlVariables' => $urlVariables);
                }
                elseif (preg_match('/' . $urlPattern . '/', $terminalUrl, $match)){
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