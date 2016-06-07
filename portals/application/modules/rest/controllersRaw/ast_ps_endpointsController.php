<?php
/**
 * ast_ps_endpoints
 */

use IvozProvider\Model as Models;
use IvozProvider\Mapper\Sql as Mappers;

class Rest_ast_ps_endpointsController extends Iron_Controller_Rest_BaseController
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
     * @ApiDescription(section="ast_ps_endpoints", description="GET information about all ast_ps_endpoints")
     * @ApiMethod(type="get")
     * @ApiRoute(name="/rest/ast_ps_endpoints/")
     * @ApiParams(name="page", type="int", nullable=true, description="", sample="")
     * @ApiParams(name="order", type="string", nullable=true, description="", sample="")
     * @ApiParams(name="search", type="json_encode", nullable=true, description="", sample="")
     * @ApiReturnHeaders(sample="HTTP 200 OK")
     * @ApiReturn(type="object", sample="[{
     *     'id': '', 
     *     'sorcery_id': '', 
     *     'terminalId': '', 
     *     'aors': '', 
     *     'callerid': '', 
     *     'context': '', 
     *     'disallow': '', 
     *     'allow': '', 
     *     'direct_media': '', 
     *     'direct_media_method': '', 
     *     'dtmf_mode': '', 
     *     'mailboxes': '', 
     *     'send_diversion': '', 
     *     'send_pai': '', 
     *     'subscribecontext': '', 
     *     '100rel': ''
     * },{
     *     'id': '', 
     *     'sorcery_id': '', 
     *     'terminalId': '', 
     *     'aors': '', 
     *     'callerid': '', 
     *     'context': '', 
     *     'disallow': '', 
     *     'allow': '', 
     *     'direct_media': '', 
     *     'direct_media_method': '', 
     *     'dtmf_mode': '', 
     *     'mailboxes': '', 
     *     'send_diversion': '', 
     *     'send_pai': '', 
     *     'subscribecontext': '', 
     *     '100rel': ''
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
                'terminalId',
                'aors',
                'callerid',
                'context',
                'disallow',
                'allow',
                'directMedia',
                'directMedia',
                'dtmfMode',
                'mailboxes',
                'sendDiversion',
                'sendPai',
                'subscribecontext',
                '100rel',
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

        $etag = $this->_cache->getEtagVersions('ast_ps_endpoints');

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

        $mapper = new Mappers\ast_ps_endpoints();

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
     * @ApiDescription(section="ast_ps_endpoints", description="Get information about ast_ps_endpoints")
     * @ApiMethod(type="get")
     * @ApiRoute(name="/rest/ast_ps_endpoints/{id}")
     * @ApiParams(name="id", type="int", nullable=false, description="", sample="")
     * @ApiReturnHeaders(sample="HTTP 200 OK")
     * @ApiReturn(type="object", sample="{
     *     'id': '', 
     *     'sorcery_id': '', 
     *     'terminalId': '', 
     *     'aors': '', 
     *     'callerid': '', 
     *     'context': '', 
     *     'disallow': '', 
     *     'allow': '', 
     *     'direct_media': '', 
     *     'direct_media_method': '', 
     *     'dtmf_mode': '', 
     *     'mailboxes': '', 
     *     'send_diversion': '', 
     *     'send_pai': '', 
     *     'subscribecontext': '', 
     *     '100rel': ''
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
                'terminalId',
                'aors',
                'callerid',
                'context',
                'disallow',
                'allow',
                'directMedia',
                'directMedia',
                'dtmfMode',
                'mailboxes',
                'sendDiversion',
                'sendPai',
                'subscribecontext',
                '100rel',
            );
        }

        $etag = $this->_cache->getEtagVersions('ast_ps_endpoints');
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

        $mapper = new Mappers\ast_ps_endpoints();
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
     * @ApiDescription(section="ast_ps_endpoints", description="Create's a new ast_ps_endpoints")
     * @ApiMethod(type="post")
     * @ApiRoute(name="/rest/ast_ps_endpoints/")
     * @ApiParams(name="sorcery_id", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="terminalId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="aors", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="callerid", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="context", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="disallow", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="allow", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="direct_media", nullable=true, type="enum('yes','no')", sample="", description="")
     * @ApiParams(name="direct_media_method", nullable=true, type="enum('invite','reinvite','update')", sample="", description="[enum:update|invite|reinvite]")
     * @ApiParams(name="dtmf_mode", nullable=false, type="enum('rfc4733','inband','info')", sample="", description="")
     * @ApiParams(name="mailboxes", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="send_diversion", nullable=true, type="enum('yes','no')", sample="", description="")
     * @ApiParams(name="send_pai", nullable=true, type="enum('yes','no')", sample="", description="")
     * @ApiParams(name="subscribecontext", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="100rel", nullable=false, type="enum('no','required','yes')", sample="", description="")
     * @ApiReturnHeaders(sample="HTTP 201")
     * @ApiReturnHeaders(sample="Location: /rest/ast_ps_endpoints/{id}")
     * @ApiReturn(type="object", sample="{}")
     */
    public function postAction()
    {

        $params = $this->getRequest()->getParams();

        $model = new Models\ast_ps_endpoints();

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
     * @ApiDescription(section="ast_ps_endpoints", description="Table ast_ps_endpoints")
     * @ApiMethod(type="put")
     * @ApiRoute(name="/rest/ast_ps_endpoints/")
     * @ApiParams(name="id", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="sorcery_id", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="terminalId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="aors", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="callerid", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="context", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="disallow", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="allow", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="direct_media", nullable=true, type="enum('yes','no')", sample="", description="")
     * @ApiParams(name="direct_media_method", nullable=true, type="enum('invite','reinvite','update')", sample="", description="[enum:update|invite|reinvite]")
     * @ApiParams(name="dtmf_mode", nullable=false, type="enum('rfc4733','inband','info')", sample="", description="")
     * @ApiParams(name="mailboxes", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="send_diversion", nullable=true, type="enum('yes','no')", sample="", description="")
     * @ApiParams(name="send_pai", nullable=true, type="enum('yes','no')", sample="", description="")
     * @ApiParams(name="subscribecontext", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="100rel", nullable=false, type="enum('no','required','yes')", sample="", description="")
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

        $mapper = new Mappers\ast_ps_endpoints();
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
     * @ApiDescription(section="ast_ps_endpoints", description="Table ast_ps_endpoints")
     * @ApiMethod(type="delete")
     * @ApiRoute(name="/rest/ast_ps_endpoints/")
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

        $mapper = new Mappers\ast_ps_endpoints();
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
                'sorcery_id' => array(
                    'type' => 'varchar',
                    'required' => true,
                    'comment' => '',
                ),
                'terminalId' => array(
                    'type' => 'int',
                    'required' => false,
                    'comment' => '',
                ),
                'aors' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'callerid' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'context' => array(
                    'type' => 'varchar',
                    'required' => true,
                    'comment' => '',
                ),
                'disallow' => array(
                    'type' => 'varchar',
                    'required' => true,
                    'comment' => '',
                ),
                'allow' => array(
                    'type' => 'varchar',
                    'required' => true,
                    'comment' => '',
                ),
                'direct_media' => array(
                    'type' => 'enum('yes','no')',
                    'required' => false,
                    'comment' => '',
                ),
                'direct_media_method' => array(
                    'type' => 'enum('invite','reinvite','update')',
                    'required' => false,
                    'comment' => '[enum:update|invite|reinvite]',
                ),
                'dtmf_mode' => array(
                    'type' => 'enum('rfc4733','inband','info')',
                    'required' => true,
                    'comment' => '',
                ),
                'mailboxes' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'send_diversion' => array(
                    'type' => 'enum('yes','no')',
                    'required' => false,
                    'comment' => '',
                ),
                'send_pai' => array(
                    'type' => 'enum('yes','no')',
                    'required' => false,
                    'comment' => '',
                ),
                'subscribecontext' => array(
                    'type' => 'varchar',
                    'required' => true,
                    'comment' => '',
                ),
                '100rel' => array(
                    'type' => 'enum('no','required','yes')',
                    'required' => true,
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
                'sorcery_id' => array(
                    'type' => 'varchar',
                    'required' => true,
                    'comment' => '',
                ),
                'terminalId' => array(
                    'type' => 'int',
                    'required' => false,
                    'comment' => '',
                ),
                'aors' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'callerid' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'context' => array(
                    'type' => 'varchar',
                    'required' => true,
                    'comment' => '',
                ),
                'disallow' => array(
                    'type' => 'varchar',
                    'required' => true,
                    'comment' => '',
                ),
                'allow' => array(
                    'type' => 'varchar',
                    'required' => true,
                    'comment' => '',
                ),
                'direct_media' => array(
                    'type' => 'enum('yes','no')',
                    'required' => false,
                    'comment' => '',
                ),
                'direct_media_method' => array(
                    'type' => 'enum('invite','reinvite','update')',
                    'required' => false,
                    'comment' => '[enum:update|invite|reinvite]',
                ),
                'dtmf_mode' => array(
                    'type' => 'enum('rfc4733','inband','info')',
                    'required' => true,
                    'comment' => '',
                ),
                'mailboxes' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'send_diversion' => array(
                    'type' => 'enum('yes','no')',
                    'required' => false,
                    'comment' => '',
                ),
                'send_pai' => array(
                    'type' => 'enum('yes','no')',
                    'required' => false,
                    'comment' => '',
                ),
                'subscribecontext' => array(
                    'type' => 'varchar',
                    'required' => true,
                    'comment' => '',
                ),
                '100rel' => array(
                    'type' => 'enum('no','required','yes')',
                    'required' => true,
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