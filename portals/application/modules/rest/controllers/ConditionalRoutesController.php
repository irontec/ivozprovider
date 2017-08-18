<?php
/**
 * ConditionalRoutes
 */

use IvozProvider\Model as Models;
use IvozProvider\Mapper\Sql as Mappers;

class Rest_ConditionalRoutesController extends Iron_Controller_Rest_BaseController
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
     * @ApiDescription(section="ConditionalRoutes", description="GET information about all ConditionalRoutes")
     * @ApiMethod(type="get")
     * @ApiRoute(name="/rest/conditional-routes/")
     * @ApiParams(name="page", type="int", nullable=true, description="", sample="")
     * @ApiParams(name="order", type="string", nullable=true, description="", sample="")
     * @ApiParams(name="search", type="json_encode", nullable=true, description="", sample="")
     * @ApiReturnHeaders(sample="HTTP 200 OK")
     * @ApiReturn(type="object", sample="[{
     *     'id': '', 
     *     'companyId': '', 
     *     'name': '', 
     *     'locutionId': '', 
     *     'routeType': '', 
     *     'IVRCommonId': '', 
     *     'IVRCustomId': '', 
     *     'huntGroupId': '', 
     *     'conferenceRoomId': '', 
     *     'userId': '', 
     *     'numberValue': '', 
     *     'friendValue': '', 
     *     'queueId': ''
     * },{
     *     'id': '', 
     *     'companyId': '', 
     *     'name': '', 
     *     'locutionId': '', 
     *     'routeType': '', 
     *     'IVRCommonId': '', 
     *     'IVRCustomId': '', 
     *     'huntGroupId': '', 
     *     'conferenceRoomId': '', 
     *     'userId': '', 
     *     'numberValue': '', 
     *     'friendValue': '', 
     *     'queueId': ''
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
                'locutionId',
                'routeType',
                'IVRCommonId',
                'IVRCustomId',
                'huntGroupId',
                'conferenceRoomId',
                'userId',
                'numberValue',
                'friendValue',
                'queueId',
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

        $etag = $this->_cache->getEtagVersions('ConditionalRoutes');

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

        $mapper = new Mappers\ConditionalRoutes();

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
     * @ApiDescription(section="ConditionalRoutes", description="Get information about ConditionalRoutes")
     * @ApiMethod(type="get")
     * @ApiRoute(name="/rest/conditional-routes/{id}")
     * @ApiParams(name="id", type="int", nullable=false, description="", sample="")
     * @ApiReturnHeaders(sample="HTTP 200 OK")
     * @ApiReturn(type="object", sample="{
     *     'id': '', 
     *     'companyId': '', 
     *     'name': '', 
     *     'locutionId': '', 
     *     'routeType': '', 
     *     'IVRCommonId': '', 
     *     'IVRCustomId': '', 
     *     'huntGroupId': '', 
     *     'conferenceRoomId': '', 
     *     'userId': '', 
     *     'numberValue': '', 
     *     'friendValue': '', 
     *     'queueId': ''
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
                'locutionId',
                'routeType',
                'IVRCommonId',
                'IVRCustomId',
                'huntGroupId',
                'conferenceRoomId',
                'userId',
                'numberValue',
                'friendValue',
                'queueId',
            );
        }

        $etag = $this->_cache->getEtagVersions('ConditionalRoutes');
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

        $mapper = new Mappers\ConditionalRoutes();
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
     * @ApiDescription(section="ConditionalRoutes", description="Create's a new ConditionalRoutes")
     * @ApiMethod(type="post")
     * @ApiRoute(name="/rest/conditional-routes/")
     * @ApiParams(name="companyId", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="name", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="locutionId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="routeType", nullable=true, type="varchar", sample="", description="[enum:user|number|IVRCommon|IVRCustom|huntGroup|conferenceRoom|friend|queue]")
     * @ApiParams(name="IVRCommonId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="IVRCustomId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="huntGroupId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="conferenceRoomId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="userId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="numberValue", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="friendValue", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="queueId", nullable=true, type="int", sample="", description="")
     * @ApiReturnHeaders(sample="HTTP 201")
     * @ApiReturnHeaders(sample="Location: /rest/conditionalroutes/{id}")
     * @ApiReturn(type="object", sample="{}")
     */
    public function postAction()
    {

        $params = $this->getRequest()->getParams();

        $model = new Models\ConditionalRoutes();

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
     * @ApiDescription(section="ConditionalRoutes", description="Table ConditionalRoutes")
     * @ApiMethod(type="put")
     * @ApiRoute(name="/rest/conditional-routes/")
     * @ApiParams(name="id", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="companyId", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="name", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="locutionId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="routeType", nullable=true, type="varchar", sample="", description="[enum:user|number|IVRCommon|IVRCustom|huntGroup|conferenceRoom|friend|queue]")
     * @ApiParams(name="IVRCommonId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="IVRCustomId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="huntGroupId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="conferenceRoomId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="userId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="numberValue", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="friendValue", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="queueId", nullable=true, type="int", sample="", description="")
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

        $mapper = new Mappers\ConditionalRoutes();
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
     * @ApiDescription(section="ConditionalRoutes", description="Table ConditionalRoutes")
     * @ApiMethod(type="delete")
     * @ApiRoute(name="/rest/conditional-routes/")
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

        $mapper = new Mappers\ConditionalRoutes();
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
                'locutionId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'routeType' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '[enum:user|number|IVRCommon|IVRCustom|huntGroup|conferenceRoom|friend|queue]',
                ),
                'IVRCommonId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'IVRCustomId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'huntGroupId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'conferenceRoomId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'userId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'numberValue' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'friendValue' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'queueId' => array(
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
                'locutionId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'routeType' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '[enum:user|number|IVRCommon|IVRCustom|huntGroup|conferenceRoom|friend|queue]',
                ),
                'IVRCommonId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'IVRCustomId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'huntGroupId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'conferenceRoomId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'userId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'numberValue' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'friendValue' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'queueId' => array(
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