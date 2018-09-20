<?php

use Ivoz\Provider\Domain\Service\Company\IncrementBalance;
use Ivoz\Provider\Domain\Service\Company\DecrementBalance;
use Ivoz\Provider\Domain\Service\Carrier\IncrementBalance as IncrementCarrierBalance;
use Ivoz\Provider\Domain\Service\Carrier\DecrementBalance as DecrementCarrierBalance;
use Ivoz\Provider\Domain\Service\Company\AbstractBalanceOperation;

class KlearCustomIncrementBalanceController extends Zend_Controller_Action
{
    protected $_mainRouter;

    protected $_template;

    protected $_logger;

    /** @var  \Ivoz\Core\Application\Service\DataGateway */
    protected $dataGateway;

    protected $container;

    public function init()
    {
        if ((!$this->_mainRouter = $this->getRequest()->getUserParam("mainRouter")) || (!is_object($this->_mainRouter)) ) {
            throw New Zend_Exception('', Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION);
        }

        $this->_helper
            ->ContextSwitch()
            ->addActionContext('add-to-balance', 'json')
            ->addActionContext('add-to-carrier-balance', 'json')
            ->initContext('json');

        $this->_helper->layout->disableLayout();

        $this->dataGateway = Zend_Registry::get('data_gateway');
        $this->container = Zend_Registry::get('container');

        $this->_template = APPLICATION_PATH."/bin/template.php";
    }

    public function addToBalanceAction()
    {
        $buttons = array();
        $id = $this->_mainRouter->getParam('pk', false);

        if (!$id) {
            $message = $this->_helper->translate('Id not found');
            return $this->_dispatch( $message, $buttons);
        }

        /** @var \Ivoz\Provider\Domain\Model\Company\CompanyInterface $company */
        $company = $this->dataGateway->find(
            \Ivoz\Provider\Domain\Model\Company\Company::class,
            $id
        );

        if (($this->getParam("sent"))) {

            $targetService = $this->getParam("operation") === 'add'
                ? IncrementBalance::class
                : DecrementBalance::class;

            /** @var AbstractBalanceOperation $balanceService */
            $balanceService = $this->container->get(
                $targetService
            );

            $success = $balanceService->execute(
                $id,
                $this->getParam("amount")
            );

            $reponseMessage = $success
                ? $this->_helper->translate('Balance modified successfully')
                : sprintf($this->_helper->translate('There was an error: %s'), $balanceService->getLastError());

            return $this->_dispatch( $reponseMessage, $buttons);
        }

        return $this->_showDialog(
            $company->getName(),
            $company->getId()
        );
    }

    public function addToCarrierBalanceAction()
    {
        $buttons = array();
        $id = $this->_mainRouter->getParam('pk', false);

        if (!$id) {
            $message = $this->_helper->translate('Id not found');
            return $this->_dispatch( $message, $buttons);
        }

        /** @var \Ivoz\Provider\Domain\Model\Carrier\CarrierInterface $carrier */
        $carrier = $this->dataGateway->find(
            \Ivoz\Provider\Domain\Model\Carrier\Carrier::class,
            $id
        );

        if (($this->getParam("sent"))) {

            $targetService = $this->getParam("operation") === 'add'
                ? IncrementCarrierBalance::class
                : DecrementCarrierBalance::class;

            /** @var AbstractBalanceOperation $balanceService */
            $balanceService = $this->container->get(
                $targetService
            );

            $success = $balanceService->execute(
                $id,
                $this->getParam("amount")
            );

            $reponseMessage = $success
                ? $this->_helper->translate('Balance modified successfully')
                : sprintf($this->_helper->translate('There was an error: %s'), $balanceService->getLastError());

            return $this->_dispatch( $reponseMessage, $buttons);
        }

        return $this->_showDialog(
            $carrier->getName(),
            $carrier->getId()
        );
    }

    private function _showDialog($name, $id)
    {
        $styles = '
            <style>
                .ui-widget.ui-dialog-content.ui-widget-content {
                    z-index: 1;
                }
                p.updateable-item .selectboxit-container {
                    margin-left: 7px;
                }
                p.updateable-item .selectboxit-container,
                p.updateable-item .selectboxit-container .selectboxit-options {
                    width: 50px;
                    line-height: 18px;
                }
                p.updateable-item .selectboxit-container span {
                    max-height: 18px;
                    line-height: 18px;
                }
                p.updateable-item .selectboxit-container i {
                    top: 2px!important;
                }
                p.updateable-item .selectboxit-container ul.selectboxit-options {
                    /*overflow: hidden;*/
                }
                p.updateable-item .selectboxit-container ul.selectboxit-options li,
                p.updateable-item .selectboxit-container ul.selectboxit-options li a {
                    max-height: 20px;
                    line-height: 18px;
                }
            </style>
        ';

        $operationSelector = '
            <select name="operation">
                <option value="add" selected>+</option>
                <option value="debit">-</option>
            </select>
        ';

        $inputFld = '<input
            id="amount"
            name="amount"
            type="number"
            value="0.00"
            step="0.01"
            min="0.01"
            max="999999.99"
            required="required"
            title="Invalid format"
            pattern="[0-9]{1,6}([\.][0-9]{1,2})?"
            class="ui-widget ui-state-default ui-corner-all"
            style="text-align: right; margin-left: 0px;"
            />';

        $message = '<form style="z-index: 9999999;">'
            . $styles
            . '<p class="updateable-item" style="font-size: 0.8em;">'
            . sprintf(
                $this->_helper->translate('Add balance operation to <strong>%s</strong>'),
                $name,
                $id
            )
            . '</p>'
            . '<p class="updateable-item" style="font-size: 0.8em;z-index: 9999999;"><label for="amount">'
            . $this->_helper->translate('Amount')
            . '</label>'
            . $operationSelector
            . $inputFld
            . ' €'
            . '</p>'
            . '</form>';

        $buttons = [
            $this->_helper->translate('Send') => [
                'reloadParent' => false,
                'recall' => true,
                'params' => ['sent' => true]
            ]
        ];
        $this->_dispatch( $message, $buttons);
    }

    protected function _dispatch( $message, $buttons = array()){
        $buttons[$this->_helper->translate('Close')] = [
            'reloadParent' => true,
            'recall' => false,
        ];
        $data = [
            'title' => $this->_helper->translate("Add balance"),
            'message' => $message,
            'buttons'=>$buttons
        ];

        $jsonResponse = new Klear_Model_DispatchResponse();
        $jsonResponse->setModule('default');
        $jsonResponse->setPlugin('customIncrementBalance');
        $jsonResponse->addJsFile("/../klearMatrix/js/plugins/jquery.klearmatrix.genericdialog.js");
        $jsonResponse->addJsFile("/js/customIncrementBalance.js");
        $jsonResponse->setData($data);
        $jsonResponse->attachView($this->view);
    }
}
