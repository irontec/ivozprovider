<?php
/**
 * ast_voicemail
 */

use IvozProvider\Model as Models;
use IvozProvider\Mapper\Sql as Mappers;

class Rest_ast_voicemailController extends Iron_Controller_Rest_BaseController
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
     * @ApiDescription(section="ast_voicemail", description="GET information about all ast_voicemail")
     * @ApiMethod(type="get")
     * @ApiRoute(name="/rest/ast_voicemail/")
     * @ApiParams(name="page", type="int", nullable=true, description="", sample="")
     * @ApiParams(name="order", type="string", nullable=true, description="", sample="")
     * @ApiParams(name="search", type="json_encode", nullable=true, description="", sample="")
     * @ApiReturnHeaders(sample="HTTP 200 OK")
     * @ApiReturn(type="object", sample="[{
     *     'uniqueid': '', 
     *     'context': '', 
     *     'mailbox': '', 
     *     'password': '', 
     *     'fullname': '', 
     *     'alias': '', 
     *     'email': '', 
     *     'pager': '', 
     *     'attach': '', 
     *     'attachfmt': '', 
     *     'serveremail': '', 
     *     'language': '', 
     *     'tz': '', 
     *     'deleteast_voicemail': '', 
     *     'saycid': '', 
     *     'sendast_voicemail': '', 
     *     'review': '', 
     *     'tempgreetwarn': '', 
     *     'operator': '', 
     *     'envelope': '', 
     *     'sayduration': '', 
     *     'forcename': '', 
     *     'forcegreetings': '', 
     *     'callback': '', 
     *     'dialout': '', 
     *     'exitcontext': '', 
     *     'maxmsg': '', 
     *     'volgain': '', 
     *     'imapuser': '', 
     *     'imappassword': '', 
     *     'imapserver': '', 
     *     'imapport': '', 
     *     'imapflags': '', 
     *     'stamp': '', 
     *     'userId': ''
     * },{
     *     'uniqueid': '', 
     *     'context': '', 
     *     'mailbox': '', 
     *     'password': '', 
     *     'fullname': '', 
     *     'alias': '', 
     *     'email': '', 
     *     'pager': '', 
     *     'attach': '', 
     *     'attachfmt': '', 
     *     'serveremail': '', 
     *     'language': '', 
     *     'tz': '', 
     *     'deleteast_voicemail': '', 
     *     'saycid': '', 
     *     'sendast_voicemail': '', 
     *     'review': '', 
     *     'tempgreetwarn': '', 
     *     'operator': '', 
     *     'envelope': '', 
     *     'sayduration': '', 
     *     'forcename': '', 
     *     'forcegreetings': '', 
     *     'callback': '', 
     *     'dialout': '', 
     *     'exitcontext': '', 
     *     'maxmsg': '', 
     *     'volgain': '', 
     *     'imapuser': '', 
     *     'imappassword': '', 
     *     'imapserver': '', 
     *     'imapport': '', 
     *     'imapflags': '', 
     *     'stamp': '', 
     *     'userId': ''
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
                'uniqueid',
                'context',
                'mailbox',
                'password',
                'fullname',
                'alias',
                'email',
                'pager',
                'attach',
                'attachfmt',
                'serveremail',
                'language',
                'tz',
                'deleteastVoicemail',
                'saycid',
                'sendastVoicemail',
                'review',
                'tempgreetwarn',
                'operator',
                'envelope',
                'sayduration',
                'forcename',
                'forcegreetings',
                'callback',
                'dialout',
                'exitcontext',
                'maxmsg',
                'volgain',
                'imapuser',
                'imappassword',
                'imapserver',
                'imapport',
                'imapflags',
                'stamp',
                'userId',
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

        $etag = $this->_cache->getEtagVersions('ast_voicemail');

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

        $mapper = new Mappers\ast_voicemail();

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
     * @ApiDescription(section="ast_voicemail", description="Get information about ast_voicemail")
     * @ApiMethod(type="get")
     * @ApiRoute(name="/rest/ast_voicemail/{uniqueid}")
     * @ApiParams(name="uniqueid", type="int", nullable=false, description="", sample="")
     * @ApiReturnHeaders(sample="HTTP 200 OK")
     * @ApiReturn(type="object", sample="{
     *     'uniqueid': '', 
     *     'context': '', 
     *     'mailbox': '', 
     *     'password': '', 
     *     'fullname': '', 
     *     'alias': '', 
     *     'email': '', 
     *     'pager': '', 
     *     'attach': '', 
     *     'attachfmt': '', 
     *     'serveremail': '', 
     *     'language': '', 
     *     'tz': '', 
     *     'deleteast_voicemail': '', 
     *     'saycid': '', 
     *     'sendast_voicemail': '', 
     *     'review': '', 
     *     'tempgreetwarn': '', 
     *     'operator': '', 
     *     'envelope': '', 
     *     'sayduration': '', 
     *     'forcename': '', 
     *     'forcegreetings': '', 
     *     'callback': '', 
     *     'dialout': '', 
     *     'exitcontext': '', 
     *     'maxmsg': '', 
     *     'volgain': '', 
     *     'imapuser': '', 
     *     'imappassword': '', 
     *     'imapserver': '', 
     *     'imapport': '', 
     *     'imapflags': '', 
     *     'stamp': '', 
     *     'userId': ''
     * }")
     */
    public function getAction()
    {
        $currentEtag = false;
        $primaryKey = $this->getRequest()->getParam('uniqueid', false);
        if ($primaryKey === false) {
            $this->status->setCode(404);
            return;
        }

        $fields = $this->getRequest()->getParam('fields', array());
        if (!empty($fields)) {
            $fields = explode(',', $fields);
        } else {
            $fields = array(
                'uniqueid',
                'context',
                'mailbox',
                'password',
                'fullname',
                'alias',
                'email',
                'pager',
                'attach',
                'attachfmt',
                'serveremail',
                'language',
                'tz',
                'deleteastVoicemail',
                'saycid',
                'sendastVoicemail',
                'review',
                'tempgreetwarn',
                'operator',
                'envelope',
                'sayduration',
                'forcename',
                'forcegreetings',
                'callback',
                'dialout',
                'exitcontext',
                'maxmsg',
                'volgain',
                'imapuser',
                'imappassword',
                'imapserver',
                'imapport',
                'imapflags',
                'stamp',
                'userId',
            );
        }

        $etag = $this->_cache->getEtagVersions('ast_voicemail');
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

        $mapper = new Mappers\ast_voicemail();
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
     * @ApiDescription(section="ast_voicemail", description="Create's a new ast_voicemail")
     * @ApiMethod(type="post")
     * @ApiRoute(name="/rest/ast_voicemail/")
     * @ApiParams(name="context", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="mailbox", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="password", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="fullname", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="alias", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="email", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="pager", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="attach", nullable=true, type="enum('yes','no')", sample="", description="")
     * @ApiParams(name="attachfmt", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="serveremail", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="language", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="tz", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="deleteast_voicemail", nullable=true, type="enum('yes','no')", sample="", description="")
     * @ApiParams(name="saycid", nullable=true, type="enum('yes','no')", sample="", description="")
     * @ApiParams(name="sendast_voicemail", nullable=true, type="enum('yes','no')", sample="", description="")
     * @ApiParams(name="review", nullable=true, type="enum('yes','no')", sample="", description="")
     * @ApiParams(name="tempgreetwarn", nullable=true, type="enum('yes','no')", sample="", description="")
     * @ApiParams(name="operator", nullable=true, type="enum('yes','no')", sample="", description="")
     * @ApiParams(name="envelope", nullable=true, type="enum('yes','no')", sample="", description="")
     * @ApiParams(name="sayduration", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="forcename", nullable=true, type="enum('yes','no')", sample="", description="")
     * @ApiParams(name="forcegreetings", nullable=true, type="enum('yes','no')", sample="", description="")
     * @ApiParams(name="callback", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="dialout", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="exitcontext", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="maxmsg", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="volgain", nullable=true, type="decimal", sample="", description="")
     * @ApiParams(name="imapuser", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="imappassword", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="imapserver", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="imapport", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="imapflags", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="stamp", nullable=true, type="datetime", sample="", description="")
     * @ApiParams(name="userId", nullable=true, type="int", sample="", description="")
     * @ApiReturnHeaders(sample="HTTP 201")
     * @ApiReturnHeaders(sample="Location: /rest/ast_voicemail/{uniqueid}")
     * @ApiReturn(type="object", sample="{}")
     */
    public function postAction()
    {

        $params = $this->getRequest()->getParams();

        $model = new Models\ast_voicemail();

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
     * @ApiDescription(section="ast_voicemail", description="Table ast_voicemail")
     * @ApiMethod(type="put")
     * @ApiRoute(name="/rest/ast_voicemail/")
     * @ApiParams(name="uniqueid", nullable=false, type="int", sample="", description="")
     * @ApiParams(name="context", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="mailbox", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="password", nullable=false, type="varchar", sample="", description="")
     * @ApiParams(name="fullname", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="alias", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="email", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="pager", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="attach", nullable=true, type="enum('yes','no')", sample="", description="")
     * @ApiParams(name="attachfmt", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="serveremail", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="language", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="tz", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="deleteast_voicemail", nullable=true, type="enum('yes','no')", sample="", description="")
     * @ApiParams(name="saycid", nullable=true, type="enum('yes','no')", sample="", description="")
     * @ApiParams(name="sendast_voicemail", nullable=true, type="enum('yes','no')", sample="", description="")
     * @ApiParams(name="review", nullable=true, type="enum('yes','no')", sample="", description="")
     * @ApiParams(name="tempgreetwarn", nullable=true, type="enum('yes','no')", sample="", description="")
     * @ApiParams(name="operator", nullable=true, type="enum('yes','no')", sample="", description="")
     * @ApiParams(name="envelope", nullable=true, type="enum('yes','no')", sample="", description="")
     * @ApiParams(name="sayduration", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="forcename", nullable=true, type="enum('yes','no')", sample="", description="")
     * @ApiParams(name="forcegreetings", nullable=true, type="enum('yes','no')", sample="", description="")
     * @ApiParams(name="callback", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="dialout", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="exitcontext", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="maxmsg", nullable=true, type="int", sample="", description="")
     * @ApiParams(name="volgain", nullable=true, type="decimal", sample="", description="")
     * @ApiParams(name="imapuser", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="imappassword", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="imapserver", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="imapport", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="imapflags", nullable=true, type="varchar", sample="", description="")
     * @ApiParams(name="stamp", nullable=true, type="datetime", sample="", description="")
     * @ApiParams(name="userId", nullable=true, type="int", sample="", description="")
     * @ApiReturnHeaders(sample="HTTP 200")
     * @ApiReturn(type="object", sample="{}")
     */
    public function putAction()
    {

        $primaryKey = $this->getRequest()->getParam('uniqueid', false);

        if ($primaryKey === false) {
            $this->status->setCode(400);
            return;
        }

        $params = $this->getRequest()->getParams();

        $mapper = new Mappers\ast_voicemail();
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
     * @ApiDescription(section="ast_voicemail", description="Table ast_voicemail")
     * @ApiMethod(type="delete")
     * @ApiRoute(name="/rest/ast_voicemail/")
     * @ApiParams(name="uniqueid", nullable=false, type="int", sample="", description="")
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

        $mapper = new Mappers\ast_voicemail();
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
                'uniqueid' => array(
                    'type' => 'int',
                    'required' => true,
                    'comment' => '[pk]'
                )
            )
        );

        $this->view->POST = array(
            'description' => '',
            'params' => array(
                'context' => array(
                    'type' => 'varchar',
                    'required' => true,
                    'comment' => '',
                ),
                'mailbox' => array(
                    'type' => 'varchar',
                    'required' => true,
                    'comment' => '',
                ),
                'password' => array(
                    'type' => 'varchar',
                    'required' => true,
                    'comment' => '',
                ),
                'fullname' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'alias' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'email' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'pager' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'attach' => array(
                    'type' => 'enum('yes','no')',
                    'required' => false,
                    'comment' => '',
                ),
                'attachfmt' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'serveremail' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'language' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'tz' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'deleteast_voicemail' => array(
                    'type' => 'enum('yes','no')',
                    'required' => false,
                    'comment' => '',
                ),
                'saycid' => array(
                    'type' => 'enum('yes','no')',
                    'required' => false,
                    'comment' => '',
                ),
                'sendast_voicemail' => array(
                    'type' => 'enum('yes','no')',
                    'required' => false,
                    'comment' => '',
                ),
                'review' => array(
                    'type' => 'enum('yes','no')',
                    'required' => false,
                    'comment' => '',
                ),
                'tempgreetwarn' => array(
                    'type' => 'enum('yes','no')',
                    'required' => false,
                    'comment' => '',
                ),
                'operator' => array(
                    'type' => 'enum('yes','no')',
                    'required' => false,
                    'comment' => '',
                ),
                'envelope' => array(
                    'type' => 'enum('yes','no')',
                    'required' => false,
                    'comment' => '',
                ),
                'sayduration' => array(
                    'type' => 'int',
                    'required' => false,
                    'comment' => '',
                ),
                'forcename' => array(
                    'type' => 'enum('yes','no')',
                    'required' => false,
                    'comment' => '',
                ),
                'forcegreetings' => array(
                    'type' => 'enum('yes','no')',
                    'required' => false,
                    'comment' => '',
                ),
                'callback' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'dialout' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'exitcontext' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'maxmsg' => array(
                    'type' => 'int',
                    'required' => false,
                    'comment' => '',
                ),
                'volgain' => array(
                    'type' => 'decimal',
                    'required' => false,
                    'comment' => '',
                ),
                'imapuser' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'imappassword' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'imapserver' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'imapport' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'imapflags' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'stamp' => array(
                    'type' => 'datetime',
                    'required' => false,
                    'comment' => '',
                ),
                'userId' => array(
                    'type' => 'int',
                    'required' => false,
                    'comment' => '',
                ),
            )
        );

        $this->view->PUT = array(
            'description' => '',
            'params' => array(
                'uniqueid' => array(
                    'type' => 'int',
                    'required' => true,
                    'comment' => '[pk]',
                ),
                'context' => array(
                    'type' => 'varchar',
                    'required' => true,
                    'comment' => '',
                ),
                'mailbox' => array(
                    'type' => 'varchar',
                    'required' => true,
                    'comment' => '',
                ),
                'password' => array(
                    'type' => 'varchar',
                    'required' => true,
                    'comment' => '',
                ),
                'fullname' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'alias' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'email' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'pager' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'attach' => array(
                    'type' => 'enum('yes','no')',
                    'required' => false,
                    'comment' => '',
                ),
                'attachfmt' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'serveremail' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'language' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'tz' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'deleteast_voicemail' => array(
                    'type' => 'enum('yes','no')',
                    'required' => false,
                    'comment' => '',
                ),
                'saycid' => array(
                    'type' => 'enum('yes','no')',
                    'required' => false,
                    'comment' => '',
                ),
                'sendast_voicemail' => array(
                    'type' => 'enum('yes','no')',
                    'required' => false,
                    'comment' => '',
                ),
                'review' => array(
                    'type' => 'enum('yes','no')',
                    'required' => false,
                    'comment' => '',
                ),
                'tempgreetwarn' => array(
                    'type' => 'enum('yes','no')',
                    'required' => false,
                    'comment' => '',
                ),
                'operator' => array(
                    'type' => 'enum('yes','no')',
                    'required' => false,
                    'comment' => '',
                ),
                'envelope' => array(
                    'type' => 'enum('yes','no')',
                    'required' => false,
                    'comment' => '',
                ),
                'sayduration' => array(
                    'type' => 'int',
                    'required' => false,
                    'comment' => '',
                ),
                'forcename' => array(
                    'type' => 'enum('yes','no')',
                    'required' => false,
                    'comment' => '',
                ),
                'forcegreetings' => array(
                    'type' => 'enum('yes','no')',
                    'required' => false,
                    'comment' => '',
                ),
                'callback' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'dialout' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'exitcontext' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'maxmsg' => array(
                    'type' => 'int',
                    'required' => false,
                    'comment' => '',
                ),
                'volgain' => array(
                    'type' => 'decimal',
                    'required' => false,
                    'comment' => '',
                ),
                'imapuser' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'imappassword' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'imapserver' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'imapport' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'imapflags' => array(
                    'type' => 'varchar',
                    'required' => false,
                    'comment' => '',
                ),
                'stamp' => array(
                    'type' => 'datetime',
                    'required' => false,
                    'comment' => '',
                ),
                'userId' => array(
                    'type' => 'int',
                    'required' => false,
                    'comment' => '',
                ),
            )
        );
        $this->view->DELETE = array(
            'description' => '',
            'params' => array(
                'uniqueid' => array(
                    'type' => 'int',
                    'required' => true
                )
            )
        );

        $this->status->setCode(200);

    }
}