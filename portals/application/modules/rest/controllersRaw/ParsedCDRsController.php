<?php
/**
 * ParsedCDRs
 */

use IvozProvider\Model as Models;
use IvozProvider\Mapper\Sql as Mappers;

class Rest_ParsedCDRsController extends Iron_Controller_Rest_BaseController
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
     * @ApiDescription(section="ParsedCDRs", description="GET information about all ParsedCDRs")
     * @ApiMethod(type="get")
     * @ApiRoute(name="/rest/parsed-c-d-rs/")
     * @ApiParams(name="page", type="int", nullable=true, description="", sample="")
     * @ApiParams(name="order", type="string", nullable=true, description="", sample="")
     * @ApiParams(name="search", type="json_encode", nullable=true, description="", sample="")
     * @ApiReturnHeaders(sample="HTTP 200 OK")
     * @ApiReturn(type="object", sample="[{
     *     'id': '', 
     *     'calldate': '', 
     *     'type': '', 
     *     'desc': '', 
     *     'src': '', 
     *     'src_dialed': '', 
     *     'src_duration': '', 
     *     'dst': '', 
     *     'dst_src_cid': '', 
     *     'dst_duration': '', 
     *     'fw_desc': '', 
     *     'ext_forwarder': '', 
     *     'int_forwarder': '', 
     *     'forward_to': '', 
     *     'referee': '', 
     *     'referrer': '', 
     *     'aleg': '', 
     *     'bleg': '', 
     *     'cleg': '', 
     *     'billCallID': '', 
     *     'billDuration': '', 
     *     'billDestination': '', 
     *     'externallyRated': '', 
     *     'metered': '', 
     *     'meteringDate': '', 
     *     'pricingPlanId': '', 
     *     'targetPatternId': '', 
     *     'price': '', 
     *     'pricingPlanDetails': '', 
     *     'invoiceId': '', 
     *     'peeringContractId': '', 
     *     'companyId': '', 
     *     'brandId': ''
     * },{
     *     'id': '', 
     *     'calldate': '', 
     *     'type': '', 
     *     'desc': '', 
     *     'src': '', 
     *     'src_dialed': '', 
     *     'src_duration': '', 
     *     'dst': '', 
     *     'dst_src_cid': '', 
     *     'dst_duration': '', 
     *     'fw_desc': '', 
     *     'ext_forwarder': '', 
     *     'int_forwarder': '', 
     *     'forward_to': '', 
     *     'referee': '', 
     *     'referrer': '', 
     *     'aleg': '', 
     *     'bleg': '', 
     *     'cleg': '', 
     *     'billCallID': '', 
     *     'billDuration': '', 
     *     'billDestination': '', 
     *     'externallyRated': '', 
     *     'metered': '', 
     *     'meteringDate': '', 
     *     'pricingPlanId': '', 
     *     'targetPatternId': '', 
     *     'price': '', 
     *     'pricingPlanDetails': '', 
     *     'invoiceId': '', 
     *     'peeringContractId': '', 
     *     'companyId': '', 
     *     'brandId': ''
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
                'calldate',
                'type',
                'desc',
                'src',
                'srcDialed',
                'srcDuration',
                'dst',
                'dstSrc',
                'dstDuration',
                'fwDesc',
                'extForwarder',
                'intForwarder',
                'forwardTo',
                'referee',
                'referrer',
                'aleg',
                'bleg',
                'cleg',
                'billCallID',
                'billDuration',
                'billDestination',
                'externallyRated',
                'metered',
                'meteringDate',
                'pricingPlanId',
                'targetPatternId',
                'price',
                'pricingPlanDetails',
                'invoiceId',
                'peeringContractId',
                'companyId',
                'brandId',
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

        $etag = $this->_cache->getEtagVersions('ParsedCDRs');

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

        $mapper = new Mappers\ParsedCDRs();

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
     * @ApiDescription(section="ParsedCDRs", description="Get information about ParsedCDRs")
     * @ApiMethod(type="get")
     * @ApiRoute(name="/rest/parsed-c-d-rs/{id}")
     * @ApiParams(name="id", type="int", nullable=false, description="", sample="")
     * @ApiReturnHeaders(sample="HTTP 200 OK")
     * @ApiReturn(type="object", sample="{
     *     'id': '', 
     *     'calldate': '', 
     *     'type': '', 
     *     'desc': '', 
     *     'src': '', 
     *     'src_dialed': '', 
     *     'src_duration': '', 
     *     'dst': '', 
     *     'dst_src_cid': '', 
     *     'dst_duration': '', 
     *     'fw_desc': '', 
     *     'ext_forwarder': '', 
     *     'int_forwarder': '', 
     *     'forward_to': '', 
     *     'referee': '', 
     *     'referrer': '', 
     *     'aleg': '', 
     *     'bleg': '', 
     *     'cleg': '', 
     *     'billCallID': '', 
     *     'billDuration': '', 
     *     'billDestination': '', 
     *     'externallyRated': '', 
     *     'metered': '', 
     *     'meteringDate': '', 
     *     'pricingPlanId': '', 
     *     'targetPatternId': '', 
     *     'price': '', 
     *     'pricingPlanDetails': '', 
     *     'invoiceId': '', 
     *     'peeringContractId': '', 
     *     'companyId': '', 
     *     'brandId': ''
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
                'calldate',
                'type',
                'desc',
                'src',
                'srcDialed',
                'srcDuration',
                'dst',
                'dstSrc',
                'dstDuration',
                'fwDesc',
                'extForwarder',
                'intForwarder',
                'forwardTo',
                'referee',
                'referrer',
                'aleg',
                'bleg',
                'cleg',
                'billCallID',
                'billDuration',
                'billDestination',
                'externallyRated',
                'metered',
                'meteringDate',
                'pricingPlanId',
                'targetPatternId',
                'price',
                'pricingPlanDetails',
                'invoiceId',
                'peeringContractId',
                'companyId',
                'brandId',
            );
        }

        $etag = $this->_cache->getEtagVersions('ParsedCDRs');
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

        $mapper = new Mappers\ParsedCDRs();
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
     * @ApiDescription(section="ParsedCDRs", description="Create's a new ParsedCDRs")
     * @ApiMethod(type="post")
     * @ApiRoute(name="/rest/parsed-c-d-rs/")
     * @ApiParams(name="calldate", nullable=false, type="timestamp", sample="", description="aleg timestamp")
     * @ApiParams(name="type", nullable=true, type="varchar", sample="", description="Call type")
     * @ApiParams(name="desc", nullable=true, type="varchar", sample="", description="Call description")
     * @ApiParams(name="src", nullable=true, type="varchar", sample="", description="Caller")
     * @ApiParams(name="src_dialed", nullable=true, type="varchar", sample="", description="Dialed Number")
     * @ApiParams(name="src_duration", nullable=true, type="int", sample="", description="aleg call duration")
     * @ApiParams(name="dst", nullable=true, type="varchar", sample="", description="Final Callee - bleg destination")
     * @ApiParams(name="dst_src_cid", nullable=true, type="varchar", sample="", description="CallerID seen by call destination")
     * @ApiParams(name="dst_duration", nullable=true, type="int", sample="", description="bleg call duration")
     * @ApiParams(name="fw_desc", nullable=true, type="varchar", sample="", description="Call forwarding description")
     * @ApiParams(name="ext_forwarder", nullable=true, type="varchar", sample="", description="aleg diversion")
     * @ApiParams(name="int_forwarder", nullable=true, type="varchar", sample="", description="bleg diversion")
     * @ApiParams(name="forward_to", nullable=true, type="varchar", sample="", description="Dialed number after forwarding")
     * @ApiParams(name="referee", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="referrer", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="aleg", nullable=true, type="varchar", sample="", description="aleg CallID")
     * @ApiParams(name="bleg", nullable=true, type="varchar", sample="", description="bleg CallID")
     * @ApiParams(name="cleg", nullable=true, type="varchar", sample="", description="cleg CallID")
     * @ApiParams(name="billCallID", nullable=true, type="varchar", sample="", description="Billable leg CallID")
     * @ApiParams(name="billDuration", nullable=true, type="int", sample="", description="Billable leg duration")
     * @ApiParams(name="billDestination", nullable=true, type="varchar", sample="", description="Billable leg destination")
     * @ApiParams(name="externallyRated", nullable=true, type="tinyint", sample="", description="1 for billable calls billed elsewhere")
     * @ApiParams(name="metered", nullable=true, type="tinyint", sample="", description="1 for billable calls with price set")
     * @ApiParams(name="meteringDate", nullable=true, type="datetime", sample="", description="")
     * @ApiParams(name="pricingPlanId", nullable=true, type="int", sample="", description="Pricing plan used for setting price")
     * @ApiParams(name="targetPatternId", nullable=true, type="int", sample="", description="Destination group for billable call")
     * @ApiParams(name="price", nullable=true, type="decimal", sample="", description="Final price for billable call")
     * @ApiParams(name="pricingPlanDetails", nullable=true, type="text", sample="", description="")
     * @ApiParams(name="invoiceId", nullable=true, type="int", sample="", description="Invoice for billable billed call")
     * @ApiParams(name="peeringContractId", nullable=true, type="int", sample="", description="Billable call used Peering Contract")
     * @ApiParams(name="companyId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="brandId", nullable=true, type="int", sample="", description="")
     * @ApiReturnHeaders(sample="HTTP 201")
     * @ApiReturnHeaders(sample="Location: /rest/parsedcdrs/{id}")
     * @ApiReturn(type="object", sample="{}")
     */
    public function postAction()
    {

        $params = $this->getRequest()->getParams();

        $model = new Models\ParsedCDRs();

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
     * @ApiDescription(section="ParsedCDRs", description="Table ParsedCDRs")
     * @ApiMethod(type="put")
     * @ApiRoute(name="/rest/parsed-c-d-rs/")
     * @ApiParams(name="id", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="calldate", nullable=false, type="timestamp", sample="", description="aleg timestamp")
     * @ApiParams(name="type", nullable=true, type="varchar", sample="", description="Call type")
     * @ApiParams(name="desc", nullable=true, type="varchar", sample="", description="Call description")
     * @ApiParams(name="src", nullable=true, type="varchar", sample="", description="Caller")
     * @ApiParams(name="src_dialed", nullable=true, type="varchar", sample="", description="Dialed Number")
     * @ApiParams(name="src_duration", nullable=true, type="int", sample="", description="aleg call duration")
     * @ApiParams(name="dst", nullable=true, type="varchar", sample="", description="Final Callee - bleg destination")
     * @ApiParams(name="dst_src_cid", nullable=true, type="varchar", sample="", description="CallerID seen by call destination")
     * @ApiParams(name="dst_duration", nullable=true, type="int", sample="", description="bleg call duration")
     * @ApiParams(name="fw_desc", nullable=true, type="varchar", sample="", description="Call forwarding description")
     * @ApiParams(name="ext_forwarder", nullable=true, type="varchar", sample="", description="aleg diversion")
     * @ApiParams(name="int_forwarder", nullable=true, type="varchar", sample="", description="bleg diversion")
     * @ApiParams(name="forward_to", nullable=true, type="varchar", sample="", description="Dialed number after forwarding")
     * @ApiParams(name="referee", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="referrer", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="aleg", nullable=true, type="varchar", sample="", description="aleg CallID")
     * @ApiParams(name="bleg", nullable=true, type="varchar", sample="", description="bleg CallID")
     * @ApiParams(name="cleg", nullable=true, type="varchar", sample="", description="cleg CallID")
     * @ApiParams(name="billCallID", nullable=true, type="varchar", sample="", description="Billable leg CallID")
     * @ApiParams(name="billDuration", nullable=true, type="int", sample="", description="Billable leg duration")
     * @ApiParams(name="billDestination", nullable=true, type="varchar", sample="", description="Billable leg destination")
     * @ApiParams(name="externallyRated", nullable=true, type="tinyint", sample="", description="1 for billable calls billed elsewhere")
     * @ApiParams(name="metered", nullable=true, type="tinyint", sample="", description="1 for billable calls with price set")
     * @ApiParams(name="meteringDate", nullable=true, type="datetime", sample="", description="")
     * @ApiParams(name="pricingPlanId", nullable=true, type="int", sample="", description="Pricing plan used for setting price")
     * @ApiParams(name="targetPatternId", nullable=true, type="int", sample="", description="Destination group for billable call")
     * @ApiParams(name="price", nullable=true, type="decimal", sample="", description="Final price for billable call")
     * @ApiParams(name="pricingPlanDetails", nullable=true, type="text", sample="", description="")
     * @ApiParams(name="invoiceId", nullable=true, type="int", sample="", description="Invoice for billable billed call")
     * @ApiParams(name="peeringContractId", nullable=true, type="int", sample="", description="Billable call used Peering Contract")
     * @ApiParams(name="companyId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="brandId", nullable=true, type="int", sample="", description="")
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

        $mapper = new Mappers\ParsedCDRs();
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
     * @ApiDescription(section="ParsedCDRs", description="Table ParsedCDRs")
     * @ApiMethod(type="delete")
     * @ApiRoute(name="/rest/parsed-c-d-rs/")
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

        $mapper = new Mappers\ParsedCDRs();
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
                'calldate' => array(
                    'type' => 'timestamp',
                    'required' => true,
                    'comment' => 'aleg timestamp',
                ),
                'type' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => 'Call type',
                ),
                'desc' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => 'Call description',
                ),
                'src' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => 'Caller',
                ),
                'src_dialed' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => 'Dialed Number',
                ),
                'src_duration' => array(
                    'type' => 'int',
                    'required' => false,
                    'comment' => 'aleg call duration',
                ),
                'dst' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => 'Final Callee - bleg destination',
                ),
                'dst_src_cid' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => 'CallerID seen by call destination',
                ),
                'dst_duration' => array(
                    'type' => 'int',
                    'required' => false,
                    'comment' => 'bleg call duration',
                ),
                'fw_desc' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => 'Call forwarding description',
                ),
                'ext_forwarder' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => 'aleg diversion',
                ),
                'int_forwarder' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => 'bleg diversion',
                ),
                'forward_to' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => 'Dialed number after forwarding',
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
                'aleg' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => 'aleg CallID',
                ),
                'bleg' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => 'bleg CallID',
                ),
                'cleg' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => 'cleg CallID',
                ),
                'billCallID' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => 'Billable leg CallID',
                ),
                'billDuration' => array(
                    'type' => 'int',
                    'required' => false,
                    'comment' => 'Billable leg duration',
                ),
                'billDestination' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => 'Billable leg destination',
                ),
                'externallyRated' => array(
                    'type' => 'tinyint',
                    'required' => false,
                    'comment' => '1 for billable calls billed elsewhere',
                ),
                'metered' => array(
                    'type' => 'tinyint',
                    'required' => false,
                    'comment' => '1 for billable calls with price set',
                ),
                'meteringDate' => array(
                    'type' => 'datetime',
                    'required' => false,
                    'comment' => '',
                ),
                'pricingPlanId' => array(
                    'type' => 'int',
                    'required' => false,
                    'comment' => 'Pricing plan used for setting price',
                ),
                'targetPatternId' => array(
                    'type' => 'int',
                    'required' => false,
                    'comment' => 'Destination group for billable call',
                ),
                'price' => array(
                    'type' => 'decimal',
                    'required' => false,
                    'comment' => 'Final price for billable call',
                ),
                'pricingPlanDetails' => array(
                    'type' => 'text',
                    'required' => false,
                    'comment' => '',
                ),
                'invoiceId' => array(
                    'type' => 'int',
                    'required' => false,
                    'comment' => 'Invoice for billable billed call',
                ),
                'peeringContractId' => array(
                    'type' => 'int',
                    'required' => false,
                    'comment' => 'Billable call used Peering Contract',
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
                'calldate' => array(
                    'type' => 'timestamp',
                    'required' => true,
                    'comment' => 'aleg timestamp',
                ),
                'type' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => 'Call type',
                ),
                'desc' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => 'Call description',
                ),
                'src' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => 'Caller',
                ),
                'src_dialed' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => 'Dialed Number',
                ),
                'src_duration' => array(
                    'type' => 'int',
                    'required' => false,
                    'comment' => 'aleg call duration',
                ),
                'dst' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => 'Final Callee - bleg destination',
                ),
                'dst_src_cid' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => 'CallerID seen by call destination',
                ),
                'dst_duration' => array(
                    'type' => 'int',
                    'required' => false,
                    'comment' => 'bleg call duration',
                ),
                'fw_desc' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => 'Call forwarding description',
                ),
                'ext_forwarder' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => 'aleg diversion',
                ),
                'int_forwarder' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => 'bleg diversion',
                ),
                'forward_to' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => 'Dialed number after forwarding',
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
                'aleg' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => 'aleg CallID',
                ),
                'bleg' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => 'bleg CallID',
                ),
                'cleg' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => 'cleg CallID',
                ),
                'billCallID' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => 'Billable leg CallID',
                ),
                'billDuration' => array(
                    'type' => 'int',
                    'required' => false,
                    'comment' => 'Billable leg duration',
                ),
                'billDestination' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => 'Billable leg destination',
                ),
                'externallyRated' => array(
                    'type' => 'tinyint',
                    'required' => false,
                    'comment' => '1 for billable calls billed elsewhere',
                ),
                'metered' => array(
                    'type' => 'tinyint',
                    'required' => false,
                    'comment' => '1 for billable calls with price set',
                ),
                'meteringDate' => array(
                    'type' => 'datetime',
                    'required' => false,
                    'comment' => '',
                ),
                'pricingPlanId' => array(
                    'type' => 'int',
                    'required' => false,
                    'comment' => 'Pricing plan used for setting price',
                ),
                'targetPatternId' => array(
                    'type' => 'int',
                    'required' => false,
                    'comment' => 'Destination group for billable call',
                ),
                'price' => array(
                    'type' => 'decimal',
                    'required' => false,
                    'comment' => 'Final price for billable call',
                ),
                'pricingPlanDetails' => array(
                    'type' => 'text',
                    'required' => false,
                    'comment' => '',
                ),
                'invoiceId' => array(
                    'type' => 'int',
                    'required' => false,
                    'comment' => 'Invoice for billable billed call',
                ),
                'peeringContractId' => array(
                    'type' => 'int',
                    'required' => false,
                    'comment' => 'Billable call used Peering Contract',
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
