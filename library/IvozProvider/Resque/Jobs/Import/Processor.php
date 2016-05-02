<?php
namespace IvozProvider\Resque\Jobs\Import;

class Processor
{

    protected $_logger;

    /**
     * @var \Bootstrap
     */
    protected $_bootstrap;
    protected $_delimiter = ";";
    protected $_enclosure;
    protected $_scape;

    public function setUp()
    {
        $front = \Zend_Controller_Front::getInstance();
        $this->_bootstrap = $front->getParam('bootstrap');
        $this->_logger = $this->_bootstrap->getResource('log');
        if (is_null($this->_logger)) {
            $params = array(
                array(
                    'writerName' => 'Null'
                )
            );
            $this->_logger = \Zend_Log::factory($params);
        }

        $logMessage = "Starting Import Processor Job.";
        $this->_log($logMessage);

    }

    public function perform()
    {
        $this->_log("Processing...");
        $this->_delimiter = $this->args["delimiter"];
        $this->_enclosure = $this->args["enclosure"];
        $this->_scape = $this->args["scape"];

//        var_dump($this->args); die();

        $this->_import($this->args);

        return true;
    }

    public function tearDown()
    {
        $logMessage = "Import Processor Job finished.";
        $this->_log($logMessage);
    }


    protected function _log($message, $priority = \Zend_Log::INFO) {
        $this->_logger->log("[Import Processor] ".$message, $priority);
    }

    protected function _import($params)
    {
        $this->_log("Importing file");
        $error = array();
        $success = array();
        $filePath = $params['filePath'];
        $ignoreFirst = null;
        if (isset($params['ingoreFirst'])) {
            $ignoreFirst = $params['ingoreFirst'];
        }
        $conf = array();

        $lines = $this->_parseFile($filePath, 1);
        $fileFields = count($lines[0]);
        $fieldsPossitions = array();
        for($i = 0; $i < $fileFields; $i++) {
            $fieldName = $params['field_'.$i];
            $fieldsPossitions[$fieldName] = $i;
        }

        $result = $this->_save($lines, $fieldsPossitions, $filePath);
        $message = $result["message"];
        $this->_log($message);

    }

    protected function _parseFile($filePath, $limit = null)
    {
        $file = file_get_contents($filePath);
        $lines = explode(PHP_EOL, trim($file));

        if (count($lines)<=0) {
            return false;
        }

        $counter = 0;
        $linesArray = array();
        foreach ($lines as $line) {
            $lineFields = str_getcsv(trim($line), $this->_delimiter, $this->_enclosure, $this->_scape);
            $linesArray[] = $lineFields;
            $counter++;
            if (!is_null($limit) && $counter==$limit) {
                break;
            }
        }

        return $linesArray;
    }

    protected function _save($lines, $fieldsPossitions, $filePath)
    {
//        $calculateHighestPk = false;
//        $message = $this->_helper->translate("File imported");
        $this->_log("Oppening file..");
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

                $lineFields = str_getcsv($buffer, $this->args["delimiter"], $this->args["enclosure"], $this->args["scape"]);

                if ($this->args["ingoreFirst"] && $firstLine) {
                    $firstLine = false;
                    $this->_log("Ignoring first line");
                    continue;
                }

                $this->_log("Creating model 'modeloACrear'");

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
                
                foreach ($this->args["forcedValues"] as $field => $value) {
                    $data[$field] = $value;
                }

                $this->_log(print_r($data, true));

                ////////*********//////

            }

        }

        $this->_log("Saveing data...");

        return array("error" => false, "message" => "Data saved successfully.");
    }
}
    