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
     *     'statId': '', 
     *     'xstatId': '', 
     *     'statType': '', 
     *     'initialLeg': '', 
     *     'initialLegHash': '', 
     *     'cid': '', 
     *     'cidHash': '', 
     *     'xcid': '', 
     *     'xcidHash': '', 
     *     'proxies': '', 
     *     'type': '', 
     *     'subtype': '', 
     *     'calldate': '', 
     *     'duration': '', 
     *     'aParty': '', 
     *     'bParty': '', 
     *     'caller': '', 
     *     'callee': '', 
     *     'xCaller': '', 
     *     'xCallee': '', 
     *     'initialReferrer': '', 
     *     'referrer': '', 
     *     'referee': '', 
     *     'lastForwarder': '', 
     *     'brandId': '', 
     *     'companyId': '', 
     *     'peeringContractId': ''
     * },{
     *     'id': '', 
     *     'statId': '', 
     *     'xstatId': '', 
     *     'statType': '', 
     *     'initialLeg': '', 
     *     'initialLegHash': '', 
     *     'cid': '', 
     *     'cidHash': '', 
     *     'xcid': '', 
     *     'xcidHash': '', 
     *     'proxies': '', 
     *     'type': '', 
     *     'subtype': '', 
     *     'calldate': '', 
     *     'duration': '', 
     *     'aParty': '', 
     *     'bParty': '', 
     *     'caller': '', 
     *     'callee': '', 
     *     'xCaller': '', 
     *     'xCallee': '', 
     *     'initialReferrer': '', 
     *     'referrer': '', 
     *     'referee': '', 
     *     'lastForwarder': '', 
     *     'brandId': '', 
     *     'companyId': '', 
     *     'peeringContractId': ''
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
                'statId',
                'xstatId',
                'statType',
                'initialLeg',
                'initialLegHash',
                'cid',
                'cidHash',
                'xcid',
                'xcidHash',
                'proxies',
                'type',
                'subtype',
                'calldate',
                'duration',
                'aParty',
                'bParty',
                'caller',
                'callee',
                'xCaller',
                'xCallee',
                'initialReferrer',
                'referrer',
                'referee',
                'lastForwarder',
                'brandId',
                'companyId',
                'peeringContractId',
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
     *     'statId': '', 
     *     'xstatId': '', 
     *     'statType': '', 
     *     'initialLeg': '', 
     *     'initialLegHash': '', 
     *     'cid': '', 
     *     'cidHash': '', 
     *     'xcid': '', 
     *     'xcidHash': '', 
     *     'proxies': '', 
     *     'type': '', 
     *     'subtype': '', 
     *     'calldate': '', 
     *     'duration': '', 
     *     'aParty': '', 
     *     'bParty': '', 
     *     'caller': '', 
     *     'callee': '', 
     *     'xCaller': '', 
     *     'xCallee': '', 
     *     'initialReferrer': '', 
     *     'referrer': '', 
     *     'referee': '', 
     *     'lastForwarder': '', 
     *     'brandId': '', 
     *     'companyId': '', 
     *     'peeringContractId': ''
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
                'statId',
                'xstatId',
                'statType',
                'initialLeg',
                'initialLegHash',
                'cid',
                'cidHash',
                'xcid',
                'xcidHash',
                'proxies',
                'type',
                'subtype',
                'calldate',
                'duration',
                'aParty',
                'bParty',
                'caller',
                'callee',
                'xCaller',
                'xCallee',
                'initialReferrer',
                'referrer',
                'referee',
                'lastForwarder',
                'brandId',
                'companyId',
                'peeringContractId',
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
     * @ApiParams(name="statId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="xstatId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="statType", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="initialLeg", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="initialLegHash", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="cid", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="cidHash", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="xcid", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="xcidHash", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="proxies", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="type", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="subtype", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="calldate", nullable=false, type="timestamp", sample="", description="")
     * @ApiParams(name="duration", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="aParty", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="bParty", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="caller", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="callee", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="xCaller", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="xCallee", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="initialReferrer", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="referrer", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="referee", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="lastForwarder", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="brandId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="companyId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="peeringContractId", nullable=true, type="int", sample="", description="")
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
     * @ApiParams(name="statId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="xstatId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="statType", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="initialLeg", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="initialLegHash", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="cid", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="cidHash", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="xcid", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="xcidHash", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="proxies", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="type", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="subtype", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="calldate", nullable=false, type="timestamp", sample="", description="")
     * @ApiParams(name="duration", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="aParty", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="bParty", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="caller", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="callee", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="xCaller", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="xCallee", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="initialReferrer", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="referrer", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="referee", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="lastForwarder", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="brandId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="companyId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="peeringContractId", nullable=true, type="int", sample="", description="")
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
                    'type' => "int",
                    'required' => true,
                    'comment' => '[pk]'
                )
            )
        );

        $this->view->POST = array(
            'description' => '',
            'params' => array(
                'statId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'xstatId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'statType' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'initialLeg' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'initialLegHash' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'cid' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'cidHash' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'xcid' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'xcidHash' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'proxies' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'type' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'subtype' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'calldate' => array(
                    'type' => "timestamp",
                    'required' => true,
                    'comment' => '',
                ),
                'duration' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'aParty' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'bParty' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'caller' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'callee' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'xCaller' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'xCallee' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'initialReferrer' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'referrer' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'referee' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'lastForwarder' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'brandId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'companyId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'peeringContractId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
            )
        );

        $this->view->PUT = array(
            'description' => '',
            'params' => array(
                'id' => array(
                    'type' => "int",
                    'required' => true,
                    'comment' => '[pk]',
                ),
                'statId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'xstatId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'statType' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'initialLeg' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'initialLegHash' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'cid' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'cidHash' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'xcid' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'xcidHash' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'proxies' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'type' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'subtype' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'calldate' => array(
                    'type' => "timestamp",
                    'required' => true,
                    'comment' => '',
                ),
                'duration' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'aParty' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'bParty' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'caller' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'callee' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'xCaller' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'xCallee' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'initialReferrer' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'referrer' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'referee' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'lastForwarder' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'brandId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'companyId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'peeringContractId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
            )
        );
        $this->view->DELETE = array(
            'description' => '',
            'params' => array(
                'id' => array(
                    'type' => "int",
                    'required' => true
                )
            )
        );

        $this->status->setCode(200);

    }
}