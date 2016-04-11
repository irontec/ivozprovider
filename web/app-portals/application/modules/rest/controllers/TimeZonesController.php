<?php
/**
 * Calls
 */

use Oasis\Model as Models;
use Oasis\Mapper\Sql as Mappers;

class Rest_TimeZonesController extends Iron_Controller_Rest_BaseController
{

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

        $mapper = new Mappers\Timezones();
        $items = $mapper->fetchList(NULL, 'tz');

        $countItems = $mapper->countByQuery();

        $this->getResponse()->setHeader('totalItems', $countItems);

        if (empty($items)) {
            $this->addViewData(array());
            $this->status->setCode(204);
            return;
        }

        $data = array();

        foreach ($items as $item) {
            $data[] = $item->toArray();
        }

        $this->addViewData($data);
        $this->status->setCode(200);

    }

}