<?php
/**
 * Friends
 */

use IvozProvider\Model as Models;
use IvozProvider\Mapper\Sql as Mappers;

class Rest_FriendsController extends Iron_Controller_Rest_BaseController
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
     * @ApiDescription(section="Friends", description="GET information about all Friends")
     * @ApiMethod(type="get")
     * @ApiRoute(name="/rest/friends/")
     * @ApiParams(name="page", type="int", nullable=true, description="", sample="")
     * @ApiParams(name="order", type="string", nullable=true, description="", sample="")
     * @ApiParams(name="search", type="json_encode", nullable=true, description="", sample="")
     * @ApiReturnHeaders(sample="HTTP 200 OK")
     * @ApiReturn(type="object", sample="[{
     *     'id': '', 
     *     'companyId': '', 
     *     'name': '', 
     *     'domain': '', 
     *     'description': '', 
     *     'transport': '', 
     *     'ip': '', 
     *     'port': '', 
     *     'auth_needed': '', 
     *     'password': '', 
     *     'callACLId': '', 
     *     'countryId': '', 
     *     'areaCode': '', 
     *     'outgoingDDIId': '', 
     *     'priority': '', 
     *     'disallow': '', 
     *     'allow': '', 
     *     'direct_media_method': '', 
     *     'callerid_update_header': '', 
     *     'update_callerid': '', 
     *     'from_domain': '', 
     *     'directConnectivity': '', 
     *     'languageId': ''
     * },{
     *     'id': '', 
     *     'companyId': '', 
     *     'name': '', 
     *     'domain': '', 
     *     'description': '', 
     *     'transport': '', 
     *     'ip': '', 
     *     'port': '', 
     *     'auth_needed': '', 
     *     'password': '', 
     *     'callACLId': '', 
     *     'countryId': '', 
     *     'areaCode': '', 
     *     'outgoingDDIId': '', 
     *     'priority': '', 
     *     'disallow': '', 
     *     'allow': '', 
     *     'direct_media_method': '', 
     *     'callerid_update_header': '', 
     *     'update_callerid': '', 
     *     'from_domain': '', 
     *     'directConnectivity': '', 
     *     'languageId': ''
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
                'companyId',
                'name',
                'domain',
                'description',
                'transport',
                'ip',
                'port',
                'authNeeded',
                'password',
                'callACLId',
                'countryId',
                'areaCode',
                'outgoingDDIId',
                'priority',
                'disallow',
                'allow',
                'directMediaMethod',
                'calleridUpdateHeader',
                'updateCallerid',
                'fromDomain',
                'directConnectivity',
                'languageId',
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

        $etag = $this->_cache->getEtagVersions('Friends');

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

        $mapper = new Mappers\Friends();

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
     * @ApiDescription(section="Friends", description="Get information about Friends")
     * @ApiMethod(type="get")
     * @ApiRoute(name="/rest/friends/{id}")
     * @ApiParams(name="id", type="int", nullable=false, description="", sample="")
     * @ApiReturnHeaders(sample="HTTP 200 OK")
     * @ApiReturn(type="object", sample="{
     *     'id': '', 
     *     'companyId': '', 
     *     'name': '', 
     *     'domain': '', 
     *     'description': '', 
     *     'transport': '', 
     *     'ip': '', 
     *     'port': '', 
     *     'auth_needed': '', 
     *     'password': '', 
     *     'callACLId': '', 
     *     'countryId': '', 
     *     'areaCode': '', 
     *     'outgoingDDIId': '', 
     *     'priority': '', 
     *     'disallow': '', 
     *     'allow': '', 
     *     'direct_media_method': '', 
     *     'callerid_update_header': '', 
     *     'update_callerid': '', 
     *     'from_domain': '', 
     *     'directConnectivity': '', 
     *     'languageId': ''
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
                'companyId',
                'name',
                'domain',
                'description',
                'transport',
                'ip',
                'port',
                'authNeeded',
                'password',
                'callACLId',
                'countryId',
                'areaCode',
                'outgoingDDIId',
                'priority',
                'disallow',
                'allow',
                'directMediaMethod',
                'calleridUpdateHeader',
                'updateCallerid',
                'fromDomain',
                'directConnectivity',
                'languageId',
            );
        }

        $etag = $this->_cache->getEtagVersions('Friends');
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

        $mapper = new Mappers\Friends();
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
     * @ApiDescription(section="Friends", description="Create's a new Friends")
     * @ApiMethod(type="post")
     * @ApiRoute(name="/rest/friends/")
     * @ApiParams(name="companyId", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="name", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="domain", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="description", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="transport", nullable=false, type="varchar", sample="", description="[enum:udp|tcp|tls]")
     * @ApiParams(name="ip", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="port", nullable=true, type="smallint", sample="", description="")
     * @ApiParams(name="auth_needed", nullable=false, type="enum('yes','no')", sample="", description="")
     * @ApiParams(name="password", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="callACLId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="countryId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="areaCode", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="outgoingDDIId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="priority", nullable=false, type="smallint", sample="", description="")
     * @ApiParams(name="disallow", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="allow", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="direct_media_method", nullable=false, type="enum('invite','update')", sample="", description="[enum:invite|update]")
     * @ApiParams(name="callerid_update_header", nullable=false, type="enum('pai','rpid')", sample="", description="[enum:pai|rpid]")
     * @ApiParams(name="update_callerid", nullable=false, type="enum('yes','no')", sample="", description="[enum:yes|no]")
     * @ApiParams(name="from_domain", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="directConnectivity", nullable=false, type="enum('yes','no')", sample="", description="[enum:yes|no]")
     * @ApiParams(name="languageId", nullable=true, type="int", sample="", description="")
     * @ApiReturnHeaders(sample="HTTP 201")
     * @ApiReturnHeaders(sample="Location: /rest/friends/{id}")
     * @ApiReturn(type="object", sample="{}")
     */
    public function postAction()
    {

        $params = $this->getRequest()->getParams();

        $model = new Models\Friends();

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
     * @ApiDescription(section="Friends", description="Table Friends")
     * @ApiMethod(type="put")
     * @ApiRoute(name="/rest/friends/")
     * @ApiParams(name="id", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="companyId", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="name", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="domain", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="description", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="transport", nullable=false, type="varchar", sample="", description="[enum:udp|tcp|tls]")
     * @ApiParams(name="ip", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="port", nullable=true, type="smallint", sample="", description="")
     * @ApiParams(name="auth_needed", nullable=false, type="enum('yes','no')", sample="", description="")
     * @ApiParams(name="password", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="callACLId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="countryId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="areaCode", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="outgoingDDIId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="priority", nullable=false, type="smallint", sample="", description="")
     * @ApiParams(name="disallow", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="allow", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="direct_media_method", nullable=false, type="enum('invite','update')", sample="", description="[enum:invite|update]")
     * @ApiParams(name="callerid_update_header", nullable=false, type="enum('pai','rpid')", sample="", description="[enum:pai|rpid]")
     * @ApiParams(name="update_callerid", nullable=false, type="enum('yes','no')", sample="", description="[enum:yes|no]")
     * @ApiParams(name="from_domain", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="directConnectivity", nullable=false, type="enum('yes','no')", sample="", description="[enum:yes|no]")
     * @ApiParams(name="languageId", nullable=true, type="int", sample="", description="")
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

        $mapper = new Mappers\Friends();
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
     * @ApiDescription(section="Friends", description="Table Friends")
     * @ApiMethod(type="delete")
     * @ApiRoute(name="/rest/friends/")
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

        $mapper = new Mappers\Friends();
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
                'companyId' => array(
                    'type' => "int",
                    'required' => true,
                    'comment' => '',
                ),
                'name' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'domain' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'description' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'transport' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '[enum:udp|tcp|tls]',
                ),
                'ip' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'port' => array(
                    'type' => "smallint",
                    'required' => false,
                    'comment' => '',
                ),
                'auth_needed' => array(
                    'type' => "enum('yes','no')",
                    'required' => true,
                    'comment' => '',
                ),
                'password' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'callACLId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'countryId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'areaCode' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'outgoingDDIId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'priority' => array(
                    'type' => "smallint",
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
                'direct_media_method' => array(
                    'type' => "enum('invite','update')",
                    'required' => true,
                    'comment' => '[enum:invite|update]',
                ),
                'callerid_update_header' => array(
                    'type' => "enum('pai','rpid')",
                    'required' => true,
                    'comment' => '[enum:pai|rpid]',
                ),
                'update_callerid' => array(
                    'type' => "enum('yes','no')",
                    'required' => true,
                    'comment' => '[enum:yes|no]',
                ),
                'from_domain' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'directConnectivity' => array(
                    'type' => "enum('yes','no')",
                    'required' => true,
                    'comment' => '[enum:yes|no]',
                ),
                'languageId' => array(
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
                'companyId' => array(
                    'type' => "int",
                    'required' => true,
                    'comment' => '',
                ),
                'name' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'domain' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'description' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'transport' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '[enum:udp|tcp|tls]',
                ),
                'ip' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'port' => array(
                    'type' => "smallint",
                    'required' => false,
                    'comment' => '',
                ),
                'auth_needed' => array(
                    'type' => "enum('yes','no')",
                    'required' => true,
                    'comment' => '',
                ),
                'password' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'callACLId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'countryId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'areaCode' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'outgoingDDIId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'priority' => array(
                    'type' => "smallint",
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
                'direct_media_method' => array(
                    'type' => "enum('invite','update')",
                    'required' => true,
                    'comment' => '[enum:invite|update]',
                ),
                'callerid_update_header' => array(
                    'type' => "enum('pai','rpid')",
                    'required' => true,
                    'comment' => '[enum:pai|rpid]',
                ),
                'update_callerid' => array(
                    'type' => "enum('yes','no')",
                    'required' => true,
                    'comment' => '[enum:yes|no]',
                ),
                'from_domain' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'directConnectivity' => array(
                    'type' => "enum('yes','no')",
                    'required' => true,
                    'comment' => '[enum:yes|no]',
                ),
                'languageId' => array(
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