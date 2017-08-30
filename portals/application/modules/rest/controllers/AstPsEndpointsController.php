<?php
/**
 * AstPsEndpoints
 */

use IvozProvider\Model as Models;
use IvozProvider\Mapper\Sql as Mappers;

class Rest_AstPsEndpointsController extends Iron_Controller_Rest_BaseController
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
     * @ApiDescription(section="AstPsEndpoints", description="GET information about all AstPsEndpoints")
     * @ApiMethod(type="get")
     * @ApiRoute(name="/rest/ast-ps-endpoints/")
     * @ApiParams(name="page", type="int", nullable=true, description="", sample="")
     * @ApiParams(name="order", type="string", nullable=true, description="", sample="")
     * @ApiParams(name="search", type="json_encode", nullable=true, description="", sample="")
     * @ApiReturnHeaders(sample="HTTP 200 OK")
     * @ApiReturn(type="object", sample="[{
     *     'id': '', 
     *     'sorcery_id': '', 
     *     'from_domain': '', 
     *     'terminalId': '', 
     *     'friendId': '', 
     *     'retailAccountId': '', 
     *     'aors': '', 
     *     'callerid': '', 
     *     'context': '', 
     *     'disallow': '', 
     *     'allow': '', 
     *     'direct_media': '', 
     *     'direct_media_method': '', 
     *     'mailboxes': '', 
     *     'named_pickup_group': '', 
     *     'send_diversion': '', 
     *     'send_pai': '', 
     *     '100rel': '', 
     *     'outbound_proxy': '', 
     *     'trust_id_inbound': ''
     * },{
     *     'id': '', 
     *     'sorcery_id': '', 
     *     'from_domain': '', 
     *     'terminalId': '', 
     *     'friendId': '', 
     *     'retailAccountId': '', 
     *     'aors': '', 
     *     'callerid': '', 
     *     'context': '', 
     *     'disallow': '', 
     *     'allow': '', 
     *     'direct_media': '', 
     *     'direct_media_method': '', 
     *     'mailboxes': '', 
     *     'named_pickup_group': '', 
     *     'send_diversion': '', 
     *     'send_pai': '', 
     *     '100rel': '', 
     *     'outbound_proxy': '', 
     *     'trust_id_inbound': ''
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
                'sorceryId',
                'fromDomain',
                'terminalId',
                'friendId',
                'retailAccountId',
                'aors',
                'callerid',
                'context',
                'disallow',
                'allow',
                'directMedia',
                'directMediaMethod',
                'mailboxes',
                'namedPickupGroup',
                'sendDiversion',
                'sendPai',
                '100rel',
                'outboundProxy',
                'trustIdInbound',
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

        $etag = $this->_cache->getEtagVersions('AstPsEndpoints');

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

        $mapper = new Mappers\AstPsEndpoints();

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
     * @ApiDescription(section="AstPsEndpoints", description="Get information about AstPsEndpoints")
     * @ApiMethod(type="get")
     * @ApiRoute(name="/rest/ast-ps-endpoints/{id}")
     * @ApiParams(name="id", type="int", nullable=false, description="", sample="")
     * @ApiReturnHeaders(sample="HTTP 200 OK")
     * @ApiReturn(type="object", sample="{
     *     'id': '', 
     *     'sorcery_id': '', 
     *     'from_domain': '', 
     *     'terminalId': '', 
     *     'friendId': '', 
     *     'retailAccountId': '', 
     *     'aors': '', 
     *     'callerid': '', 
     *     'context': '', 
     *     'disallow': '', 
     *     'allow': '', 
     *     'direct_media': '', 
     *     'direct_media_method': '', 
     *     'mailboxes': '', 
     *     'named_pickup_group': '', 
     *     'send_diversion': '', 
     *     'send_pai': '', 
     *     '100rel': '', 
     *     'outbound_proxy': '', 
     *     'trust_id_inbound': ''
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
                'sorceryId',
                'fromDomain',
                'terminalId',
                'friendId',
                'retailAccountId',
                'aors',
                'callerid',
                'context',
                'disallow',
                'allow',
                'directMedia',
                'directMediaMethod',
                'mailboxes',
                'namedPickupGroup',
                'sendDiversion',
                'sendPai',
                '100rel',
                'outboundProxy',
                'trustIdInbound',
            );
        }

        $etag = $this->_cache->getEtagVersions('AstPsEndpoints');
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

        $mapper = new Mappers\AstPsEndpoints();
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
     * @ApiDescription(section="AstPsEndpoints", description="Create's a new AstPsEndpoints")
     * @ApiMethod(type="post")
     * @ApiRoute(name="/rest/ast-ps-endpoints/")
     * @ApiParams(name="sorcery_id", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="from_domain", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="terminalId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="friendId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="retailAccountId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="aors", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="callerid", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="context", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="disallow", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="allow", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="direct_media", nullable=true, type="enum('yes','no')", sample="", description="")
     * @ApiParams(name="direct_media_method", nullable=true, type="enum('invite','reinvite','update')", sample="", description="[enum:update|invite|reinvite]")
     * @ApiParams(name="mailboxes", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="named_pickup_group", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="send_diversion", nullable=true, type="enum('yes','no')", sample="", description="")
     * @ApiParams(name="send_pai", nullable=true, type="enum('yes','no')", sample="", description="")
     * @ApiParams(name="100rel", nullable=false, type="enum('no','required','yes')", sample="", description="")
     * @ApiParams(name="outbound_proxy", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="trust_id_inbound", nullable=true, type="enum('yes','no')", sample="", description="")
     * @ApiReturnHeaders(sample="HTTP 201")
     * @ApiReturnHeaders(sample="Location: /rest/astpsendpoints/{id}")
     * @ApiReturn(type="object", sample="{}")
     */
    public function postAction()
    {

        $params = $this->getRequest()->getParams();

        $model = new Models\AstPsEndpoints();

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
     * @ApiDescription(section="AstPsEndpoints", description="Table AstPsEndpoints")
     * @ApiMethod(type="put")
     * @ApiRoute(name="/rest/ast-ps-endpoints/")
     * @ApiParams(name="id", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="sorcery_id", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="from_domain", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="terminalId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="friendId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="retailAccountId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="aors", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="callerid", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="context", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="disallow", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="allow", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="direct_media", nullable=true, type="enum('yes','no')", sample="", description="")
     * @ApiParams(name="direct_media_method", nullable=true, type="enum('invite','reinvite','update')", sample="", description="[enum:update|invite|reinvite]")
     * @ApiParams(name="mailboxes", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="named_pickup_group", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="send_diversion", nullable=true, type="enum('yes','no')", sample="", description="")
     * @ApiParams(name="send_pai", nullable=true, type="enum('yes','no')", sample="", description="")
     * @ApiParams(name="100rel", nullable=false, type="enum('no','required','yes')", sample="", description="")
     * @ApiParams(name="outbound_proxy", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="trust_id_inbound", nullable=true, type="enum('yes','no')", sample="", description="")
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

        $mapper = new Mappers\AstPsEndpoints();
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
     * @ApiDescription(section="AstPsEndpoints", description="Table AstPsEndpoints")
     * @ApiMethod(type="delete")
     * @ApiRoute(name="/rest/ast-ps-endpoints/")
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

        $mapper = new Mappers\AstPsEndpoints();
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
                'sorcery_id' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'from_domain' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'terminalId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'friendId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'retailAccountId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'aors' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'callerid' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'context' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'disallow' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'allow' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'direct_media' => array(
                    'type' => "enum('yes','no')",
                    'required' => false,
                    'comment' => '',
                ),
                'direct_media_method' => array(
                    'type' => "enum('invite','reinvite','update')",
                    'required' => false,
                    'comment' => '[enum:update|invite|reinvite]',
                ),
                'mailboxes' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'named_pickup_group' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'send_diversion' => array(
                    'type' => "enum('yes','no')",
                    'required' => false,
                    'comment' => '',
                ),
                'send_pai' => array(
                    'type' => "enum('yes','no')",
                    'required' => false,
                    'comment' => '',
                ),
                '100rel' => array(
                    'type' => "enum('no','required','yes')",
                    'required' => true,
                    'comment' => '',
                ),
                'outbound_proxy' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'trust_id_inbound' => array(
                    'type' => "enum('yes','no')",
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
                'sorcery_id' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'from_domain' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'terminalId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'friendId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'retailAccountId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'aors' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'callerid' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'context' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'disallow' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'allow' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'direct_media' => array(
                    'type' => "enum('yes','no')",
                    'required' => false,
                    'comment' => '',
                ),
                'direct_media_method' => array(
                    'type' => "enum('invite','reinvite','update')",
                    'required' => false,
                    'comment' => '[enum:update|invite|reinvite]',
                ),
                'mailboxes' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'named_pickup_group' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'send_diversion' => array(
                    'type' => "enum('yes','no')",
                    'required' => false,
                    'comment' => '',
                ),
                'send_pai' => array(
                    'type' => "enum('yes','no')",
                    'required' => false,
                    'comment' => '',
                ),
                '100rel' => array(
                    'type' => "enum('no','required','yes')",
                    'required' => true,
                    'comment' => '',
                ),
                'outbound_proxy' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'trust_id_inbound' => array(
                    'type' => "enum('yes','no')",
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