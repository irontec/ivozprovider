<?php
/**
 * KamTrunksUacreg
 */

use IvozProvider\Model as Models;
use IvozProvider\Mapper\Sql as Mappers;

class Rest_KamTrunksUacregController extends Iron_Controller_Rest_BaseController
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
     * @ApiDescription(section="KamTrunksUacreg", description="GET information about all KamTrunksUacreg")
     * @ApiMethod(type="get")
     * @ApiRoute(name="/rest/kam-trunks-uacreg/")
     * @ApiParams(name="page", type="int", nullable=true, description="", sample="")
     * @ApiParams(name="order", type="string", nullable=true, description="", sample="")
     * @ApiParams(name="search", type="json_encode", nullable=true, description="", sample="")
     * @ApiReturnHeaders(sample="HTTP 200 OK")
     * @ApiReturn(type="object", sample="[{
     *     'id': '', 
     *     'l_uuid': '', 
     *     'l_username': '', 
     *     'l_domain': '', 
     *     'r_username': '', 
     *     'r_domain': '', 
     *     'realm': '', 
     *     'auth_username': '', 
     *     'auth_password': '', 
     *     'auth_proxy': '', 
     *     'expires': '', 
     *     'flags': '', 
     *     'reg_delay': '', 
     *     'brandId': '', 
     *     'peeringContractId': '', 
     *     'multiDDI': ''
     * },{
     *     'id': '', 
     *     'l_uuid': '', 
     *     'l_username': '', 
     *     'l_domain': '', 
     *     'r_username': '', 
     *     'r_domain': '', 
     *     'realm': '', 
     *     'auth_username': '', 
     *     'auth_password': '', 
     *     'auth_proxy': '', 
     *     'expires': '', 
     *     'flags': '', 
     *     'reg_delay': '', 
     *     'brandId': '', 
     *     'peeringContractId': '', 
     *     'multiDDI': ''
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
                'lUuid',
                'lUsername',
                'lDomain',
                'rUsername',
                'rDomain',
                'realm',
                'authUsername',
                'authPassword',
                'authProxy',
                'expires',
                'flags',
                'regDelay',
                'brandId',
                'peeringContractId',
                'multiDDI',
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

        $etag = $this->_cache->getEtagVersions('KamTrunksUacreg');

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

        $mapper = new Mappers\KamTrunksUacreg();

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
     * @ApiDescription(section="KamTrunksUacreg", description="Get information about KamTrunksUacreg")
     * @ApiMethod(type="get")
     * @ApiRoute(name="/rest/kam-trunks-uacreg/{id}")
     * @ApiParams(name="id", type="int", nullable=false, description="", sample="")
     * @ApiReturnHeaders(sample="HTTP 200 OK")
     * @ApiReturn(type="object", sample="{
     *     'id': '', 
     *     'l_uuid': '', 
     *     'l_username': '', 
     *     'l_domain': '', 
     *     'r_username': '', 
     *     'r_domain': '', 
     *     'realm': '', 
     *     'auth_username': '', 
     *     'auth_password': '', 
     *     'auth_proxy': '', 
     *     'expires': '', 
     *     'flags': '', 
     *     'reg_delay': '', 
     *     'brandId': '', 
     *     'peeringContractId': '', 
     *     'multiDDI': ''
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
                'lUuid',
                'lUsername',
                'lDomain',
                'rUsername',
                'rDomain',
                'realm',
                'authUsername',
                'authPassword',
                'authProxy',
                'expires',
                'flags',
                'regDelay',
                'brandId',
                'peeringContractId',
                'multiDDI',
            );
        }

        $etag = $this->_cache->getEtagVersions('KamTrunksUacreg');
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

        $mapper = new Mappers\KamTrunksUacreg();
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
     * @ApiDescription(section="KamTrunksUacreg", description="Create's a new KamTrunksUacreg")
     * @ApiMethod(type="post")
     * @ApiRoute(name="/rest/kam-trunks-uacreg/")
     * @ApiParams(name="l_uuid", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="l_username", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="l_domain", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="r_username", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="r_domain", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="realm", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="auth_username", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="auth_password", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="auth_proxy", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="expires", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="flags", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="reg_delay", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="brandId", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="peeringContractId", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="multiDDI", nullable=false, type="tinyint", sample="", description="")
     * @ApiReturnHeaders(sample="HTTP 201")
     * @ApiReturnHeaders(sample="Location: /rest/kamtrunksuacreg/{id}")
     * @ApiReturn(type="object", sample="{}")
     */
    public function postAction()
    {

        $params = $this->getRequest()->getParams();

        $model = new Models\KamTrunksUacreg();

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
     * @ApiDescription(section="KamTrunksUacreg", description="Table KamTrunksUacreg")
     * @ApiMethod(type="put")
     * @ApiRoute(name="/rest/kam-trunks-uacreg/")
     * @ApiParams(name="id", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="l_uuid", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="l_username", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="l_domain", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="r_username", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="r_domain", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="realm", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="auth_username", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="auth_password", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="auth_proxy", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="expires", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="flags", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="reg_delay", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="brandId", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="peeringContractId", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="multiDDI", nullable=false, type="tinyint", sample="", description="")
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

        $mapper = new Mappers\KamTrunksUacreg();
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
     * @ApiDescription(section="KamTrunksUacreg", description="Table KamTrunksUacreg")
     * @ApiMethod(type="delete")
     * @ApiRoute(name="/rest/kam-trunks-uacreg/")
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

        $mapper = new Mappers\KamTrunksUacreg();
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
                'l_uuid' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'l_username' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'l_domain' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'r_username' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'r_domain' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'realm' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'auth_username' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'auth_password' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'auth_proxy' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'expires' => array(
                    'type' => "int",
                    'required' => true,
                    'comment' => '',
                ),
                'flags' => array(
                    'type' => "int",
                    'required' => true,
                    'comment' => '',
                ),
                'reg_delay' => array(
                    'type' => "int",
                    'required' => true,
                    'comment' => '',
                ),
                'brandId' => array(
                    'type' => "int",
                    'required' => true,
                    'comment' => '',
                ),
                'peeringContractId' => array(
                    'type' => "int",
                    'required' => true,
                    'comment' => '',
                ),
                'multiDDI' => array(
                    'type' => "tinyint",
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
                'l_uuid' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'l_username' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'l_domain' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'r_username' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'r_domain' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'realm' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'auth_username' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'auth_password' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'auth_proxy' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'expires' => array(
                    'type' => "int",
                    'required' => true,
                    'comment' => '',
                ),
                'flags' => array(
                    'type' => "int",
                    'required' => true,
                    'comment' => '',
                ),
                'reg_delay' => array(
                    'type' => "int",
                    'required' => true,
                    'comment' => '',
                ),
                'brandId' => array(
                    'type' => "int",
                    'required' => true,
                    'comment' => '',
                ),
                'peeringContractId' => array(
                    'type' => "int",
                    'required' => true,
                    'comment' => '',
                ),
                'multiDDI' => array(
                    'type' => "tinyint",
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