<?php
/**
 * Invoices
 */

use IvozProvider\Model as Models;
use IvozProvider\Mapper\Sql as Mappers;

class Rest_InvoicesController extends Iron_Controller_Rest_BaseController
{

    protected $_cache;
    protected $_limitPage = 10;

    public function init()
    {

        parent::init();

        $front = array();
        $back = array();
        $this->_cache = new Iron\Cache\Backend\Mapper($front, $back);

    }

    /**
     * @ApiDescription(section="Invoices", description="GET information about all Invoices")
     * @ApiMethod(type="get")
     * @ApiRoute(name="/rest/invoices/")
     * @ApiParams(name="page", type="int", nullable=true, description="", sample="")
     * @ApiParams(name="order", type="string", nullable=true, description="", sample="")
     * @ApiParams(name="search", type="json_encode", nullable=true, description="", sample="")
     * @ApiReturnHeaders(sample="HTTP 200 OK")
     * @ApiReturn(type="object", sample="[{
     *     'id': '', 
     *     'number': '', 
     *     'inDate': '', 
     *     'outDate': '', 
     *     'total': '', 
     *     'taxRate': '', 
     *     'totalWithTax': '', 
     *     'status': '', 
     *     'companyId': '', 
     *     'brandId': '', 
     *     'pdfFile': '', 
     *     'invoiceTemplateId': ''
     * },{
     *     'id': '', 
     *     'number': '', 
     *     'inDate': '', 
     *     'outDate': '', 
     *     'total': '', 
     *     'taxRate': '', 
     *     'totalWithTax': '', 
     *     'status': '', 
     *     'companyId': '', 
     *     'brandId': '', 
     *     'pdfFile': '', 
     *     'invoiceTemplateId': ''
     * }]")
     */
    public function indexAction()
    {

        $currentEtag = false;
        $ifNoneMatch = $this->getRequest()->getHeader('If-None-Match', false);

        $page = $this->getRequest()->getParam('page', 0);
        $orderParam = $this->getRequest()->getParam('order', false);
        $searchParams = $this->getRequest()->getParam('search', false);

        $fields = $this->getRequest()->getParam('fields', array());
        if (!empty($fields)) {
            $fields = explode(',', $fields);
        } else {
            $fields = array(
                'id',
                'number',
                'inDate',
                'outDate',
                'total',
                'taxRate',
                'totalWithTax',
                'status',
                'companyId',
                'brandId',
                //'pdfFileUrl:@profile', Cambia @profile por el profile del fso.ini
                'invoiceTemplateId',
            );
        }

        $order = $this->_prepareOrder($orderParam);
        $where = $this->_prepareWhere($searchParams);

        $limit = $this->_request->getParam("limit", $this->_limitPage);
        if ($limit > 250) {
            Throw new \Exception("limit argument cannot be larger than 250", 416);
        }

        $offset = $this->_prepareOffset(
            array(
                'page' => $page,
                'limit' => $limit
            )
        );

        $etag = $this->_cache->getEtagVersions('Invoices');

        $hashEtag = md5(
            serialize(
                array($fields, $where, $order, $this->_limitPage, $offset)
            )
        );
        $currentEtag = $etag . $hashEtag;

        if ($etag !== false) {
            if ($currentEtag === $ifNoneMatch) {
                $this->status->setCode(304);
                return;
            }
        }

        $mapper = new Mappers\Invoices();

        $items = $mapper->fetchList(
            $where,
            $order,
            $limit,
            $offset
        );

        $countItems = $mapper->countByQuery($where);

        $this->getResponse()->setHeader('totalItems', $countItems);

        if (empty($items)) {
            $this->status->setCode(204);
            return;
        }

        $data = array();

        foreach ($items as $item) {
            $data[] = $item->toArray($fields);
        }

        $this->addViewData($data);
        $this->status->setCode(200);

        if ($currentEtag !== false) {
            $this->_sendEtag($currentEtag);
        }
    }

