<?php
/**
 * Queues
 */

use IvozProvider\Model as Models;
use IvozProvider\Mapper\Sql as Mappers;

class Rest_QueuesController extends Iron_Controller_Rest_BaseController
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
     * @ApiDescription(section="Queues", description="GET information about all Queues")
     * @ApiMethod(type="get")
     * @ApiRoute(name="/rest/queues/")
     * @ApiParams(name="page", type="int", nullable=true, description="", sample="")
     * @ApiParams(name="order", type="string", nullable=true, description="", sample="")
     * @ApiParams(name="search", type="json_encode", nullable=true, description="", sample="")
     * @ApiReturnHeaders(sample="HTTP 200 OK")
     * @ApiReturn(type="object", sample="[{
     *     'id': '', 
     *     'companyId': '', 
     *     'name': '', 
     *     'maxWaitTime': '', 
     *     'timeoutLocutionId': '', 
     *     'timeoutTargetType': '', 
     *     'timeoutNumberValue': '', 
     *     'timeoutExtensionId': '', 
     *     'timeoutVoiceMailUserId': '', 
     *     'maxlen': '', 
     *     'fullLocutionId': '', 
     *     'fullTargetType': '', 
     *     'fullNumberValue': '', 
     *     'fullExtensionId': '', 
     *     'fullVoiceMailUserId': '', 
     *     'periodicAnnounceLocutionId': '', 
     *     'periodicAnnounceFrequency': '', 
     *     'memberCallRest': '', 
     *     'memberCallTimeout': '', 
     *     'strategy': '', 
     *     'weight': ''
     * },{
     *     'id': '', 
     *     'companyId': '', 
     *     'name': '', 
     *     'maxWaitTime': '', 
     *     'timeoutLocutionId': '', 
     *     'timeoutTargetType': '', 
     *     'timeoutNumberValue': '', 
     *     'timeoutExtensionId': '', 
     *     'timeoutVoiceMailUserId': '', 
     *     'maxlen': '', 
     *     'fullLocutionId': '', 
     *     'fullTargetType': '', 
     *     'fullNumberValue': '', 
     *     'fullExtensionId': '', 
     *     'fullVoiceMailUserId': '', 
     *     'periodicAnnounceLocutionId': '', 
     *     'periodicAnnounceFrequency': '', 
     *     'memberCallRest': '', 
     *     'memberCallTimeout': '', 
     *     'strategy': '', 
     *     'weight': ''
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
                'maxWaitTime',
                'timeoutLocutionId',
                'timeoutTargetType',
                'timeoutNumberValue',
                'timeoutExtensionId',
                'timeoutVoiceMailUserId',
                'maxlen',
                'fullLocutionId',
                'fullTargetType',
                'fullNumberValue',
                'fullExtensionId',
                'fullVoiceMailUserId',
                'periodicAnnounceLocutionId',
                'periodicAnnounceFrequency',
                'memberCallRest',
                'memberCallTimeout',
                'strategy',
                'weight',
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

        $etag = $this->_cache->getEtagVersions('Queues');

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

        $mapper = new Mappers\Queues();

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
     * @ApiDescription(section="Queues", description="Get information about Queues")
     * @ApiMethod(type="get")
     * @ApiRoute(name="/rest/queues/{id}")
     * @ApiParams(name="id", type="int", nullable=false, description="", sample="")
     * @ApiReturnHeaders(sample="HTTP 200 OK")
     * @ApiReturn(type="object", sample="{
     *     'id': '', 
     *     'companyId': '', 
     *     'name': '', 
     *     'maxWaitTime': '', 
     *     'timeoutLocutionId': '', 
     *     'timeoutTargetType': '', 
     *     'timeoutNumberValue': '', 
     *     'timeoutExtensionId': '', 
     *     'timeoutVoiceMailUserId': '', 
     *     'maxlen': '', 
     *     'fullLocutionId': '', 
     *     'fullTargetType': '', 
     *     'fullNumberValue': '', 
     *     'fullExtensionId': '', 
     *     'fullVoiceMailUserId': '', 
     *     'periodicAnnounceLocutionId': '', 
     *     'periodicAnnounceFrequency': '', 
     *     'memberCallRest': '', 
     *     'memberCallTimeout': '', 
     *     'strategy': '', 
     *     'weight': ''
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
                'maxWaitTime',
                'timeoutLocutionId',
                'timeoutTargetType',
                'timeoutNumberValue',
                'timeoutExtensionId',
                'timeoutVoiceMailUserId',
                'maxlen',
                'fullLocutionId',
                'fullTargetType',
                'fullNumberValue',
                'fullExtensionId',
                'fullVoiceMailUserId',
                'periodicAnnounceLocutionId',
                'periodicAnnounceFrequency',
                'memberCallRest',
                'memberCallTimeout',
                'strategy',
                'weight',
            );
        }

        $etag = $this->_cache->getEtagVersions('Queues');
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

        $mapper = new Mappers\Queues();
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
     * @ApiDescription(section="Queues", description="Create's a new Queues")
     * @ApiMethod(type="post")
     * @ApiRoute(name="/rest/queues/")
     * @ApiParams(name="companyId", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="name", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="maxWaitTime", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="timeoutLocutionId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="timeoutTargetType", nullable=true, type="varchar", sample="", description="[enum:number|extension|voicemail]")
     * @ApiParams(name="timeoutNumberValue", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="timeoutExtensionId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="timeoutVoiceMailUserId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="maxlen", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="fullLocutionId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="fullTargetType", nullable=true, type="varchar", sample="", description="[enum:number|extension|voicemail]")
     * @ApiParams(name="fullNumberValue", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="fullExtensionId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="fullVoiceMailUserId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="periodicAnnounceLocutionId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="periodicAnnounceFrequency", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="memberCallRest", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="memberCallTimeout", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="strategy", nullable=true, type="enum('ringall','leastrecent','fewestcalls','random','rrmemory','linear','wrandom','rrordered')", sample="", description="")
     * @ApiParams(name="weight", nullable=true, type="int", sample="", description="")
     * @ApiReturnHeaders(sample="HTTP 201")
     * @ApiReturnHeaders(sample="Location: /rest/queues/{id}")
     * @ApiReturn(type="object", sample="{}")
     */
    public function postAction()
    {

        $params = $this->getRequest()->getParams();

        $model = new Models\Queues();

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
     * @ApiDescription(section="Queues", description="Table Queues")
     * @ApiMethod(type="put")
     * @ApiRoute(name="/rest/queues/")
     * @ApiParams(name="id", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="companyId", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="name", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="maxWaitTime", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="timeoutLocutionId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="timeoutTargetType", nullable=true, type="varchar", sample="", description="[enum:number|extension|voicemail]")
     * @ApiParams(name="timeoutNumberValue", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="timeoutExtensionId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="timeoutVoiceMailUserId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="maxlen", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="fullLocutionId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="fullTargetType", nullable=true, type="varchar", sample="", description="[enum:number|extension|voicemail]")
     * @ApiParams(name="fullNumberValue", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="fullExtensionId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="fullVoiceMailUserId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="periodicAnnounceLocutionId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="periodicAnnounceFrequency", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="memberCallRest", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="memberCallTimeout", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="strategy", nullable=true, type="enum('ringall','leastrecent','fewestcalls','random','rrmemory','linear','wrandom','rrordered')", sample="", description="")
     * @ApiParams(name="weight", nullable=true, type="int", sample="", description="")
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

        $mapper = new Mappers\Queues();
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
     * @ApiDescription(section="Queues", description="Table Queues")
     * @ApiMethod(type="delete")
     * @ApiRoute(name="/rest/queues/")
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

        $mapper = new Mappers\Queues();
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
                    'required' => false,
                    'comment' => '',
                ),
                'maxWaitTime' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'timeoutLocutionId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'timeoutTargetType' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '[enum:number|extension|voicemail]',
                ),
                'timeoutNumberValue' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'timeoutExtensionId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'timeoutVoiceMailUserId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'maxlen' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'fullLocutionId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'fullTargetType' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '[enum:number|extension|voicemail]',
                ),
                'fullNumberValue' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'fullExtensionId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'fullVoiceMailUserId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'periodicAnnounceLocutionId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'periodicAnnounceFrequency' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'memberCallRest' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'memberCallTimeout' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'strategy' => array(
                    'type' => "enum('ringall','leastrecent','fewestcalls','random','rrmemory','linear','wrandom','rrordered')",
                    'required' => false,
                    'comment' => '',
                ),
                'weight' => array(
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
                    'required' => false,
                    'comment' => '',
                ),
                'maxWaitTime' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'timeoutLocutionId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'timeoutTargetType' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '[enum:number|extension|voicemail]',
                ),
                'timeoutNumberValue' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'timeoutExtensionId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'timeoutVoiceMailUserId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'maxlen' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'fullLocutionId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'fullTargetType' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '[enum:number|extension|voicemail]',
                ),
                'fullNumberValue' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'fullExtensionId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'fullVoiceMailUserId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'periodicAnnounceLocutionId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'periodicAnnounceFrequency' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'memberCallRest' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'memberCallTimeout' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'strategy' => array(
                    'type' => "enum('ringall','leastrecent','fewestcalls','random','rrmemory','linear','wrandom','rrordered')",
                    'required' => false,
                    'comment' => '',
                ),
                'weight' => array(
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