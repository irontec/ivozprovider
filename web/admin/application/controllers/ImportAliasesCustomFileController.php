<?php

use Ivoz\Provider\Domain\Service\Extension\AliasImporter;

class ImportAliasesCustomFileController extends Zend_Controller_Action
{
    protected $_mainRouter;
    protected $_item;
    protected $_pk;
    protected $_ids;
    protected $_mapper;
    protected $_modelName;
    protected $_model;
    protected $_multilangFields;
    protected $_availableLangs;
    protected $_config;
    protected $_freeUploadCommand;
    protected $_delimiter = ";";
    protected $_enclosure;
    protected $_scape;
    protected $_forcedValues;

    protected $_availableFields = array(
        "extension" => array(
            "title" => "Extension",
            "required" => true,
            "help" => "Extension",
        ),
        "countryCode" => array(
            "title" => "Country Code",
            "required" => true,
            "help" => "Prefix with + sign",
        ),
        "number" => array(
            "title" => "Number",
            "required" => true,
            "help" => "Target Number",
        ),
        "code" => array(
            "title" => "Country Identifier",
            "required" => false,
            "help" => "ES for Spain",
        )
    );


    /**
     * @var \Bootstrap
     */
    protected $_bootstrap;

    public function init()
    {
        $front = \Zend_Controller_Front::getInstance();
        $this->_bootstrap = $front->getParam('bootstrap');

        /**
         * Initialize action controller here
         */
        if (
            (!$this->_mainRouter = $this->getRequest()->getUserParam("mainRouter")) ||
            (!is_object($this->_mainRouter))
        ) {
            throw new Zend_Exception("", Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION);
        }

        $this->_item    = $this->_mainRouter->getCurrentItem();
        $this->_config = $this->_item->getConfig();
        $this->_freeUploadCommand = $this->_config->getProperty("freeUploadCommand");

        $delimiter = $this->_config->getProperty("delimiter");
        if (!is_null($delimiter)) {
            $this->_delimiter = $delimiter;
        }

        $this->_enclosure = $this->_config->getProperty("enclosure");
        $this->_scape = $this->_config->getProperty("scape");

        $this->_forcedValues = $this->_config->getProperty("forcedValues")->toArray();

        $this->_helper->ContextSwitch()
            ->addActionContext("import", "json")
            ->initContext("json");

        $this->_helper->layout->disableLayout();
    }

    protected function _dispatch(array $data)
    {
        $jsonResponse = new Klear_Model_DispatchResponse();
        $jsonResponse->setModule('klearMatrix');
        $jsonResponse->setPlugin('klearMatrixGenericDialog');
        $jsonResponse->addJsFile("/js/plugins/qq-fileuploader.js");
        $jsonResponse->addJsFile('/js/plugins/jquery.klearmatrix.genericdialog.js');
        $jsonResponse->setData($data);
        $jsonResponse->attachView($this->view);
    }

    public function importAction()
    {
        switch ($this->getParam("step")) {
            case "process_confirm":
                $this->_import();
                break;
            case "load_file":
                if (is_null($this->_getFilePath())) {
                    $this->_loadFile();
                } else {
                    $this->_confirmImport();
                }
                break;
            default:
                $this->_loadFile();
                break;
        }
    }

    protected function _loadFile()
    {

        $message = "<p>" . $this->_helper->translate("Select file to import") . "</p>";
        $message .= "<input type='file' name='importFile' data-upload-command='" . $this->_freeUploadCommand . "'>";
        $data = array(
            'title' => $this->_helper->translate("Import file"),
            'message' => $message,
            'buttons' => array(
                $this->_helper->translate('Close') => array(
                    'recall' => false,
                    'reloadParent' => false
                ),
                $this->_helper->translate('Continue') => array(
                    'recall' => true,
                    'params' => array(
                        'step' => "load_file"
                    )
                ),
            )
        );
        $this->_dispatch($data);
    }

    protected function _getFilePath()
    {
        $tempFSystemNS = new \Zend_Session_Namespace('File_Controller');

        $fileHash = $this->getRequest()->getParam('importFile');
        if (!empty($fileHash) && isset($tempFSystemNS->{$fileHash})) {
            $tempFile = $tempFSystemNS->{$fileHash};
            return $tempFile["path"];
        }
        return null;
    }

    protected function _parseFile($filePath, $limit = null)
    {
        $file = file_get_contents($filePath);
        $lines = explode(PHP_EOL, trim($file));

        if (count($lines) <= 0) {
            return false;
        }

        $counter = 0;
        $linesArray = array();
        foreach ($lines as $line) {
            $lineFields = str_getcsv(trim($line), $this->_delimiter, $this->_enclosure, $this->_scape);
            $linesArray[] = $lineFields;
            $counter++;
            if (!is_null($limit) && $counter == $limit) {
                break;
            }
        }

        return $linesArray;
    }

