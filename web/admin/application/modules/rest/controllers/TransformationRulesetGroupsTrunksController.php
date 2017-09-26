<?php
/**
 * TransformationRulesetGroupsTrunks
 */

use IvozProvider\Model as Models;
use IvozProvider\Mapper\Sql as Mappers;

class Rest_TransformationRulesetGroupsTrunksController extends Iron_Controller_Rest_BaseController
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
     * @ApiDescription(section="TransformationRulesetGroupsTrunks", description="GET information about all TransformationRulesetGroupsTrunks")
     * @ApiMethod(type="get")
     * @ApiRoute(name="/rest/transformation-ruleset-groups-trunks/")
     * @ApiParams(name="page", type="int", nullable=true, description="", sample="")
     * @ApiParams(name="order", type="string", nullable=true, description="", sample="")
     * @ApiParams(name="search", type="json_encode", nullable=true, description="", sample="")
     * @ApiReturnHeaders(sample="HTTP 200 OK")
     * @ApiReturn(type="object", sample="[{
     *     'id': '', 
     *     'brandId': '', 
     *     'name': '', 
     *     'caller_in': '', 
     *     'callee_in': '', 
     *     'caller_out': '', 
     *     'callee_out': '', 
     *     'description': '', 
     *     'automatic': '', 
     *     'countryId': '', 
     *     'internationalCode': '', 
     *     'nationalNumLength': ''
     * },{
     *     'id': '', 
     *     'brandId': '', 
     *     'name': '', 
     *     'caller_in': '', 
     *     'callee_in': '', 
     *     'caller_out': '', 
     *     'callee_out': '', 
     *     'description': '', 
     *     'automatic': '', 
     *     'countryId': '', 
     *     'internationalCode': '', 
     *     'nationalNumLength': ''
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
                'brandId',
                'name',
                'callerIn',
                'calleeIn',
                'callerOut',
                'calleeOut',
                'description',
                'automatic',
                'countryId',
                'internationalCode',
                'nationalNumLength',
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

        $etag = $this->_cache->getEtagVersions('TransformationRulesetGroupsTrunks');

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

        $mapper = new Mappers\TransformationRulesetGroupsTrunks();

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
     * @ApiDescription(section="TransformationRulesetGroupsTrunks", description="Get information about TransformationRulesetGroupsTrunks")
     * @ApiMethod(type="get")
     * @ApiRoute(name="/rest/transformation-ruleset-groups-trunks/{id}")
     * @ApiParams(name="id", type="int", nullable=false, description="", sample="")
     * @ApiReturnHeaders(sample="HTTP 200 OK")
     * @ApiReturn(type="object", sample="{
     *     'id': '', 
     *     'brandId': '', 
     *     'name': '', 
     *     'caller_in': '', 
     *     'callee_in': '', 
     *     'caller_out': '', 
     *     'callee_out': '', 
     *     'description': '', 
     *     'automatic': '', 
     *     'countryId': '', 
     *     'internationalCode': '', 
     *     'nationalNumLength': ''
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
                'brandId',
                'name',
                'callerIn',
                'calleeIn',
                'callerOut',
                'calleeOut',
                'description',
                'automatic',
                'countryId',
                'internationalCode',
                'nationalNumLength',
            );
        }

        $etag = $this->_cache->getEtagVersions('TransformationRulesetGroupsTrunks');
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

        $mapper = new Mappers\TransformationRulesetGroupsTrunks();
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
     * @ApiDescription(section="TransformationRulesetGroupsTrunks", description="Create's a new TransformationRulesetGroupsTrunks")
     * @ApiMethod(type="post")
     * @ApiRoute(name="/rest/transformation-ruleset-groups-trunks/")
     * @ApiParams(name="brandId", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="name", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="caller_in", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="callee_in", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="caller_out", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="callee_out", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="description", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="automatic", nullable=false, type="tinyint", sample="", description="")
     * @ApiParams(name="countryId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="internationalCode", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="nationalNumLength", nullable=true, type="int", sample="", description="")
     * @ApiReturnHeaders(sample="HTTP 201")
     * @ApiReturnHeaders(sample="Location: /rest/transformationrulesetgroupstrunks/{id}")
     * @ApiReturn(type="object", sample="{}")
     */
    public function postAction()
    {

        $params = $this->getRequest()->getParams();

        $model = new Models\TransformationRulesetGroupsTrunks();

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
     * @ApiDescription(section="TransformationRulesetGroupsTrunks", description="Table TransformationRulesetGroupsTrunks")
     * @ApiMethod(type="put")
     * @ApiRoute(name="/rest/transformation-ruleset-groups-trunks/")
     * @ApiParams(name="id", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="brandId", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="name", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="caller_in", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="callee_in", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="caller_out", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="callee_out", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="description", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="automatic", nullable=false, type="tinyint", sample="", description="")
     * @ApiParams(name="countryId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="internationalCode", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="nationalNumLength", nullable=true, type="int", sample="", description="")
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

        $mapper = new Mappers\TransformationRulesetGroupsTrunks();
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
     * @ApiDescription(section="TransformationRulesetGroupsTrunks", description="Table TransformationRulesetGroupsTrunks")
     * @ApiMethod(type="delete")
     * @ApiRoute(name="/rest/transformation-ruleset-groups-trunks/")
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

        $mapper = new Mappers\TransformationRulesetGroupsTrunks();
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
                'brandId' => array(
                    'type' => "int",
                    'required' => true,
                    'comment' => '',
                ),
                'name' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'caller_in' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'callee_in' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'caller_out' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'callee_out' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'description' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'automatic' => array(
                    'type' => "tinyint",
                    'required' => true,
                    'comment' => '',
                ),
                'countryId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'internationalCode' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'nationalNumLength' => array(
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
                'brandId' => array(
                    'type' => "int",
                    'required' => true,
                    'comment' => '',
                ),
                'name' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'caller_in' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'callee_in' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'caller_out' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'callee_out' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'description' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'automatic' => array(
                    'type' => "tinyint",
                    'required' => true,
                    'comment' => '',
                ),
                'countryId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'internationalCode' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'nationalNumLength' => array(
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