<?php

class Provision_Bootstrap extends Zend_Application_Module_Bootstrap
{
    
    protected function _initRouting()
    {
        $frontController = Zend_Controller_Front::getInstance();
        $router = $frontController->getRouter();

           // crear una ruta que invoque el indexController, action=generic, con el id de modelo de terminal como parámetro
        $router->addRoute(
            'provision',
            new Zend_Controller_Router_Route_Regex(
                'provision/(.*)$',
                array(
                                'controller' => 'index',
                                'action' => 'template',
                                'module' => 'provision'
                        ),
                array(
                                1 => 'requested_url'
                        )
            )
        );
    }
}