    /**
     * @ApiDescription(section="Invoices", description="Get information about Invoices")
     * @ApiMethod(type="get")
     * @ApiRoute(name="/rest/invoices/{id}")
     * @ApiParams(name="id", type="int", nullable=false, description="", sample="")
     * @ApiReturnHeaders(sample="HTTP 200 OK")
     * @ApiReturn(type="object", sample="{
     *     'id': '', 
     *     'number': '', 
     *     'inDate': '', 
     *     'outDate': '', 
     *     'total': '', 
     *     'taxRate': '', 
     *     'totalWithTax': '', 
     *     'status': '', 
     *     'companyId': '', 
     *     'brandId': '', 
     *     'pdfFile': '', 
     *     'invoiceTemplateId': ''
     * }")
     */
    public function getAction()
    {
        $currentEtag = false;
        $primaryKey = $this->getRequest()->getParam('id', false);
        if ($primaryKey === false) {
            $this->status->setCode(404);
            return;
        }

        $fields = $this->getRequest()->getParam('fields', array());
        if (!empty($fields)) {
            $fields = explode(',', $fields);
        } else {
            $fields = array(
                'id',
                'number',
                'inDate',
                'outDate',
                'total',
                'taxRate',
                'totalWithTax',
                'status',
                'companyId',
                'brandId',
                //'pdfFileUrl:@profile', Cambia @profile por el profile del fso.ini
                'invoiceTemplateId',
            );
        }

        $etag = $this->_cache->getEtagVersions('Invoices');
        $hashEtag = md5(
            serialize(
                array($fields)
            )
        );
        $currentEtag = $etag . $primaryKey . $hashEtag;

        if (!empty($etag)) {
            $ifNoneMatch = $this->getRequest()->getHeader('If-None-Match', false);
            if ($currentEtag === $ifNoneMatch) {
                $this->status->setCode(304);
                return;
            }
        }

        $mapper = new Mappers\Invoices();
        $model = $mapper->find($primaryKey);

        if (empty($model)) {
            $this->status->setCode(404);
            return;
        }

        $this->status->setCode(200);
        $this->addViewData($model->toArray($fields));

        if ($currentEtag !== false) {
            $this->_sendEtag($currentEtag);
        }

    }

    /**
     * @ApiDescription(section="Invoices", description="Create's a new Invoices")
     * @ApiMethod(type="post")
     * @ApiRoute(name="/rest/invoices/")
     * @ApiParams(name="number", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="inDate", nullable=true, type="datetime", sample="", description="")
     * @ApiParams(name="outDate", nullable=true, type="datetime", sample="", description="")
     * @ApiParams(name="total", nullable=true, type="decimal", sample="", description="")
     * @ApiParams(name="taxRate", nullable=true, type="decimal", sample="", description="")
     * @ApiParams(name="totalWithTax", nullable=true, type="decimal", sample="", description="")
     * @ApiParams(name="status", nullable=true, type="varchar", sample="", description="[enum:waiting|processing|created|error]")
     * @ApiParams(name="companyId", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="brandId", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="pdfFile", nullable=true, type="int", sample="", description="[FSO]")
     * @ApiParams(name="invoiceTemplateId", nullable=true, type="int", sample="", description="")
     * @ApiReturnHeaders(sample="HTTP 201")
     * @ApiReturnHeaders(sample="Location: /rest/invoices/{id}")
     * @ApiReturn(type="object", sample="{}")
     */
    public function postAction()
    {

        $params = $this->getRequest()->getParams();

        $model = new Models\Invoices();

        try {
            if (!empty($_FILES['pdfFile'])) {
                $pdfFile = $_FILES['pdfFile'];
                $model->putPdfFile($pdfFile['tmp_name'], $pdfFile['name']);
            }

            $model->populateFromArray($params);
            $model->save();

            $this->status->setCode(201);

            $location = $this->location() . '/' . $model->getPrimaryKey();

            $this->getResponse()->setHeader('Location', $location);

        } catch (\Exception $e) {
            $this->addViewData(
                array('error' => $e->getMessage())
            );
            $this->status->setCode(404);
        }

    }

    /**
     * @ApiDescription(section="Invoices", description="Table Invoices")
     * @ApiMethod(type="put")
     * @ApiRoute(name="/rest/invoices/")
     * @ApiParams(name="id", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="number", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="inDate", nullable=true, type="datetime", sample="", description="")
     * @ApiParams(name="outDate", nullable=true, type="datetime", sample="", description="")
     * @ApiParams(name="total", nullable=true, type="decimal", sample="", description="")
     * @ApiParams(name="taxRate", nullable=true, type="decimal", sample="", description="")
     * @ApiParams(name="totalWithTax", nullable=true, type="decimal", sample="", description="")
     * @ApiParams(name="status", nullable=true, type="varchar", sample="", description="[enum:waiting|processing|created|error]")
     * @ApiParams(name="companyId", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="brandId", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="pdfFile", nullable=true, type="int", sample="", description="[FSO]")
     * @ApiParams(name="invoiceTemplateId", nullable=true, type="int", sample="", description="")
     * @ApiReturnHeaders(sample="HTTP 200")
     * @ApiReturn(type="object", sample="{}")
     */
    public function putAction()
    {

        $primaryKey = $this->getRequest()->getParam('id', false);

        if ($primaryKey === false) {
            $this->status->setCode(400);
            return;
        }

        $params = $this->getRequest()->getParams();

        $mapper = new Mappers\Invoices();
        $model = $mapper->find($primaryKey);

        if (empty($model)) {
            $this->status->setCode(404);
            return;
        }

        try {
            if (!empty($_FILES['pdfFile'])) {
                $pdfFile = $_FILES['pdfFile'];
                $model->putPdfFile($pdfFile['tmp_name'], $pdfFile['name']);
            }

            $model->populateFromArray($params);
            $model->save();

            $this->addViewData($model->toArray());
            $this->status->setCode(200);
        } catch (\Exception $e) {
            $this->addViewData(
                array('error' => $e->getMessage())
            );
            $this->status->setCode(404);
        }

    }

