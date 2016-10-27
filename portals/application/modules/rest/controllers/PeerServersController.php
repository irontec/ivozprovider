<?php
/**
 * PeerServers
 */

use IvozProvider\Model as Models;
use IvozProvider\Mapper\Sql as Mappers;

class Rest_PeerServersController extends Iron_Controller_Rest_BaseController
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
     * @ApiDescription(section="PeerServers", description="GET information about all PeerServers")
     * @ApiMethod(type="get")
     * @ApiRoute(name="/rest/peer-servers/")
     * @ApiParams(name="page", type="int", nullable=true, description="", sample="")
     * @ApiParams(name="order", type="string", nullable=true, description="", sample="")
     * @ApiParams(name="search", type="json_encode", nullable=true, description="", sample="")
     * @ApiReturnHeaders(sample="HTTP 200 OK")
     * @ApiReturn(type="object", sample="[{
     *     'id': '', 
     *     'peeringContractId': '', 
     *     'ip': '', 
     *     'name': '', 
     *     'description': '', 
     *     'brandId': '', 
     *     'hostname': '', 
     *     'port': '', 
     *     'params': '', 
     *     'uri_scheme': '', 
     *     'transport': '', 
     *     'strip': '', 
     *     'prefix': '', 
     *     'sendPAI': '', 
     *     'sendRPID': '', 
     *     'auth_needed': '', 
     *     'auth_user': '', 
     *     'auth_password': '', 
     *     'sip_proxy': '', 
     *     'outbound_proxy': '', 
     *     'from_user': '', 
     *     'from_domain': ''
     * },{
     *     'id': '', 
     *     'peeringContractId': '', 
     *     'ip': '', 
     *     'name': '', 
     *     'description': '', 
     *     'brandId': '', 
     *     'hostname': '', 
     *     'port': '', 
     *     'params': '', 
     *     'uri_scheme': '', 
     *     'transport': '', 
     *     'strip': '', 
     *     'prefix': '', 
     *     'sendPAI': '', 
     *     'sendRPID': '', 
     *     'auth_needed': '', 
     *     'auth_user': '', 
     *     'auth_password': '', 
     *     'sip_proxy': '', 
     *     'outbound_proxy': '', 
     *     'from_user': '', 
     *     'from_domain': ''
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
                'peeringContractId',
                'ip',
                'name',
                'description',
                'brandId',
                'hostname',
                'port',
                'params',
                'uriScheme',
                'transport',
                'strip',
                'prefix',
                'sendPAI',
                'sendRPID',
                'authNeeded',
                'authUser',
                'authPassword',
                'sipProxy',
                'outboundProxy',
                'fromUser',
                'fromDomain',
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

        $etag = $this->_cache->getEtagVersions('PeerServers');

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

        $mapper = new Mappers\PeerServers();

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
     * @ApiDescription(section="PeerServers", description="Get information about PeerServers")
     * @ApiMethod(type="get")
     * @ApiRoute(name="/rest/peer-servers/{id}")
     * @ApiParams(name="id", type="int", nullable=false, description="", sample="")
     * @ApiReturnHeaders(sample="HTTP 200 OK")
     * @ApiReturn(type="object", sample="{
     *     'id': '', 
     *     'peeringContractId': '', 
     *     'ip': '', 
     *     'name': '', 
     *     'description': '', 
     *     'brandId': '', 
     *     'hostname': '', 
     *     'port': '', 
     *     'params': '', 
     *     'uri_scheme': '', 
     *     'transport': '', 
     *     'strip': '', 
     *     'prefix': '', 
     *     'sendPAI': '', 
     *     'sendRPID': '', 
     *     'auth_needed': '', 
     *     'auth_user': '', 
     *     'auth_password': '', 
     *     'sip_proxy': '', 
     *     'outbound_proxy': '', 
     *     'from_user': '', 
     *     'from_domain': ''
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
                'peeringContractId',
                'ip',
                'name',
                'description',
                'brandId',
                'hostname',
                'port',
                'params',
                'uriScheme',
                'transport',
                'strip',
                'prefix',
                'sendPAI',
                'sendRPID',
                'authNeeded',
                'authUser',
                'authPassword',
                'sipProxy',
                'outboundProxy',
                'fromUser',
                'fromDomain',
            );
        }

        $etag = $this->_cache->getEtagVersions('PeerServers');
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

        $mapper = new Mappers\PeerServers();
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
     * @ApiDescription(section="PeerServers", description="Create's a new PeerServers")
     * @ApiMethod(type="post")
     * @ApiRoute(name="/rest/peer-servers/")
     * @ApiParams(name="peeringContractId", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="ip", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="name", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="description", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="brandId", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="hostname", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="port", nullable=true, type="smallint", sample="", description="")
     * @ApiParams(name="params", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="uri_scheme", nullable=true, type="tinyint", sample="", description="")
     * @ApiParams(name="transport", nullable=true, type="tinyint", sample="", description="")
     * @ApiParams(name="strip", nullable=true, type="tinyint", sample="", description="")
     * @ApiParams(name="prefix", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="sendPAI", nullable=true, type="tinyint", sample="", description="")
     * @ApiParams(name="sendRPID", nullable=true, type="tinyint", sample="", description="")
     * @ApiParams(name="auth_needed", nullable=false, type="enum('yes','no')", sample="", description="")
     * @ApiParams(name="auth_user", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="auth_password", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="sip_proxy", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="outbound_proxy", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="from_user", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="from_domain", nullable=true, type="varchar", sample="", description="")
     * @ApiReturnHeaders(sample="HTTP 201")
     * @ApiReturnHeaders(sample="Location: /rest/peerservers/{id}")
     * @ApiReturn(type="object", sample="{}")
     */
    public function postAction()
    {

        $params = $this->getRequest()->getParams();

        $model = new Models\PeerServers();

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
     * @ApiDescription(section="PeerServers", description="Table PeerServers")
     * @ApiMethod(type="put")
     * @ApiRoute(name="/rest/peer-servers/")
     * @ApiParams(name="id", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="peeringContractId", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="ip", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="name", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="description", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="brandId", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="hostname", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="port", nullable=true, type="smallint", sample="", description="")
     * @ApiParams(name="params", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="uri_scheme", nullable=true, type="tinyint", sample="", description="")
     * @ApiParams(name="transport", nullable=true, type="tinyint", sample="", description="")
     * @ApiParams(name="strip", nullable=true, type="tinyint", sample="", description="")
     * @ApiParams(name="prefix", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="sendPAI", nullable=true, type="tinyint", sample="", description="")
     * @ApiParams(name="sendRPID", nullable=true, type="tinyint", sample="", description="")
     * @ApiParams(name="auth_needed", nullable=false, type="enum('yes','no')", sample="", description="")
     * @ApiParams(name="auth_user", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="auth_password", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="sip_proxy", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="outbound_proxy", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="from_user", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="from_domain", nullable=true, type="varchar", sample="", description="")
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

        $mapper = new Mappers\PeerServers();
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
     * @ApiDescription(section="PeerServers", description="Table PeerServers")
     * @ApiMethod(type="delete")
     * @ApiRoute(name="/rest/peer-servers/")
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

        $mapper = new Mappers\PeerServers();
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
                'peeringContractId' => array(
                    'type' => "int",
                    'required' => true,
                    'comment' => '',
                ),
                'ip' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'name' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'description' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'brandId' => array(
                    'type' => "int",
                    'required' => true,
                    'comment' => '',
                ),
                'hostname' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'port' => array(
                    'type' => "smallint",
                    'required' => false,
                    'comment' => '',
                ),
                'params' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'uri_scheme' => array(
                    'type' => "tinyint",
                    'required' => false,
                    'comment' => '',
                ),
                'transport' => array(
                    'type' => "tinyint",
                    'required' => false,
                    'comment' => '',
                ),
                'strip' => array(
                    'type' => "tinyint",
                    'required' => false,
                    'comment' => '',
                ),
                'prefix' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'sendPAI' => array(
                    'type' => "tinyint",
                    'required' => false,
                    'comment' => '',
                ),
                'sendRPID' => array(
                    'type' => "tinyint",
                    'required' => false,
                    'comment' => '',
                ),
                'auth_needed' => array(
                    'type' => "enum('yes','no')",
                    'required' => true,
                    'comment' => '',
                ),
                'auth_user' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'auth_password' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'sip_proxy' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'outbound_proxy' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'from_user' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'from_domain' => array(
                    'type' => "varchar",
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
                'peeringContractId' => array(
                    'type' => "int",
                    'required' => true,
                    'comment' => '',
                ),
                'ip' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'name' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'description' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'brandId' => array(
                    'type' => "int",
                    'required' => true,
                    'comment' => '',
                ),
                'hostname' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'port' => array(
                    'type' => "smallint",
                    'required' => false,
                    'comment' => '',
                ),
                'params' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'uri_scheme' => array(
                    'type' => "tinyint",
                    'required' => false,
                    'comment' => '',
                ),
                'transport' => array(
                    'type' => "tinyint",
                    'required' => false,
                    'comment' => '',
                ),
                'strip' => array(
                    'type' => "tinyint",
                    'required' => false,
                    'comment' => '',
                ),
                'prefix' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'sendPAI' => array(
                    'type' => "tinyint",
                    'required' => false,
                    'comment' => '',
                ),
                'sendRPID' => array(
                    'type' => "tinyint",
                    'required' => false,
                    'comment' => '',
                ),
                'auth_needed' => array(
                    'type' => "enum('yes','no')",
                    'required' => true,
                    'comment' => '',
                ),
                'auth_user' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'auth_password' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'sip_proxy' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'outbound_proxy' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'from_user' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'from_domain' => array(
                    'type' => "varchar",
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