<?php
/**
 * ast_ps_aors
 */

use IvozProvider\Model as Models;
use IvozProvider\Mapper\Sql as Mappers;

class Rest_ast_ps_aorsController extends Iron_Controller_Rest_BaseController
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
     * @ApiDescription(section="ast_ps_aors", description="GET information about all ast_ps_aors")
     * @ApiMethod(type="get")
     * @ApiRoute(name="/rest/ast_ps_aors/")
     * @ApiParams(name="page", type="int", nullable=true, description="", sample="")
     * @ApiParams(name="order", type="string", nullable=true, description="", sample="")
     * @ApiParams(name="search", type="json_encode", nullable=true, description="", sample="")
     * @ApiReturnHeaders(sample="HTTP 200 OK")
     * @ApiReturn(type="object", sample="[{
     *     'id': '', 
     *     'sorcery_id': '', 
     *     'default_expiration': '', 
     *     'max_contacts': '', 
     *     'minimum_expiration': '', 
     *     'remove_existing': '', 
     *     'authenticate_qualify': '', 
     *     'maximum_expiration': '', 
     *     'support_path': '', 
     *     'contact': '', 
     *     'qualify_frequency': ''
     * },{
     *     'id': '', 
     *     'sorcery_id': '', 
     *     'default_expiration': '', 
     *     'max_contacts': '', 
     *     'minimum_expiration': '', 
     *     'remove_existing': '', 
     *     'authenticate_qualify': '', 
     *     'maximum_expiration': '', 
     *     'support_path': '', 
     *     'contact': '', 
     *     'qualify_frequency': ''
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
                'defaultExpiration',
                'maxContacts',
                'minimumExpiration',
                'removeExisting',
                'authenticateQualify',
                'maximumExpiration',
                'supportPath',
                'contact',
                'qualifyFrequency',
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

        $etag = $this->_cache->getEtagVersions('ast_ps_aors');

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

        $mapper = new Mappers\ast_ps_aors();

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
     * @ApiDescription(section="ast_ps_aors", description="Get information about ast_ps_aors")
     * @ApiMethod(type="get")
     * @ApiRoute(name="/rest/ast_ps_aors/{id}")
     * @ApiParams(name="id", type="int", nullable=false, description="", sample="")
     * @ApiReturnHeaders(sample="HTTP 200 OK")
     * @ApiReturn(type="object", sample="{
     *     'id': '', 
     *     'sorcery_id': '', 
     *     'default_expiration': '', 
     *     'max_contacts': '', 
     *     'minimum_expiration': '', 
     *     'remove_existing': '', 
     *     'authenticate_qualify': '', 
     *     'maximum_expiration': '', 
     *     'support_path': '', 
     *     'contact': '', 
     *     'qualify_frequency': ''
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
                'defaultExpiration',
                'maxContacts',
                'minimumExpiration',
                'removeExisting',
                'authenticateQualify',
                'maximumExpiration',
                'supportPath',
                'contact',
                'qualifyFrequency',
            );
        }

        $etag = $this->_cache->getEtagVersions('ast_ps_aors');
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

        $mapper = new Mappers\ast_ps_aors();
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
     * @ApiDescription(section="ast_ps_aors", description="Create's a new ast_ps_aors")
     * @ApiMethod(type="post")
     * @ApiRoute(name="/rest/ast_ps_aors/")
     * @ApiParams(name="sorcery_id", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="default_expiration", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="max_contacts", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="minimum_expiration", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="remove_existing", nullable=true, type="enum('yes','no')", sample="", description="")
     * @ApiParams(name="authenticate_qualify", nullable=true, type="enum('yes','no')", sample="", description="")
     * @ApiParams(name="maximum_expiration", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="support_path", nullable=true, type="enum('yes','no')", sample="", description="")
     * @ApiParams(name="contact", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="qualify_frequency", nullable=true, type="int", sample="", description="")
     * @ApiReturnHeaders(sample="HTTP 201")
     * @ApiReturnHeaders(sample="Location: /rest/ast_ps_aors/{id}")
     * @ApiReturn(type="object", sample="{}")
     */
    public function postAction()
    {

        $params = $this->getRequest()->getParams();

        $model = new Models\ast_ps_aors();

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
     * @ApiDescription(section="ast_ps_aors", description="Table ast_ps_aors")
     * @ApiMethod(type="put")
     * @ApiRoute(name="/rest/ast_ps_aors/")
     * @ApiParams(name="id", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="sorcery_id", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="default_expiration", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="max_contacts", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="minimum_expiration", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="remove_existing", nullable=true, type="enum('yes','no')", sample="", description="")
     * @ApiParams(name="authenticate_qualify", nullable=true, type="enum('yes','no')", sample="", description="")
     * @ApiParams(name="maximum_expiration", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="support_path", nullable=true, type="enum('yes','no')", sample="", description="")
     * @ApiParams(name="contact", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="qualify_frequency", nullable=true, type="int", sample="", description="")
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

        $mapper = new Mappers\ast_ps_aors();
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
     * @ApiDescription(section="ast_ps_aors", description="Table ast_ps_aors")
     * @ApiMethod(type="delete")
     * @ApiRoute(name="/rest/ast_ps_aors/")
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

        $mapper = new Mappers\ast_ps_aors();
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
                'default_expiration' => array(
                    'type' => 'int',
                    'required' => false,
                    'comment' => '',
                ),
                'max_contacts' => array(
                    'type' => 'int',
                    'required' => false,
                    'comment' => '',
                ),
                'minimum_expiration' => array(
                    'type' => 'int',
                    'required' => false,
                    'comment' => '',
                ),
                'remove_existing' => array(
                    'type' => 'enum('yes','no')',
                    'required' => false,
                    'comment' => '',
                ),
                'authenticate_qualify' => array(
                    'type' => 'enum('yes','no')',
                    'required' => false,
                    'comment' => '',
                ),
                'maximum_expiration' => array(
                    'type' => 'int',
                    'required' => false,
                    'comment' => '',
                ),
                'support_path' => array(
                    'type' => 'enum('yes','no')',
                    'required' => false,
                    'comment' => '',
                ),
                'contact' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'qualify_frequency' => array(
                    'type' => 'int',
                    'required' => false,
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
                'default_expiration' => array(
                    'type' => 'int',
                    'required' => false,
                    'comment' => '',
                ),
                'max_contacts' => array(
                    'type' => 'int',
                    'required' => false,
                    'comment' => '',
                ),
                'minimum_expiration' => array(
                    'type' => 'int',
                    'required' => false,
                    'comment' => '',
                ),
                'remove_existing' => array(
                    'type' => 'enum('yes','no')',
                    'required' => false,
                    'comment' => '',
                ),
                'authenticate_qualify' => array(
                    'type' => 'enum('yes','no')',
                    'required' => false,
                    'comment' => '',
                ),
                'maximum_expiration' => array(
                    'type' => 'int',
                    'required' => false,
                    'comment' => '',
                ),
                'support_path' => array(
                    'type' => 'enum('yes','no')',
                    'required' => false,
                    'comment' => '',
                ),
                'contact' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'qualify_frequency' => array(
                    'type' => 'int',
                    'required' => false,
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