    /**
     * @ApiDescription(section="Invoices", description="Table Invoices")
     * @ApiMethod(type="delete")
     * @ApiRoute(name="/rest/invoices/")
     * @ApiParams(name="id", nullable=false, type="int", sample="", description="")
     * @ApiReturnHeaders(sample="HTTP 204")
     * @ApiReturn(type="object", sample="{}")
     */
    public function deleteAction()
    {

        $primaryKey = $this->getRequest()->getParam('id', false);

        if ($primaryKey === false) {
            $this->status->setCode(400);
            return;
        }

        $mapper = new Mappers\Invoices();
        $model = $mapper->find($primaryKey);

        if (empty($model)) {
            $this->status->setCode(404);
            return;
        }

        try {
            $model->delete();
            $this->status->setCode(204);
        } catch (\Exception $e) {
            $this->addViewData(
                array('error' => $e->getMessage())
            );
            $this->status->setCode(404);
        }

    }


    public function optionsAction()
    {

        $this->view->GET = array(
            'description' => '',
            'params' => array(
                'id' => array(
                    'type' => 'int',
                    'required' => true,
                    'comment' => '[pk]'
                )
            )
        );

        $this->view->POST = array(
            'description' => '',
            'params' => array(
                'number' => array(
                    'type' => 'varchar',
                    'required' => true,
                    'comment' => '',
                ),
                'inDate' => array(
                    'type' => 'datetime',
                    'required' => false,
                    'comment' => '',
                ),
                'outDate' => array(
                    'type' => 'datetime',
                    'required' => false,
                    'comment' => '',
                ),
                'total' => array(
                    'type' => 'decimal',
                    'required' => false,
                    'comment' => '',
                ),
                'taxRate' => array(
                    'type' => 'decimal',
                    'required' => false,
                    'comment' => '',
                ),
                'totalWithTax' => array(
                    'type' => 'decimal',
                    'required' => false,
                    'comment' => '',
                ),
                'status' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '[enum:waiting|processing|created|error]',
                ),
                'companyId' => array(
                    'type' => 'int',
                    'required' => true,
                    'comment' => '',
                ),
                'brandId' => array(
                    'type' => 'int',
                    'required' => true,
                    'comment' => '',
                ),
                'pdfFile' => array(
                    'type' => 'int',
                    'required' => false,
                    'comment' => '[FSO]',
                ),
                'invoiceTemplateId' => array(
                    'type' => 'int',
                    'required' => false,
                    'comment' => '',
                ),
            )
        );

        $this->view->PUT = array(
            'description' => '',
            'params' => array(
                'id' => array(
                    'type' => 'int',
                    'required' => true,
                    'comment' => '[pk]',
                ),
                'number' => array(
                    'type' => 'varchar',
                    'required' => true,
                    'comment' => '',
                ),
                'inDate' => array(
                    'type' => 'datetime',
                    'required' => false,
                    'comment' => '',
                ),
                'outDate' => array(
                    'type' => 'datetime',
                    'required' => false,
                    'comment' => '',
                ),
                'total' => array(
                    'type' => 'decimal',
                    'required' => false,
                    'comment' => '',
                ),
                'taxRate' => array(
                    'type' => 'decimal',
                    'required' => false,
                    'comment' => '',
                ),
                'totalWithTax' => array(
                    'type' => 'decimal',
                    'required' => false,
                    'comment' => '',
                ),
                'status' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '[enum:waiting|processing|created|error]',
                ),
                'companyId' => array(
                    'type' => 'int',
                    'required' => true,
                    'comment' => '',
                ),
                'brandId' => array(
                    'type' => 'int',
                    'required' => true,
                    'comment' => '',
                ),
                'pdfFile' => array(
                    'type' => 'int',
                    'required' => false,
                    'comment' => '[FSO]',
                ),
                'invoiceTemplateId' => array(
                    'type' => 'int',
                    'required' => false,
                    'comment' => '',
                ),
            )
        );
        $this->view->DELETE = array(
            'description' => '',
            'params' => array(
                'id' => array(
                    'type' => 'int',
                    'required' => true
                )
            )
        );

        $this->status->setCode(200);

    }
}