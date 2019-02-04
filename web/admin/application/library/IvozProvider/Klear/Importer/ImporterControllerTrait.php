<?php

namespace IvozProvider\Klear\Importer;

use Doctrine\DBAL\DBALException;

trait ImporterControllerTrait
{
    // Traits cannot have constants
    protected $MYSQL_DUPLICATE_ENTRY_ERROR_CODE = 1062;

    protected $_mainRouter;
    protected $_item;
    protected $_pk;
    protected $_parentPk;
    protected $_ids;
    protected $_mapperName;
    protected $_mapper;
    protected $_modelName;
    protected $_model;
    protected $_availableFields = [];
    protected $_multilangFields;
    protected $_availableLangs;
    protected $_config;
    protected $_freeUploadCommand;
    protected $_forcedValues;

    protected $_csvParser;
    protected $_genericFormBuilder;
    protected $_customFormBuilder;

    public function init()
    {
        $front = \Zend_Controller_Front::getInstance();
        $this->_bootstrap = $front->getParam('bootstrap');

        /**
         * Initialize action controller here
         */
        if ((!$this->_mainRouter = $this->getRequest()->getUserParam("mainRouter")) ||
            (!is_object($this->_mainRouter)) ) {
            throw new \Zend_Exception("", Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION);
        }

        $this->_pk = $this->getRequest()->getParam("pk");
        $this->_parentPk = $this->getRequest()->getParam("parentId");

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
        $this->_availableFields = array();

        $availableFields = $this->_item->getModelSpec()->getFields();
        foreach ($availableFields as $key => $field) {
            $this->_availableFields[$key] = $field;
        }

        $selectableFields = array_diff_key($this->_availableFields, $this->_forcedValues);
        $this->_genericFormBuilder = new GenericForm(
            $selectableFields,
            $this->_getFilteredPostValues(),
            $this->_helper->translate
        );
        $this->_buildCsvParser();

        $this->_helper->ContextSwitch()
            ->addActionContext("import", "json")
            ->initContext("json");

        $this->_helper->layout->disableLayout();
    }

    protected function _buildCsvParser()
    {
        $delimiter = $this->_config->getProperty("delimiter");
        $enclosure = $this->_config->getProperty("enclosure");
        $scape = $this->_config->getProperty("scape");

        $this->_csvParser = new CsvParser($delimiter, $enclosure, $scape);
    }

    protected function _dispatch(array $data)
    {
        $jsonResponse = new \Klear_Model_DispatchResponse();
        $jsonResponse->setModule('klearMatrix');
        $jsonResponse->setPlugin('klearMatrixGenericDialog');
        $jsonResponse->addJsFile("/js/plugins/qq-fileuploader.js");
        $jsonResponse->addJsFile('/js/plugins/jquery.klearmatrix.genericdialog.js');
        $jsonResponse->setData($data);
        $jsonResponse->attachView($this->view);
    }

