<?php
/**
 * Companies
 */

use IvozProvider\Model as Models;
use IvozProvider\Mapper\Sql as Mappers;

class Rest_CompaniesController extends Iron_Controller_Rest_BaseController
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
     * @ApiDescription(section="Companies", description="GET information about all Companies")
     * @ApiMethod(type="get")
     * @ApiRoute(name="/rest/companies/")
     * @ApiParams(name="page", type="int", nullable=true, description="", sample="")
     * @ApiParams(name="order", type="string", nullable=true, description="", sample="")
     * @ApiParams(name="search", type="json_encode", nullable=true, description="", sample="")
     * @ApiReturnHeaders(sample="HTTP 200 OK")
     * @ApiReturn(type="object", sample="[{
     *     'id': '', 
     *     'brandId': '', 
     *     'type': '', 
     *     'name': '', 
     *     'domain_users': '', 
     *     'nif': '', 
     *     'defaultTimezoneId': '', 
     *     'applicationServerId': '', 
     *     'externalMaxCalls': '', 
     *     'postalAddress': '', 
     *     'postalCode': '', 
     *     'town': '', 
     *     'province': '', 
     *     'country': '', 
     *     'outbound_prefix': '', 
     *     'countryId': '', 
     *     'languageId': '', 
     *     'mediaRelaySetsId': '', 
     *     'ipFilter': '', 
     *     'onDemandRecord': '', 
     *     'onDemandRecordCode': '', 
     *     'areaCode': '', 
     *     'externallyExtraOpts': '', 
     *     'recordingsLimitMB': '', 
     *     'recordingsLimitEmail': '', 
     *     'outgoingDDIId': '', 
     *     'outgoingDDIRuleId': ''
     * },{
     *     'id': '', 
     *     'brandId': '', 
     *     'type': '', 
     *     'name': '', 
     *     'domain_users': '', 
     *     'nif': '', 
     *     'defaultTimezoneId': '', 
     *     'applicationServerId': '', 
     *     'externalMaxCalls': '', 
     *     'postalAddress': '', 
     *     'postalCode': '', 
     *     'town': '', 
     *     'province': '', 
     *     'country': '', 
     *     'outbound_prefix': '', 
     *     'countryId': '', 
     *     'languageId': '', 
     *     'mediaRelaySetsId': '', 
     *     'ipFilter': '', 
     *     'onDemandRecord': '', 
     *     'onDemandRecordCode': '', 
     *     'areaCode': '', 
     *     'externallyExtraOpts': '', 
     *     'recordingsLimitMB': '', 
     *     'recordingsLimitEmail': '', 
     *     'outgoingDDIId': '', 
     *     'outgoingDDIRuleId': ''
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
                'brandId',
                'type',
                'name',
                'domainUsers',
                'nif',
                'defaultTimezoneId',
                'applicationServerId',
                'externalMaxCalls',
                'postalAddress',
                'postalCode',
                'town',
                'province',
                'country',
                'outboundPrefix',
                'countryId',
                'languageId',
                'mediaRelaySetsId',
                'ipFilter',
                'onDemandRecord',
                'onDemandRecordCode',
                'areaCode',
                'externallyExtraOpts',
                'recordingsLimitMB',
                'recordingsLimitEmail',
                'outgoingDDIId',
                'outgoingDDIRuleId',
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

        $etag = $this->_cache->getEtagVersions('Companies');

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

        $mapper = new Mappers\Companies();

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
     * @ApiDescription(section="Companies", description="Get information about Companies")
     * @ApiMethod(type="get")
     * @ApiRoute(name="/rest/companies/{id}")
     * @ApiParams(name="id", type="int", nullable=false, description="", sample="")
     * @ApiReturnHeaders(sample="HTTP 200 OK")
     * @ApiReturn(type="object", sample="{
     *     'id': '', 
     *     'brandId': '', 
     *     'type': '', 
     *     'name': '', 
     *     'domain_users': '', 
     *     'nif': '', 
     *     'defaultTimezoneId': '', 
     *     'applicationServerId': '', 
     *     'externalMaxCalls': '', 
     *     'postalAddress': '', 
     *     'postalCode': '', 
     *     'town': '', 
     *     'province': '', 
     *     'country': '', 
     *     'outbound_prefix': '', 
     *     'countryId': '', 
     *     'languageId': '', 
     *     'mediaRelaySetsId': '', 
     *     'ipFilter': '', 
     *     'onDemandRecord': '', 
     *     'onDemandRecordCode': '', 
     *     'areaCode': '', 
     *     'externallyExtraOpts': '', 
     *     'recordingsLimitMB': '', 
     *     'recordingsLimitEmail': '', 
     *     'outgoingDDIId': '', 
     *     'outgoingDDIRuleId': ''
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
                'brandId',
                'type',
                'name',
                'domainUsers',
                'nif',
                'defaultTimezoneId',
                'applicationServerId',
                'externalMaxCalls',
                'postalAddress',
                'postalCode',
                'town',
                'province',
                'country',
                'outboundPrefix',
                'countryId',
                'languageId',
                'mediaRelaySetsId',
                'ipFilter',
                'onDemandRecord',
                'onDemandRecordCode',
                'areaCode',
                'externallyExtraOpts',
                'recordingsLimitMB',
                'recordingsLimitEmail',
                'outgoingDDIId',
                'outgoingDDIRuleId',
            );
        }

        $etag = $this->_cache->getEtagVersions('Companies');
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

        $mapper = new Mappers\Companies();
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
     * @ApiDescription(section="Companies", description="Create's a new Companies")
     * @ApiMethod(type="post")
     * @ApiRoute(name="/rest/companies/")
     * @ApiParams(name="brandId", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="type", nullable=false, type="varchar", sample="", description="[enum:vpbx|retail]")
     * @ApiParams(name="name", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="domain_users", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="nif", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="defaultTimezoneId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="applicationServerId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="externalMaxCalls", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="postalAddress", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="postalCode", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="town", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="province", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="country", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="outbound_prefix", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="countryId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="languageId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="mediaRelaySetsId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="ipFilter", nullable=true, type="tinyint", sample="", description="")
     * @ApiParams(name="onDemandRecord", nullable=true, type="tinyint", sample="", description="")
     * @ApiParams(name="onDemandRecordCode", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="areaCode", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="externallyExtraOpts", nullable=true, type="text", sample="", description="")
     * @ApiParams(name="recordingsLimitMB", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="recordingsLimitEmail", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="outgoingDDIId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="outgoingDDIRuleId", nullable=true, type="int", sample="", description="")
     * @ApiReturnHeaders(sample="HTTP 201")
     * @ApiReturnHeaders(sample="Location: /rest/companies/{id}")
     * @ApiReturn(type="object", sample="{}")
     */
    public function postAction()
    {

        $params = $this->getRequest()->getParams();

        $model = new Models\Companies();

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
     * @ApiDescription(section="Companies", description="Table Companies")
     * @ApiMethod(type="put")
     * @ApiRoute(name="/rest/companies/")
     * @ApiParams(name="id", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="brandId", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="type", nullable=false, type="varchar", sample="", description="[enum:vpbx|retail]")
     * @ApiParams(name="name", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="domain_users", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="nif", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="defaultTimezoneId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="applicationServerId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="externalMaxCalls", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="postalAddress", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="postalCode", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="town", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="province", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="country", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="outbound_prefix", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="countryId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="languageId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="mediaRelaySetsId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="ipFilter", nullable=true, type="tinyint", sample="", description="")
     * @ApiParams(name="onDemandRecord", nullable=true, type="tinyint", sample="", description="")
     * @ApiParams(name="onDemandRecordCode", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="areaCode", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="externallyExtraOpts", nullable=true, type="text", sample="", description="")
     * @ApiParams(name="recordingsLimitMB", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="recordingsLimitEmail", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="outgoingDDIId", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="outgoingDDIRuleId", nullable=true, type="int", sample="", description="")
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

        $mapper = new Mappers\Companies();
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
     * @ApiDescription(section="Companies", description="Table Companies")
     * @ApiMethod(type="delete")
     * @ApiRoute(name="/rest/companies/")
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

        $mapper = new Mappers\Companies();
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
                'brandId' => array(
                    'type' => "int",
                    'required' => true,
                    'comment' => '',
                ),
                'type' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '[enum:vpbx|retail]',
                ),
                'name' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'domain_users' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'nif' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'defaultTimezoneId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'applicationServerId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'externalMaxCalls' => array(
                    'type' => "int",
                    'required' => true,
                    'comment' => '',
                ),
                'postalAddress' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'postalCode' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'town' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'province' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'country' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'outbound_prefix' => array(
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
                'mediaRelaySetsId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'ipFilter' => array(
                    'type' => "tinyint",
                    'required' => false,
                    'comment' => '',
                ),
                'onDemandRecord' => array(
                    'type' => "tinyint",
                    'required' => false,
                    'comment' => '',
                ),
                'onDemandRecordCode' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'areaCode' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'externallyExtraOpts' => array(
                    'type' => "text",
                    'required' => false,
                    'comment' => '',
                ),
                'recordingsLimitMB' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'recordingsLimitEmail' => array(
                    'type' => "varchar",
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
                'brandId' => array(
                    'type' => "int",
                    'required' => true,
                    'comment' => '',
                ),
                'type' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '[enum:vpbx|retail]',
                ),
                'name' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'domain_users' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'nif' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'defaultTimezoneId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'applicationServerId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'externalMaxCalls' => array(
                    'type' => "int",
                    'required' => true,
                    'comment' => '',
                ),
                'postalAddress' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'postalCode' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'town' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'province' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'country' => array(
                    'type' => "varchar",
                    'required' => true,
                    'comment' => '',
                ),
                'outbound_prefix' => array(
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
                'mediaRelaySetsId' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'ipFilter' => array(
                    'type' => "tinyint",
                    'required' => false,
                    'comment' => '',
                ),
                'onDemandRecord' => array(
                    'type' => "tinyint",
                    'required' => false,
                    'comment' => '',
                ),
                'onDemandRecordCode' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'areaCode' => array(
                    'type' => "varchar",
                    'required' => false,
                    'comment' => '',
                ),
                'externallyExtraOpts' => array(
                    'type' => "text",
                    'required' => false,
                    'comment' => '',
                ),
                'recordingsLimitMB' => array(
                    'type' => "int",
                    'required' => false,
                    'comment' => '',
                ),
                'recordingsLimitEmail' => array(
                    'type' => "varchar",
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