    protected function _buildForm($lines)
    {
        $form = '
        <style>
        .tableBox {
        max-width:750px;overflow:auto;
    }
    .parsedValues tr td {
    border: 1px solid #999;
    padding: 4px;
    }
    .parseHelp{
    padding: 17px;
    font-size: 0.9em;
    }
    </style>
    ';

        $help = '<div class="parseHelp">';
        $help .= '<p>' . $this->_helper->translate("Import file") . ". " . $this->_helper->translate("Set column configuration and continue.") . '</p>';
        $help .= '<p>' . $this->_helper->translate("Fields with * are required") . '.</p><br/>';
        $help .= '<ul>';

        foreach ($this->_availableFields as $key => $fieldInfo) {
            if (isset($this->_forcedValues[$key])) {
                continue;
            }
            $fieldLabel = \Klear_Model_Gettext::gettextCheck($fieldInfo['title']);
            $required = "";
            if (!is_null($fieldInfo['required']) && $fieldInfo['required']) {
                $required = " *";
            }
            $fieldHelp = "";
            if (!is_null($fieldInfo['help'])) {
                $required .= ": ";
                $fieldHelp = \Klear_Model_Gettext::gettextCheck($fieldInfo['help']);
            }

            $help .= '<li>' . $fieldLabel . $required . '<em>' . $fieldHelp . '</em></li>';
        }

        $help .= '</ul></div>';
        $table = $help . '<div class="tableBox"><table class="kMatrix parsedValues">';
        $table .= "<tr>";

        $availableFieldsKeys = array_keys($this->_availableFields);
        foreach ($availableFieldsKeys as $idf => $xfield) {
            if (isset($this->_forcedValues[$xfield])) {
                continue;
            }
            $xfieldLabel = \Klear_Model_Gettext::gettextCheck($this->_availableFields[$xfield]['title']);
            if (!is_null($this->_availableFields[$xfield]['required']) && $this->_availableFields[$xfield]['required']) {
                $xfieldLabel .= " *";
            }

            $table .= "<th class='ui-widget-header multiItem notSortable' style='min-width:150px;'>" . $xfieldLabel . "</th>";
        }

        $table .= "</tr>";
        foreach ($lines as $line) {
            $table .= "<tr>";
            foreach ($line as $idPart => $part) {
                $table .= "<td class='ui-widget-content'>" . $part . "</td>";
            }
            $table .= "</tr>";
        }
        $table .= "</table>";
        $form .= $table . '</div><br />';
        $ignoreFirst = $this->getRequest()->getParam("ingoreFirst", null);
        $checked = '';
        if (!is_null($ignoreFirst) && $ignoreFirst == "on") {
            $checked = 'checked="checked"';
        }
        $form .= '<label><input type="checkbox" name="ingoreFirst" ' . $checked . '/> ' . $this->_helper->translate("Ignore first line.") . '</label>';
        $update = $this->getRequest()->getParam("update", null);
        $form .= '';

        return $form;
    }
    protected function _confirmImport($message = "", $filePath = null)
    {
        if (is_null($filePath)) {
            $filePath = $this->_getFilePath();
        }

        $lines = $this->_parseFile($filePath, 3);

        if ($lines === false) {
            $this->_generalError();
            return;
        }

        $tempFileSystemNamespace = new Zend_Session_Namespace('File_Controller');
        $tempFileIterator = $tempFileSystemNamespace->getIterator();

        $uploadedFileInfo = $tempFileIterator->offsetGet(basename($filePath));

        if (!array_key_exists('basename', $uploadedFileInfo)) {
            throw new \Exception('File basename not found');
        }


        $form = $this->_buildForm($lines);
        $data = array(
            'title' => $this->_helper->translate("Import file"),
            'message' => $message . "<br>" . $form,
            'buttons' => array(
                $this->_helper->translate('Close') => array(
                    'recall' => false,
                    'reloadParent' => false
                ),
                $this->_helper->translate('Yes, continue!') => array(
                    'recall' => true,
                    'params' => array(
                        "step" => 'process_confirm',
                        "filePath" => $filePath,
                        "fileName" => $uploadedFileInfo['basename']
                    )
                ),
            )
        );
        $this->_dispatch($data);
    }

    protected function _import()
    {
        $filePath = $this->getRequest()->getParam('filePath');
        $lines = $this->_parseFile($filePath);

        if ($this->getRequest()->getParam('ingoreFirst') === 'on') {
            array_shift($lines);
        }

        try {
            $companyId = current($this->_forcedValues['company']);

            $container = \Zend_Registry::get('container');
            $aliasImporter = $container->get(
                AliasImporter::class
            );

            $aliasImporter->execute(
                $companyId,
                $lines
            );
        } catch (\Exception $e) {
            $this->_log($e->getMessage());

            $message = '<p><b style="color: red;">ERROR</b></p>';
            $message .= "<p>" . $e->getMessage() . "</p>";

            $this->_confirmImport($message, $filePath);
            return;
        }

        $message = $this->_helper->translate("File imported successfully");

        $data = array (
            'title' => $this->_helper->translate("Import file"),
            'message' => $message,
            'buttons' => array(
                $this->_helper->translate('Close') => array(
                    'recall' => false,
                    'reloadParent' => true
                )
            )
        );

        $this->_dispatch($data);
    }

    protected function _generalError()
    {
        $this->_dispatch(
            array(
                'title' => $this->_helper->translate("An error occurred"),
                'message' => $this->_helper->translate("An error occurred: check files format and content."),
                'buttons' => array(
                    $this->_helper->translate('Close') => array(
                        'recall' => false,
                        'reloadParent' => false
                    )
                )
            )
        );
    }

    protected function _log($message, $priorityText = null)
    {
        switch ($priorityText) {
            case "error":
                $priority = \Zend_Log::ERR;
                break;
            case "info":
                $priority = \Zend_Log::INFO;
                break;
            default:
                $priority = \Zend_Log::DEBUG;
                break;
        }
        $this->_helper->log($message, $priority);
    }
}