    protected function _loadFile($message = null)
    {
        if (!$message) {
            $message .= "<p>".$this->_helper->translate("Please, choose a file to import")."</p>";
        }
        $message .= "<div style='text-align:center;'><input type='file' name='importFile' data-upload-command='" . $this->_freeUploadCommand . "'></div>";

        $data = array(
            'title' => $this->_helper->translate("Parse file and import"),
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
        $lines = $this->_csvParser->parseFile($filePath);

        if (count($lines)<=0) {
            return false;
        }

        $counter = 0;
        $linesArray = array();
        foreach ($lines as $lineFields) {
            $linesArray[] = $lineFields;
            $counter++;
            if (!is_null($limit) && $counter==$limit) {
                break;
            }
        }

        return $linesArray;
    }

    protected function _buildForm($lines)
    {
        if ($this->_customFormBuilder) {
            return $this->_customFormBuilder->getForm($lines);
        }

        return $this->_genericFormBuilder->getForm($lines);
    }

    protected function _getFilteredPostValues()
    {
        $values = [];

        $params = $this->getRequest()->getParams();
        foreach ($params as $key => $value) {
            if (false === strpos($key, 'field_')) {
                continue;
            }
            $values[$key] = $value;
        }

        $values['ingoreFirst'] = $this->getRequest()->getParam('ingoreFirst', false);
        $values['update'] = $this->getRequest()->getParam("update", false);

        return $values;
    }

    protected function _confirmImport($message = "", $filePath = null)
    {
        if (is_null($filePath)) {
            $filePath = $this->_getFilePath();
        }
        $lines = $this->_parseFile($filePath, 3);

        if ($lines===false) {
            $this->_generalError();
            return;
        }

        $form = $this->_buildForm($lines);
        $data = array(
            'title' => $this->_helper->translate("Parse file and import"),
            'message' => $message."<br>".$form,
            'buttons' => array(
                $this->_helper->translate('Close') => array(
                    'recall' => false,
                    'reloadParent' => false
                ),
                $this->_helper->translate('Yes, continue!') => array(
                    'recall' => true,
                    'params' => array(
                        "step" => 'process_confirm',
                        "filePath" => $filePath
                    )
                ),
            )
        );
        $this->_dispatch($data);
    }

    protected function _import()
    {
        $this->_log("Importing file");
        $filePath = $this->getRequest()->getParam('filePath');

        $lines = $this->_parseFile($filePath, 1);
        $fileFields = count($lines[0]);
        $fieldsPossitions = array();
        for ($i = 0; $i < $fileFields; $i++) {
            $fieldName = $this->getRequest()->getParam('field_'.$i);
            $fieldsPossitions[$fieldName] = $i;
        }

        $result = $this->_save($lines, $fieldsPossitions, $filePath);
        $message = $result["message"];
        $this->_log($message);

        if ($result["error"]) {
            $this->_confirmImport($message, $filePath);
            return;
        }

        $data = array (
            'title' => $this->_helper->translate("Parse file and import"),
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

    protected function _save($lines, $fieldsPossitions, $filePath = "")
    {
        //comprobar campos requeridos
        $missing = false;
        $message = '<p><b style="color: red;">ERROR</b></p>';
        foreach ($this->_availableFields as $key => $field) {
            if (isset($this->_forcedValues[$key])) {
                continue;
            }
            if ($field->get("required")) {
                if (!isset($fieldsPossitions[$key])) {
                    $missing = true;
                    $message .= "<p>'".$key."' ".$this->_helper->translate("is a required field").".</p>";
                }
            }
        }

        if ($missing) {
            $this->_log($message);
            return array("error" => true, "message" => $message);
        }

        $calculateHighestPk = false;
        $this->_log("Opening file..");
        $firstLine = true;
        $handle = fopen($filePath, "r");
        if ($handle) {
            $errors = array();
            while (!feof($handle)) {
                $buffer = fgets($handle, 4096);
                if (!$buffer) {
                    continue;
                }
                $buffer = trim($buffer);
                if (empty($buffer)) {
                    continue;
                }

                $lineFields = str_getcsv($buffer, ";");
                if ($this->getRequest()->getParam("ingoreFirst") && $firstLine) {
                    $firstLine = false;
                    $this->_log("Ignoring first line");
                    continue;
                }

                $data = array();
                foreach ($fieldsPossitions as $fieldName => $fieldPosition) {
                    $fieldPosition = intval($fieldPosition);
                    if ($fieldName == "ignore") {
                        continue;
                    }
                    $value = $lineFields[$fieldPosition];

                    if (empty($value)) {
                        $value = "";
                    }

                    if (strtolower($value) == "null") {
                        $value = null;
                    }

                    $data[$fieldName] = $value;
                }

                $conditions = array();
                if (isset($data["id"])) {
                    $conditions["id"] = $data["id"];
                }

                foreach ($this->_forcedValues as $field => $value) {
                    if ($value == "%parent%") {
                        $value = $this->_parentPk;
                    }
                    $data[$field] = $value;
                    $conditions[$field] = $value;
                }

                try {
                    if ($this->getRequest()->getParam("update", false) && isset($data["id"])) {
                        $model = $this->_mapper->findOneByField(array_keys($conditions), array_values($conditions));
                        if (!is_null($model)) {
                            $model->populateFromArray($data);
                            $model->save();
                        } else {
                            $wheres = array();
                            foreach ($conditions as $key => $value) {
                                $wheres[] = $key . " = '" . $value . "'";
                            }
                            $error = "No model found. where " . implode(" AND ", $wheres);
                            $this->_log($error);
                            $errors[] = $error;
                        }
                    } else {
                        $modelSpec = $this->_item->getModelSpec();
                        $model = clone $modelSpec->getInstance();
                        $this->persist($model, $data);
                    }
                } catch (DBALException $e) {
                    if ($e->getPrevious()) {
                        $e = $e->getPrevious();
                    }

                    $this->_log($e->getMessage());
                    $errors = $e->getMessage();
                    break;
                } catch (\Exception $e) {
                    $this->_log($e->getMessage());
                    $errors = $e->getMessage();
                    break;
                }
            }
        }
        fclose($handle);

        if (!empty($errors)) {
            $message =
                $this->_helper->translate("File partially imported")
                . ". "
                . sprintf(
                    $this->_helper->translate("There was an error: %s"),
                    $this->_helper->translate($error)
                );
        } else {
            $message = $this->_helper->translate("File imported");
        }

        return array ("error" => false, "message" => $message);
    }

    /**
     * @return mixed
     */
    private function persist($model, array $data, $id = null)
    {
        /** @var \Ivoz\Core\Application\Service\DataGateway $dataGateway */
        $dataGateway = \Zend_Registry::get('data_gateway');

        /** @var \KlearMatrix_Model_ColumnCollection $columns */
        $columns = $this->_item->getVisibleColumns(true, $model);

        foreach ($data as $columnName => $value) {
            $setter = 'set' . ucfirst($columnName);
            /** @var \KlearMatrix_Model_Column $column */
            $column = $columns->getColFromDbName($columnName);

            if (is_null($column)) {
                continue;
            }

            if ($column->isSelectMapperFieldType()) {
                $setter .= 'Id';
            } elseif ($column->getType() == 'picker') {
                $value = $this->stringToDateTime($column, $value);
            }

            $model->{$setter}($value);
        }

        if ($model->getId()) {
            return $dataGateway->update(
                $this->_item->getEntityClassName(),
                $model
            );
        }

        return $dataGateway->persist(
            $this->_item->getEntityClassName(),
            $model
        );
    }

    protected function stringToDateTime(\KlearMatrix_Model_Column $column, $value)
    {
        /** @var \KlearMatrix_Model_Field_Picker $fieldModel */
        $fieldModel = $column->getFieldConfig();
        $adapterClass = get_class($fieldModel->getAdapter());

        switch ($adapterClass) {
            case \KlearMatrix_Model_Field_Picker_Date::class:
                $dateTime = \DateTime::createFromFormat(
                    'Y-m-d',
                    $value
                );
                $dateTime->setTime(
                    0,
                    0,
                    0
                );

                return $dateTime;

            case \KlearMatrix_Model_Field_Picker_Time::class:
                return \DateTime::createFromFormat(
                    'H:i:s',
                    $value
                );

            case \KlearMatrix_Model_Field_Picker_DateTime::class:
                return \DateTime::createFromFormat(
                    'Y-m-d H:i:s',
                    $value
                );

            default:
                die(get_class($fieldModel));
                return $value;
        }
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

        $message = '[File Importer] ' . $message;
        $this->_helper->log($message, $priority);
    }
}
