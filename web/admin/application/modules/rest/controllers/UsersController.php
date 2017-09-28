<?php
/**
 * Users
 */

use IvozProvider\Model as Models;
use IvozProvider\Mapper\Sql as Mappers;

class Rest_UsersController extends Iron_Controller_Rest_BaseController
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
     * @ApiDescription(section="Users", description="GET information about all Users")
     * @ApiMethod(type="get")
     * @ApiRoute(name="/rest/users/")
     * @ApiParams(name="page", type="int", nullable=true, description="", sample="")
     * @ApiParams(name="order", type="string", nullable=true, description="", sample="")
     * @ApiParams(name="search", type="json_encode", nullable=true, description="", sample="")
     * @ApiReturnHeaders(sample="HTTP 200 OK")
     * @ApiReturn(type="object", sample="[{
     *     'id': '', 
     *     'companyId': '', 
     *     'name': '', 
     *     'lastname': '', 
     *     'email': '', 
     *     'pass': '', 
     *     'timezoneId': '', 
     *     'terminalId': '', 
     *     'extensionId': '', 
     *     'outgoingDDIId': '', 
     *     'outgoingDDIRuleId': '', 
     *     'callACLId': '', 
     *     'doNotDisturb': '', 
     *     'isBoss': '', 
     *     'bossAssistantId': '', 
     *     'exceptionBoosAssistantRegExp': '',
     *     'active': '',
     *     'maxCalls': '', 
     *     'externalIpCalls': '', 
     *     'voicemailEnabled': '', 
     *     'voicemailLocutionId': '', 
     *     'voicemailSendMail': '', 
     *     'voicemailAttachSound': '', 
     *     'tokenKey': '', 
     *     'countryId': '', 
     *     'languageId': '', 
     *     'areaCode': '', 
     *     'gsQRCode': ''
     * },{
     *     'id': '', 
     *     'companyId': '', 
     *     'name': '', 
     *     'lastname': '', 
     *     'email': '', 
     *     'pass': '', 
     *     'timezoneId': '', 
     *     'terminalId': '', 
     *     'extensionId': '', 
     *     'outgoingDDIId': '', 
     *     'outgoingDDIRuleId': '', 
     *     'callACLId': '', 
     *     'doNotDisturb': '', 
     *     'isBoss': '', 
     *     'bossAssistantId': '', 
     *     'exceptionBoosAssistantRegExp': '',
     *     'active': '', 
     *     'maxCalls': '', 
     *     'externalIpCalls': '', 
     *     'voicemailEnabled': '', 
     *     'voicemailLocutionId': '', 
     *     'voicemailSendMail': '', 
     *     'voicemailAttachSound': '', 
     *     'tokenKey': '', 
     *     'countryId': '', 
     *     'languageId': '', 
     *     'areaCode': '', 
     *     'gsQRCode': ''
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
                'lastname',
                'email',
                'pass',
                'timezoneId',
                'terminalId',
                'extensionId',
                'outgoingDDIId',
                'outgoingDDIRuleId',
                'callACLId',
                'doNotDisturb',
                'isBoss',
                'bossAssistantId',
                'exceptionBoosAssistantRegExp',
                'active',
                'maxCalls',
                'externalIpCalls',
                'voicemailEnabled',
                'voicemailLocutionId',
                'voicemailSendMail',
                'voicemailAttachSound',
                'tokenKey',
                'countryId',
                'languageId',
                'areaCode',
                'gsQRCode',
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

        $etag = $this->_cache->getEtagVersions('Users');

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

        $mapper = new Mappers\Users();

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
     * @ApiDescription(section="Users", description="Get information about Users")
     * @ApiMethod(type="get")
     * @ApiRoute(name="/rest/users/{id}")
     * @ApiParams(name="id", type="int", nullable=false, description="", sample="")
     * @ApiReturnHeaders(sample="HTTP 200 OK")
     * @ApiReturn(type="object", sample="{
     *     'id': '', 
     *     'companyId': '', 
     *     'name': '', 
     *     'lastname': '', 
     *     'email': '', 
     *     'pass': '', 
     *     'timezoneId': '', 
     *     'terminalId': '', 
     *     'extensionId': '', 
     *     'outgoingDDIId': '', 
     *     'outgoingDDIRuleId': '', 
     *     'callACLId': '', 
     *     'doNotDisturb': '', 
     *     'isBoss': '', 
     *     'bossAssistantId': '', 
     *     'exceptionBoosAssistantRegExp': '',
     *     'active': '', 
     *     'maxCalls': '', 
     *     'externalIpCalls': '', 
     *     'voicemailEnabled': '', 
     *     'voicemailLocutionId': '', 
     *     'voicemailSendMail': '', 
     *     'voicemailAttachSound': '', 
     *     'tokenKey': '', 
     *     'countryId': '', 
     *     'languageId': '', 
     *     'areaCode': '', 
     *     'gsQRCode': ''
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
                'lastname',
                'email',
                'pass',
                'timezoneId',
                'terminalId',
                'extensionId',
                'outgoingDDIId',
                'outgoingDDIRuleId',
                'callACLId',
                'doNotDisturb',
                'isBoss',
                'bossAssistantId',
                'exceptionBoosAssistantRegExp',
                'active',
                'maxCalls',
                'externalIpCalls',
                'voicemailEnabled',
                'voicemailLocutionId',
                'voicemailSendMail',
                'voicemailAttachSound',
                'tokenKey',
                'countryId',
                'languageId',
                'areaCode',
                'gsQRCode',
            );
        }

        $etag = $this->_cache->getEtagVersions('Users');
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

        $mapper = new Mappers\Users();
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
     * @ApiDescription(section="Users", description="Create's a new Users")
     * @ApiMethod(type="post")
     * @ApiRoute(name="/rest/users/")
     * @ApiParams(name="companyId", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="name", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="lastname", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="email", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="pass", nullable=true, type="varchar", sample="", description="[password]")
     * @ApiParams(name="timezoneId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="terminalId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="extensionId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="outgoingDDIId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="outgoingDDIRuleId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="callACLId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="doNotDisturb", nullable=false, type="tinyint", sample="", description="")
     * @ApiParams(name="isBoss", nullable=false, type="tinyint", sample="", description="")
     * @ApiParams(name="bossAssistantId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="exceptionBoosAssistantRegExp", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="active", nullable=false, type="tinyint", sample="", description="")
     * @ApiParams(name="maxCalls", nullable=false, type="smallint", sample="", description="")
     * @ApiParams(name="externalIpCalls", nullable=false, type="tinyint", sample="", description="[enum:0|1|2|3]")
     * @ApiParams(name="voicemailEnabled", nullable=false, type="tinyint", sample="", description="")
     * @ApiParams(name="voicemailLocutionId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="voicemailSendMail", nullable=false, type="tinyint", sample="", description="")
     * @ApiParams(name="voicemailAttachSound", nullable=false, type="tinyint", sample="", description="")
     * @ApiParams(name="tokenKey", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="countryId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="languageId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="areaCode", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="gsQRCode", nullable=false, type="tinyint", sample="", description="")
     * @ApiReturnHeaders(sample="HTTP 201")
     * @ApiReturnHeaders(sample="Location: /rest/users/{id}")
     * @ApiReturn(type="object", sample="{}")
     */
    public function postAction()
    {

        $params = $this->getRequest()->getParams();

        $model = new Models\Users();

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
     * @ApiDescription(section="Users", description="Table Users")
     * @ApiMethod(type="put")
     * @ApiRoute(name="/rest/users/")
     * @ApiParams(name="id", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="companyId", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="name", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="lastname", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="email", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="pass", nullable=true, type="varchar", sample="", description="[password]")
     * @ApiParams(name="timezoneId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="terminalId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="extensionId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="outgoingDDIId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="outgoingDDIRuleId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="callACLId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="doNotDisturb", nullable=false, type="tinyint", sample="", description="")
     * @ApiParams(name="isBoss", nullable=false, type="tinyint", sample="", description="")
     * @ApiParams(name="bossAssistantId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="exceptionBoosAssistantRegExp", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="active", nullable=false, type="tinyint", sample="", description="")
     * @ApiParams(name="maxCalls", nullable=false, type="smallint", sample="", description="")
     * @ApiParams(name="externalIpCalls", nullable=false, type="tinyint", sample="", description="[enum:0|1|2|3]")
     * @ApiParams(name="voicemailEnabled", nullable=false, type="tinyint", sample="", description="")
     * @ApiParams(name="voicemailLocutionId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="voicemailSendMail", nullable=false, type="tinyint", sample="", description="")
     * @ApiParams(name="voicemailAttachSound", nullable=false, type="tinyint", sample="", description="")
     * @ApiParams(name="tokenKey", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="countryId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="languageId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="areaCode", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="gsQRCode", nullable=false, type="tinyint", sample="", description="")
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

        $mapper = new Mappers\Users();
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
     * @ApiDescription(section="Users", description="Table Users")
     * @ApiMethod(type="delete")
     * @ApiRoute(name="/rest/users/")
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

        $mapper = new Mappers\Users();
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
                'lastname' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'email' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'pass' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '[password]',
                ),
                'timezoneId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'terminalId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'extensionId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'outgoingDDIId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'outgoingDDIRuleId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'callACLId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'doNotDisturb' => array(
                    'type' => "tinyint",
                    'required' => true,
                    'comment' => '',
                ),
                'isBoss' => array(
                    'type' => "tinyint",
                    'required' => true,
                    'comment' => '',
                ),
                'bossAssistantId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'exceptionBoosAssistantRegExp' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'active' => array(
                    'type' => "tinyint",
                    'required' => true,
                    'comment' => '',
                ),
                'maxCalls' => array(
                    'type' => "smallint",
                    'required' => true,
                    'comment' => '',
                ),
                'externalIpCalls' => array(
                    'type' => "tinyint",
                    'required' => true,
                    'comment' => '[enum:0|1|2|3]',
                ),
                'voicemailEnabled' => array(
                    'type' => "tinyint",
                    'required' => true,
                    'comment' => '',
                ),
                'voicemailLocutionId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'voicemailSendMail' => array(
                    'type' => "tinyint",
                    'required' => true,
                    'comment' => '',
                ),
                'voicemailAttachSound' => array(
                    'type' => "tinyint",
                    'required' => true,
                    'comment' => '',
                ),
                'tokenKey' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'countryId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'languageId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'areaCode' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'gsQRCode' => array(
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
                'lastname' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'email' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'pass' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '[password]',
                ),
                'timezoneId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'terminalId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'extensionId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'outgoingDDIId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'outgoingDDIRuleId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'callACLId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'doNotDisturb' => array(
                    'type' => "tinyint",
                    'required' => true,
                    'comment' => '',
                ),
                'isBoss' => array(
                    'type' => "tinyint",
                    'required' => true,
                    'comment' => '',
                ),
                'bossAssistantId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'exceptionBoosAssistantRegExp' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'active' => array(
                    'type' => "tinyint",
                    'required' => true,
                    'comment' => '',
                ),
                'maxCalls' => array(
                    'type' => "smallint",
                    'required' => true,
                    'comment' => '',
                ),
                'externalIpCalls' => array(
                    'type' => "tinyint",
                    'required' => true,
                    'comment' => '[enum:0|1|2|3]',
                ),
                'voicemailEnabled' => array(
                    'type' => "tinyint",
                    'required' => true,
                    'comment' => '',
                ),
                'voicemailLocutionId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'voicemailSendMail' => array(
                    'type' => "tinyint",
                    'required' => true,
                    'comment' => '',
                ),
                'voicemailAttachSound' => array(
                    'type' => "tinyint",
                    'required' => true,
                    'comment' => '',
                ),
                'tokenKey' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'countryId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'languageId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'areaCode' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'gsQRCode' => array(
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