<?php

use Ivoz\Core\Application\Service\DataGateway;
use Ivoz\Provider\Domain\Model\AdministratorRelPublicEntity\AdministratorRelPublicEntity;

class KlearCustomAclController extends Zend_Controller_Action
{
    protected $_mainRouter;
    
    public function init()
    {
        if ((!$this->_mainRouter = $this->getRequest()->getUserParam("mainRouter"))
            || (!is_object($this->_mainRouter))
        ) {
            throw new Zend_Exception(
                '',
                Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION
            );
        }

        $this->_helper
            ->ContextSwitch()
            ->addActionContext('grant-write', 'json')
            ->addActionContext('grant-read-only', 'json')
            ->addActionContext('revoke-access', 'json')
            ->initContext('json');
  
        $this->_helper->layout->disableLayout();
    }

    public function grantWriteAction()
    {
        $pks = $this->getRequest()->getParam("pk");
        if (!is_array($pks)) {
            $pks = [$pks];
        }

        if ($this->getRequest()->getParam("apply")) {

            /** @var DataGateway $dataGateway */
            $dataGateway = \Zend_Registry::get('data_gateway');

            $affectedRows = $dataGateway->runNamedQuery(
                AdministratorRelPublicEntity::class,
                'setWritePermissionsByIds',
                [$pks]
            );

            $data = [
                'title' => $this->_helper->translate(
                    "Write Access"
                ),
                'message'=> 'Write access successfully granted',
                'buttons' => [
                    $this->_helper->translate('Accept') => [
                        'reloadParent' => true,
                        'recall' => false,
                    ]
                ]
            ];
        } else {
            $data = [
                'title' => $this->_helper->translate(
                    "Write Access"
                ),
                'message'=> $this->_helper->translate(
                    'Do you really want to grant write access to selected entities?'
                ),
                'buttons' => [
                    $this->_helper->translate('Cancel') => [
                        'reloadParent' => false,
                        'recall' => false,
                    ],
                    $this->_helper->translate('Accept') => [
                        "recall" => true,
                        "reloadParent" => false,
                        "params" => [
                            "apply" => true
                        ]
                    ]
                ]
            ];
        }

        $jsonResponse = new Klear_Model_DispatchResponse();
        $jsonResponse->setModule('default');
        $jsonResponse->setPlugin('customTextFileReader');
        $jsonResponse->addJsFile("/../klearMatrix/js/plugins/jquery.klearmatrix.genericdialog.js");
        $jsonResponse->addJsFile("/js/customTextFileReader.js");
        $jsonResponse->setData($data);
        $jsonResponse->attachView($this->view);
    }

    public function grantReadOnlyAction()
    {
        $pks = $this->getRequest()->getParam("pk");
        if (!is_array($pks)) {
            $pks = [$pks];
        }

        if ($this->getRequest()->getParam("apply")) {

            /** @var DataGateway $dataGateway */
            $dataGateway = \Zend_Registry::get('data_gateway');

            $affectedRows = $dataGateway->runNamedQuery(
                AdministratorRelPublicEntity::class,
                'setReadOnlyPermissionsByIds',
                [$pks]
            );

            $data = [
                'title' => $this->_helper->translate(
                    "Read Only Access"
                ),
                'message'=> 'Read access successfully granted',
                'buttons' => [
                    $this->_helper->translate('Accept') => [
                        'reloadParent' => true,
                        'recall' => false,
                    ]
                ]
            ];
        } else {
            $data = [
                'title' => $this->_helper->translate(
                    "Read Only Access"
                ),
                'message'=> $this->_helper->translate(
                    'Do you really want to grant read access to selected entities?'
                ),
                'buttons' => [
                    $this->_helper->translate('Cancel') => [
                        'reloadParent' => false,
                        'recall' => false,
                    ],
                    $this->_helper->translate('Accept') => [
                        "recall" => true,
                        "reloadParent" => false,
                        "params" => [
                            "apply" => true
                        ]
                    ]
                ]
            ];
        }

        $jsonResponse = new Klear_Model_DispatchResponse();
        $jsonResponse->setModule('default');
        $jsonResponse->setPlugin('customTextFileReader');
        $jsonResponse->addJsFile("/../klearMatrix/js/plugins/jquery.klearmatrix.genericdialog.js");
        $jsonResponse->addJsFile("/js/customTextFileReader.js");
        $jsonResponse->setData($data);
        $jsonResponse->attachView($this->view);
    }

    public function revokeAccessAction()
    {
        $pks = $this->getRequest()->getParam("pk");
        if (!is_array($pks)) {
            $pks = [$pks];
        }

        if ($this->getRequest()->getParam("apply")) {

            /** @var DataGateway $dataGateway */
            $dataGateway = \Zend_Registry::get('data_gateway');

            $affectedRows = $dataGateway->runNamedQuery(
                AdministratorRelPublicEntity::class,
                'revokePermissionsByIds',
                [$pks]
            );

            $data = [
                'title' => $this->_helper->translate(
                    "Revoke Access"
                ),
                'message'=> 'Access successfully revoked',
                'buttons' => [
                    $this->_helper->translate('Accept') => [
                        'reloadParent' => true,
                        'recall' => false,
                    ]
                ]
            ];
        } else {
            $data = [
                'title' => $this->_helper->translate(
                    "Revoke Access"
                ),
                'message'=> $this->_helper->translate(
                    'Do you really want to revoke access to selected entities?'
                ),
                'buttons' => [
                    $this->_helper->translate('Cancel') => [
                        'reloadParent' => false,
                        'recall' => false,
                    ],
                    $this->_helper->translate('Accept') => [
                        "recall" => true,
                        "reloadParent" => false,
                        "params" => [
                            "apply" => true
                        ]
                    ]
                ]
            ];
        }

        $jsonResponse = new Klear_Model_DispatchResponse();
        $jsonResponse->setModule('default');
        $jsonResponse->setPlugin('customTextFileReader');
        $jsonResponse->addJsFile("/../klearMatrix/js/plugins/jquery.klearmatrix.genericdialog.js");
        $jsonResponse->addJsFile("/js/customTextFileReader.js");
        $jsonResponse->setData($data);
        $jsonResponse->attachView($this->view);
    }
}
