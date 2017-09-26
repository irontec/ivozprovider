<?php
/**
 * Recordings
 */

use IvozProvider\Model as Models;
use IvozProvider\Mapper\Sql as Mappers;

class Rest_RecordingsController extends Iron_Controller_Rest_BaseController
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
     * @ApiDescription(section="Recordings", description="GET information about all Recordings")
     * @ApiMethod(type="get")
     * @ApiRoute(name="/rest/recordings/")
     * @ApiParams(name="page", type="int", nullable=true, description="", sample="")
     * @ApiParams(name="order", type="string", nullable=true, description="", sample="")
     * @ApiParams(name="search", type="json_encode", nullable=true, description="", sample="")
     * @ApiReturnHeaders(sample="HTTP 200 OK")
     * @ApiReturn(type="object", sample="[{
     *     'id': '', 
     *     'companyId': '', 
     *     'callid': '', 
     *     'calldate': '', 
     *     'type': '', 
     *     'duration': '', 
     *     'caller': '', 
     *     'callee': '', 
     *     'recorder': '', 
     *     'recordedFile': ''
     * },{
     *     'id': '', 
     *     'companyId': '', 
     *     'callid': '', 
     *     'calldate': '', 
     *     'type': '', 
     *     'duration': '', 
     *     'caller': '', 
     *     'callee': '', 
     *     'recorder': '', 
     *     'recordedFile': ''
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
                'callid',
                'calldate',
                'type',
                'duration',
                'caller',
                'callee',
                'recorder',
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

        $etag = $this->_cache->getEtagVersions('Recordings');

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

        $mapper = new Mappers\Recordings();

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
     * @ApiDescription(section="Recordings", description="Get information about Recordings")
     * @ApiMethod(type="get")
     * @ApiRoute(name="/rest/recordings/{id}")
     * @ApiParams(name="id", type="int", nullable=false, description="", sample="")
     * @ApiReturnHeaders(sample="HTTP 200 OK")
     * @ApiReturn(type="object", sample="{
     *     'id': '', 
     *     'companyId': '', 
     *     'callid': '', 
     *     'calldate': '', 
     *     'type': '', 
     *     'duration': '', 
     *     'caller': '', 
     *     'callee': '', 
     *     'recorder': '', 
     *     'recordedFile': ''
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
                'callid',
                'calldate',
                'type',
                'duration',
                'caller',
                'callee',
                'recorder',
            );
        }

        $etag = $this->_cache->getEtagVersions('Recordings');
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

        $mapper = new Mappers\Recordings();
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
     * @ApiDescription(section="Recordings", description="Create's a new Recordings")
     * @ApiMethod(type="post")
     * @ApiRoute(name="/rest/recordings/")
     * @ApiParams(name="companyId", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="callid", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="calldate", nullable=false, type="timestamp", sample="", description="")
     * @ApiParams(name="type", nullable=false, type="enum('ondemand','ddi')", sample="", description="[enum:ondemand|ddi]")
     * @ApiParams(name="duration", nullable=false, type="float", sample="", description="")
     * @ApiParams(name="caller", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="callee", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="recorder", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="recordedFile", nullable=true, type="int", sample="", description="[FSO:keepExtension]")
     * @ApiReturnHeaders(sample="HTTP 201")
     * @ApiReturnHeaders(sample="Location: /rest/recordings/{id}")
     * @ApiReturn(type="object", sample="{}")
     */
    public function postAction()
    {

        $params = $this->getRequest()->getParams();

        $model = new Models\Recordings();

        try {
            if (!empty($_FILES['recordedFile'])) {
                $recordedFile = $_FILES['recordedFile'];
                $model->putRecordedFile($recordedFile['tmp_name'], $recordedFile['name']);
            }

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
     * @ApiDescription(section="Recordings", description="Table Recordings")
     * @ApiMethod(type="put")
     * @ApiRoute(name="/rest/recordings/")
     * @ApiParams(name="id", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="companyId", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="callid", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="calldate", nullable=false, type="timestamp", sample="", description="")
     * @ApiParams(name="type", nullable=false, type="enum('ondemand','ddi')", sample="", description="[enum:ondemand|ddi]")
     * @ApiParams(name="duration", nullable=false, type="float", sample="", description="")
     * @ApiParams(name="caller", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="callee", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="recorder", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="recordedFile", nullable=true, type="int", sample="", description="[FSO:keepExtension]")
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

        $mapper = new Mappers\Recordings();
        $model = $mapper->find($primaryKey);

        if (empty($model)) {
            $this->status->setCode(404);
            return;
        }

        try {
            if (!empty($_FILES['recordedFile'])) {
                $recordedFile = $_FILES['recordedFile'];
                $model->putRecordedFile($recordedFile['tmp_name'], $recordedFile['name']);
            }

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
     * @ApiDescription(section="Recordings", description="Table Recordings")
     * @ApiMethod(type="delete")
     * @ApiRoute(name="/rest/recordings/")
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

        $mapper = new Mappers\Recordings();
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
                'callid' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'calldate' => array(
                    'type' => "timestamp",
                    'required' => true,
                    'comment' => '',
                ),
                'type' => array(
                    'type' => "enum('ondemand','ddi')",
                    'required' => true,
                    'comment' => '[enum:ondemand|ddi]',
                ),
                'duration' => array(
                    'type' => "float",
                    'required' => true,
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
                'recorder' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'recordedFile' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '[FSO:keepExtension]',
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
                'callid' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'calldate' => array(
                    'type' => "timestamp",
                    'required' => true,
                    'comment' => '',
                ),
                'type' => array(
                    'type' => "enum('ondemand','ddi')",
                    'required' => true,
                    'comment' => '[enum:ondemand|ddi]',
                ),
                'duration' => array(
                    'type' => "float",
                    'required' => true,
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
                'recorder' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'recordedFile' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '[FSO:keepExtension]',
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