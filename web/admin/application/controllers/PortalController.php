<?php

class PortalController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        $serverUrl = $this->view->serverUrl();
        /** @var \Ivoz\Core\Application\Service\DataGateway $dataGateway */
        $dataGateway = Zend_Registry::get('data_gateway');
        $brand = $dataGateway->findOneBy(
            \Ivoz\Provider\Domain\Model\BrandUrl\BrandUrl::class,
            [
                'BrandUrl.url = :url',
                [':url' => $serverUrl]
            ]
        );

        if (!$this->_isBrandValid($brand)) {
            throw new Exception('Page not found', 404);
        }


    }

    public function indexAction()
    {
        // action body
    }

    protected function _isBrandValid($brand)
    {

        if (empty($brand)) {
            return false;
        }

        if ($brand->getUrlType() !== 'user') {
            return false;
        }

        return true;

    }

}