<?php
/**
 * kam_acc_cdrs
 */

use IvozProvider\Model as Models;
use IvozProvider\Mapper\Sql as Mappers;

class Rest_kam_acc_cdrsController extends Iron_Controller_Rest_BaseController
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
     * @ApiDescription(section="kam_acc_cdrs", description="GET information about all kam_acc_cdrs")
     * @ApiMethod(type="get")
     * @ApiRoute(name="/rest/kam_acc_cdrs/")
     * @ApiParams(name="page", type="int", nullable=true, description="", sample="")
     * @ApiParams(name="order", type="string", nullable=true, description="", sample="")
     * @ApiParams(name="search", type="json_encode", nullable=true, description="", sample="")
     * @ApiReturnHeaders(sample="HTTP 200 OK")
     * @ApiReturn(type="object", sample="[{
     *     'id': '', 
     *     'proxy': '', 
     *     'calldate': '', 
     *     'start_time': '', 
     *     'end_time': '', 
     *     'duration': '', 
     *     'caller': '', 
     *     'callee': '', 
     *     'referee': '', 
     *     'referrer': '', 
     *     'companyId': '', 
     *     'brandId': '', 
     *     'asIden': '', 
     *     'asAddress': '', 
     *     'callid': '', 
     *     'xcallid': '', 
     *     'parsed': '', 
     *     'diversion': '', 
     *     'peeringContractId': '', 
     *     'externallyRated': '', 
     *     'metered': '', 
     *     'meteringDate': '', 
     *     'pricingPlanId': '', 
     *     'targetPatternId': '', 
     *     'price': '', 
     *     'pricingPlanDetails': '', 
     *     'invoiceId': ''
     * },{
     *     'id': '', 
     *     'proxy': '', 
     *     'calldate': '', 
     *     'start_time': '', 
     *     'end_time': '', 
     *     'duration': '', 
     *     'caller': '', 
     *     'callee': '', 
     *     'referee': '', 
     *     'referrer': '', 
     *     'companyId': '', 
     *     'brandId': '', 
     *     'asIden': '', 
     *     'asAddress': '', 
     *     'callid': '', 
     *     'xcallid': '', 
     *     'parsed': '', 
     *     'diversion': '', 
     *     'peeringContractId': '', 
     *     'externallyRated': '', 
     *     'metered': '', 
     *     'meteringDate': '', 
     *     'pricingPlanId': '', 
     *     'targetPatternId': '', 
     *     'price': '', 
     *     'pricingPlanDetails': '', 
     *     'invoiceId': ''
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
                'proxy',
                'calldate',
                'startTime',
                'endTime',
                'duration',
                'caller',
                'callee',
                'referee',
                'referrer',
                'companyId',
                'brandId',
                'asIden',
                'asAddress',
                'callid',
                'xcallid',
                'parsed',
                'diversion',
                'peeringContractId',
                'externallyRated',
                'metered',
                'meteringDate',
                'pricingPlanId',
                'targetPatternId',
                'price',
                'pricingPlanDetails',
                'invoiceId',
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

        $etag = $this->_cache->getEtagVersions('kam_acc_cdrs');

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

        $mapper = new Mappers\kam_acc_cdrs();

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
     * @ApiDescription(section="kam_acc_cdrs", description="Get information about kam_acc_cdrs")
     * @ApiMethod(type="get")
     * @ApiRoute(name="/rest/kam_acc_cdrs/{id}")
     * @ApiParams(name="id", type="int", nullable=false, description="", sample="")
     * @ApiReturnHeaders(sample="HTTP 200 OK")
     * @ApiReturn(type="object", sample="{
     *     'id': '', 
     *     'proxy': '', 
     *     'calldate': '', 
     *     'start_time': '', 
     *     'end_time': '', 
     *     'duration': '', 
     *     'caller': '', 
     *     'callee': '', 
     *     'referee': '', 
     *     'referrer': '', 
     *     'companyId': '', 
     *     'brandId': '', 
     *     'asIden': '', 
     *     'asAddress': '', 
     *     'callid': '', 
     *     'xcallid': '', 
     *     'parsed': '', 
     *     'diversion': '', 
     *     'peeringContractId': '', 
     *     'externallyRated': '', 
     *     'metered': '', 
     *     'meteringDate': '', 
     *     'pricingPlanId': '', 
     *     'targetPatternId': '', 
     *     'price': '', 
     *     'pricingPlanDetails': '', 
     *     'invoiceId': ''
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
                'proxy',
                'calldate',
                'startTime',
                'endTime',
                'duration',
                'caller',
                'callee',
                'referee',
                'referrer',
                'companyId',
                'brandId',
                'asIden',
                'asAddress',
                'callid',
                'xcallid',
                'parsed',
                'diversion',
                'peeringContractId',
                'externallyRated',
                'metered',
                'meteringDate',
                'pricingPlanId',
                'targetPatternId',
                'price',
                'pricingPlanDetails',
                'invoiceId',
            );
        }

        $etag = $this->_cache->getEtagVersions('kam_acc_cdrs');
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

        $mapper = new Mappers\kam_acc_cdrs();
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
     * @ApiDescription(section="kam_acc_cdrs", description="Create's a new kam_acc_cdrs")
     * @ApiMethod(type="post")
     * @ApiRoute(name="/rest/kam_acc_cdrs/")
     * @ApiParams(name="proxy", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="calldate", nullable=false, type="timestamp", sample="", description="")
     * @ApiParams(name="start_time", nullable=false, type="datetime", sample="", description="")
     * @ApiParams(name="end_time", nullable=false, type="datetime", sample="", description="")
     * @ApiParams(name="duration", nullable=false, type="float", sample="", description="")
     * @ApiParams(name="caller", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="callee", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="referee", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="referrer", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="companyId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="brandId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="asIden", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="asAddress", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="callid", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="xcallid", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="parsed", nullable=true, type="enum('yes','no','delayed','error')", sample="", description="")
     * @ApiParams(name="diversion", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="peeringContractId", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="externallyRated", nullable=true, type="tinyint", sample="", description="")
     * @ApiParams(name="metered", nullable=true, type="tinyint", sample="", description="")
     * @ApiParams(name="meteringDate", nullable=true, type="datetime", sample="", description="")
     * @ApiParams(name="pricingPlanId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="targetPatternId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="price", nullable=true, type="decimal", sample="", description="")
     * @ApiParams(name="pricingPlanDetails", nullable=true, type="text", sample="", description="")
     * @ApiParams(name="invoiceId", nullable=true, type="int", sample="", description="")
     * @ApiReturnHeaders(sample="HTTP 201")
     * @ApiReturnHeaders(sample="Location: /rest/kam_acc_cdrs/{id}")
     * @ApiReturn(type="object", sample="{}")
     */
    public function postAction()
    {

        $params = $this->getRequest()->getParams();

        $model = new Models\kam_acc_cdrs();

        try {
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
     * @ApiDescription(section="kam_acc_cdrs", description="Table kam_acc_cdrs")
     * @ApiMethod(type="put")
     * @ApiRoute(name="/rest/kam_acc_cdrs/")
     * @ApiParams(name="id", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="proxy", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="calldate", nullable=false, type="timestamp", sample="", description="")
     * @ApiParams(name="start_time", nullable=false, type="datetime", sample="", description="")
     * @ApiParams(name="end_time", nullable=false, type="datetime", sample="", description="")
     * @ApiParams(name="duration", nullable=false, type="float", sample="", description="")
     * @ApiParams(name="caller", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="callee", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="referee", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="referrer", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="companyId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="brandId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="asIden", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="asAddress", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="callid", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="xcallid", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="parsed", nullable=true, type="enum('yes','no','delayed','error')", sample="", description="")
     * @ApiParams(name="diversion", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="peeringContractId", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="externallyRated", nullable=true, type="tinyint", sample="", description="")
     * @ApiParams(name="metered", nullable=true, type="tinyint", sample="", description="")
     * @ApiParams(name="meteringDate", nullable=true, type="datetime", sample="", description="")
     * @ApiParams(name="pricingPlanId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="targetPatternId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="price", nullable=true, type="decimal", sample="", description="")
     * @ApiParams(name="pricingPlanDetails", nullable=true, type="text", sample="", description="")
     * @ApiParams(name="invoiceId", nullable=true, type="int", sample="", description="")
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

        $mapper = new Mappers\kam_acc_cdrs();
        $model = $mapper->find($primaryKey);

        if (empty($model)) {
            $this->status->setCode(404);
            return;
        }

        try {
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
     * @ApiDescription(section="kam_acc_cdrs", description="Table kam_acc_cdrs")
     * @ApiMethod(type="delete")
     * @ApiRoute(name="/rest/kam_acc_cdrs/")
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

        $mapper = new Mappers\kam_acc_cdrs();
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
                'proxy' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'calldate' => array(
                    'type' => 'timestamp',
                    'required' => true,
                    'comment' => '',
                ),
                'start_time' => array(
                    'type' => 'datetime',
                    'required' => true,
                    'comment' => '',
                ),
                'end_time' => array(
                    'type' => 'datetime',
                    'required' => true,
                    'comment' => '',
                ),
                'duration' => array(
                    'type' => 'float',
                    'required' => true,
                    'comment' => '',
                ),
                'caller' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'callee' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'referee' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'referrer' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'companyId' => array(
                    'type' => 'int',
                    'required' => false,
                    'comment' => '',
                ),
                'brandId' => array(
                    'type' => 'int',
                    'required' => false,
                    'comment' => '',
                ),
                'asIden' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'asAddress' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'callid' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'xcallid' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'parsed' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'diversion' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'peeringContractId' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'externallyRated' => array(
                    'type' => 'tinyint',
                    'required' => false,
                    'comment' => '',
                ),
                'metered' => array(
                    'type' => 'tinyint',
                    'required' => false,
                    'comment' => '',
                ),
                'meteringDate' => array(
                    'type' => 'datetime',
                    'required' => false,
                    'comment' => '',
                ),
                'pricingPlanId' => array(
                    'type' => 'int',
                    'required' => false,
                    'comment' => '',
                ),
                'targetPatternId' => array(
                    'type' => 'int',
                    'required' => false,
                    'comment' => '',
                ),
                'price' => array(
                    'type' => 'decimal',
                    'required' => false,
                    'comment' => '',
                ),
                'pricingPlanDetails' => array(
                    'type' => 'text',
                    'required' => false,
                    'comment' => '',
                ),
                'invoiceId' => array(
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
                'proxy' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'calldate' => array(
                    'type' => 'timestamp',
                    'required' => true,
                    'comment' => '',
                ),
                'start_time' => array(
                    'type' => 'datetime',
                    'required' => true,
                    'comment' => '',
                ),
                'end_time' => array(
                    'type' => 'datetime',
                    'required' => true,
                    'comment' => '',
                ),
                'duration' => array(
                    'type' => 'float',
                    'required' => true,
                    'comment' => '',
                ),
                'caller' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'callee' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'referee' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'referrer' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'companyId' => array(
                    'type' => 'int',
                    'required' => false,
                    'comment' => '',
                ),
                'brandId' => array(
                    'type' => 'int',
                    'required' => false,
                    'comment' => '',
                ),
                'asIden' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'asAddress' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'callid' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'xcallid' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'parsed' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'diversion' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'peeringContractId' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'externallyRated' => array(
                    'type' => 'tinyint',
                    'required' => false,
                    'comment' => '',
                ),
                'metered' => array(
                    'type' => 'tinyint',
                    'required' => false,
                    'comment' => '',
                ),
                'meteringDate' => array(
                    'type' => 'datetime',
                    'required' => false,
                    'comment' => '',
                ),
                'pricingPlanId' => array(
                    'type' => 'int',
                    'required' => false,
                    'comment' => '',
                ),
                'targetPatternId' => array(
                    'type' => 'int',
                    'required' => false,
                    'comment' => '',
                ),
                'price' => array(
                    'type' => 'decimal',
                    'required' => false,
                    'comment' => '',
                ),
                'pricingPlanDetails' => array(
                    'type' => 'text',
                    'required' => false,
                    'comment' => '',
                ),
                'invoiceId' => array(
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
