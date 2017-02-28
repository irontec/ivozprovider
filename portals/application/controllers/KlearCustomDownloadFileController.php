<?php
class KlearCustomDownloadFileController extends Zend_Controller_Action
{
    protected $_mainRouter;

    public function init()
    {
        if ((!$this->_mainRouter = $this->getRequest()->getUserParam("mainRouter")) || (!is_object($this->_mainRouter)) ) {
            throw New Zend_Exception('',Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION);
        }

        $this->_helper->ContextSwitch()
            ->addActionContext('download-file', 'json')
            ->initContext('json');

        $this->_helper->layout->disableLayout();
    }

    public function downloadFileAction()
    {

        $data = array(
                'title' => _("Download to file"),
                'message'=> _("<a download=\"template.txt\">Download</a>"),
                'buttons'=> array(
                        _('Cancel') => array(
                                'reloadParent' => false,
                                'recall' => false,
                        )
                )
        );

        $jsonResponse = new Klear_Model_DispatchResponse();
        $jsonResponse->setModule('default');
        $jsonResponse->setPlugin('customFileDownloader');
        $jsonResponse->addJsFile("/../klearMatrix/js/plugins/jquery.klearmatrix.genericdialog.js");
        $jsonResponse->addJsFile("/js/customFileDownloader.js");
        $jsonResponse->setData($data);
        $jsonResponse->attachView($this->view);
    }
}

