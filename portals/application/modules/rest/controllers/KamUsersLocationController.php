<?php
/**
 * KamUsersLocation
 */

use IvozProvider\Model as Models;
use IvozProvider\Mapper\Sql as Mappers;

class Rest_KamUsersLocationController extends Iron_Controller_Rest_BaseController
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
     * @ApiDescription(section="KamUsersLocation", description="GET information about all KamUsersLocation")
     * @ApiMethod(type="get")
     * @ApiRoute(name="/rest/kam-users-location/")
     * @ApiParams(name="page", type="int", nullable=true, description="", sample="")
     * @ApiParams(name="order", type="string", nullable=true, description="", sample="")
     * @ApiParams(name="search", type="json_encode", nullable=true, description="", sample="")
     * @ApiReturnHeaders(sample="HTTP 200 OK")
     * @ApiReturn(type="object", sample="[{
     *     'id': '', 
     *     'ruid': '', 
     *     'username': '', 
     *     'domain': '', 
     *     'contact': '', 
     *     'received': '', 
     *     'path': '', 
     *     'expires': '', 
     *     'q': '', 
     *     'callid': '', 
     *     'cseq': '', 
     *     'last_modified': '', 
     *     'flags': '', 
     *     'cflags': '', 
     *     'user_agent': '', 
     *     'socket': '', 
     *     'methods': '', 
     *     'instance': '', 
     *     'reg_id': '', 
     *     'server_id': '', 
     *     'connection_id': '', 
     *     'keepalive': '', 
     *     'partition': ''
     * },{
     *     'id': '', 
     *     'ruid': '', 
     *     'username': '', 
     *     'domain': '', 
     *     'contact': '', 
     *     'received': '', 
     *     'path': '', 
     *     'expires': '', 
     *     'q': '', 
     *     'callid': '', 
     *     'cseq': '', 
     *     'last_modified': '', 
     *     'flags': '', 
     *     'cflags': '', 
     *     'user_agent': '', 
     *     'socket': '', 
     *     'methods': '', 
     *     'instance': '', 
     *     'reg_id': '', 
     *     'server_id': '', 
     *     'connection_id': '', 
     *     'keepalive': '', 
     *     'partition': ''
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
                'ruid',
                'username',
                'domain',
                'contact',
                'received',
                'path',
                'expires',
                'q',
                'callid',
                'cseq',
                'lastModified',
                'flags',
                'cflags',
                'userAgent',
                'socket',
                'methods',
                'instance',
                'regId',
                'serverId',
                'connectionId',
                'keepalive',
                'partition',
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

        $etag = $this->_cache->getEtagVersions('KamUsersLocation');

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

        $mapper = new Mappers\KamUsersLocation();

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
     * @ApiDescription(section="KamUsersLocation", description="Get information about KamUsersLocation")
     * @ApiMethod(type="get")
     * @ApiRoute(name="/rest/kam-users-location/{id}")
     * @ApiParams(name="id", type="int", nullable=false, description="", sample="")
     * @ApiReturnHeaders(sample="HTTP 200 OK")
     * @ApiReturn(type="object", sample="{
     *     'id': '', 
     *     'ruid': '', 
     *     'username': '', 
     *     'domain': '', 
     *     'contact': '', 
     *     'received': '', 
     *     'path': '', 
     *     'expires': '', 
     *     'q': '', 
     *     'callid': '', 
     *     'cseq': '', 
     *     'last_modified': '', 
     *     'flags': '', 
     *     'cflags': '', 
     *     'user_agent': '', 
     *     'socket': '', 
     *     'methods': '', 
     *     'instance': '', 
     *     'reg_id': '', 
     *     'server_id': '', 
     *     'connection_id': '', 
     *     'keepalive': '', 
     *     'partition': ''
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
                'ruid',
                'username',
                'domain',
                'contact',
                'received',
                'path',
                'expires',
                'q',
                'callid',
                'cseq',
                'lastModified',
                'flags',
                'cflags',
                'userAgent',
                'socket',
                'methods',
                'instance',
                'regId',
                'serverId',
                'connectionId',
                'keepalive',
                'partition',
            );
        }

        $etag = $this->_cache->getEtagVersions('KamUsersLocation');
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

        $mapper = new Mappers\KamUsersLocation();
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
     * @ApiDescription(section="KamUsersLocation", description="Create's a new KamUsersLocation")
     * @ApiMethod(type="post")
     * @ApiRoute(name="/rest/kam-users-location/")
     * @ApiParams(name="ruid", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="username", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="domain", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="contact", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="received", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="path", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="expires", nullable=false, type="datetime", sample="", description="")
     * @ApiParams(name="q", nullable=false, type="float", sample="", description="")
     * @ApiParams(name="callid", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="cseq", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="last_modified", nullable=false, type="datetime", sample="", description="")
     * @ApiParams(name="flags", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="cflags", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="user_agent", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="socket", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="methods", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="instance", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="reg_id", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="server_id", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="connection_id", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="keepalive", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="partition", nullable=false, type="int", sample="", description="")
     * @ApiReturnHeaders(sample="HTTP 201")
     * @ApiReturnHeaders(sample="Location: /rest/kamuserslocation/{id}")
     * @ApiReturn(type="object", sample="{}")
     */
    public function postAction()
    {

        $params = $this->getRequest()->getParams();

        $model = new Models\KamUsersLocation();

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
     * @ApiDescription(section="KamUsersLocation", description="Table KamUsersLocation")
     * @ApiMethod(type="put")
     * @ApiRoute(name="/rest/kam-users-location/")
     * @ApiParams(name="id", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="ruid", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="username", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="domain", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="contact", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="received", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="path", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="expires", nullable=false, type="datetime", sample="", description="")
     * @ApiParams(name="q", nullable=false, type="float", sample="", description="")
     * @ApiParams(name="callid", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="cseq", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="last_modified", nullable=false, type="datetime", sample="", description="")
     * @ApiParams(name="flags", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="cflags", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="user_agent", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="socket", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="methods", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="instance", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="reg_id", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="server_id", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="connection_id", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="keepalive", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="partition", nullable=false, type="int", sample="", description="")
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

        $mapper = new Mappers\KamUsersLocation();
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
     * @ApiDescription(section="KamUsersLocation", description="Table KamUsersLocation")
     * @ApiMethod(type="delete")
     * @ApiRoute(name="/rest/kam-users-location/")
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

        $mapper = new Mappers\KamUsersLocation();
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
                'ruid' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'username' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'domain' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'contact' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'received' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'path' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'expires' => array(
                    'type' => "datetime",
                    'required' => true,
                    'comment' => '',
                ),
                'q' => array(
                    'type' => "float",
                    'required' => true,
                    'comment' => '',
                ),
                'callid' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'cseq' => array(
                    'type' => "int",
                    'required' => true,
                    'comment' => '',
                ),
                'last_modified' => array(
                    'type' => "datetime",
                    'required' => true,
                    'comment' => '',
                ),
                'flags' => array(
                    'type' => "int",
                    'required' => true,
                    'comment' => '',
                ),
                'cflags' => array(
                    'type' => "int",
                    'required' => true,
                    'comment' => '',
                ),
                'user_agent' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'socket' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'methods' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'instance' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'reg_id' => array(
                    'type' => "int",
                    'required' => true,
                    'comment' => '',
                ),
                'server_id' => array(
                    'type' => "int",
                    'required' => true,
                    'comment' => '',
                ),
                'connection_id' => array(
                    'type' => "int",
                    'required' => true,
                    'comment' => '',
                ),
                'keepalive' => array(
                    'type' => "int",
                    'required' => true,
                    'comment' => '',
                ),
                'partition' => array(
                    'type' => "int",
                    'required' => true,
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
                'ruid' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'username' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'domain' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'contact' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'received' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'path' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'expires' => array(
                    'type' => "datetime",
                    'required' => true,
                    'comment' => '',
                ),
                'q' => array(
                    'type' => "float",
                    'required' => true,
                    'comment' => '',
                ),
                'callid' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'cseq' => array(
                    'type' => "int",
                    'required' => true,
                    'comment' => '',
                ),
                'last_modified' => array(
                    'type' => "datetime",
                    'required' => true,
                    'comment' => '',
                ),
                'flags' => array(
                    'type' => "int",
                    'required' => true,
                    'comment' => '',
                ),
                'cflags' => array(
                    'type' => "int",
                    'required' => true,
                    'comment' => '',
                ),
                'user_agent' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'socket' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'methods' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'instance' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'reg_id' => array(
                    'type' => "int",
                    'required' => true,
                    'comment' => '',
                ),
                'server_id' => array(
                    'type' => "int",
                    'required' => true,
                    'comment' => '',
                ),
                'connection_id' => array(
                    'type' => "int",
                    'required' => true,
                    'comment' => '',
                ),
                'keepalive' => array(
                    'type' => "int",
                    'required' => true,
                    'comment' => '',
                ),
                'partition' => array(
                    'type' => "int",
                    'required' => true,
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