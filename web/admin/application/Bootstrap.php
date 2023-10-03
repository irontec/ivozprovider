<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    public function _initRouter()
    {
        $front = Zend_Controller_Front::getInstance();
        $front->setBaseUrl('/classic');

        $restRoute = new Zend_Rest_Route($front, array(), array('rest'));
        $front->getRouter()->addRoute('rest', $restRoute);

        $userwebRoute = new Zend_Rest_Route($front, array(), array('userweb'));
        $front->getRouter()->addRoute('userweb', $userwebRoute);

        $front->getRouter()->addRoute(
            'fso',
            new \Zend_Controller_Router_Route(
                '/fso/:profile/:routeMap',
                [
                    'controller' => 'fso',
                    'action' => 'index',
                    'module' => 'default',
                    'profile' => null,
                    'routeMap' => null
                ]
            )
        );
    }
}
