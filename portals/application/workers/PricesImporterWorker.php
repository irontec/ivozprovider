<?php



class PricesimporterWorker extends Iron_Gearman_Worker
{
    protected $_timeout = 10000; // 1000 = 1 second
    protected $_dbAdapter;

    /**
     * @var \Bootstrap
     */
    protected $_bootstrap;
    protected $_delimiter = ";";
    protected $_enclosure;
    protected $_scape;
    protected $_pricingPlanId;
    /**
     * @var \IvozProvider\Mapper\Sql\TargetPatterns
     */
    protected $_targetPatternMapper;
    /**
     * @var \IvozProvider\Mapper\Sql\PricingPlansRelTargetPatterns
     */
    protected $_pricingPlansRelTargetPatternMapper;

    protected $_summary = array();

    public $args;

    protected function initRegisterFunctions()
    {

        //$logMessage = "Registering funtcionts...";
        //$this->_log($logMessage);

        $this->_registerFunction = array(
                'importPrices' => 'importPrices'
        );
    }

    protected function init()
    {
        //$logMessage = "Starting worker";
        //$this->_log($logMessage);

        $this->_dbAdapter = \Zend_Db_Table::getDefaultAdapter();
    }

    protected function timeout()
    {

        $this->_dbAdapter->closeConnection();
    }

    public function importPrices(\GearmanJob $serializedJob)
    {
        // Thanks Gearmand, you've done your job
        $serializedJob->sendComplete("DONE");

        $job = igbinary_unserialize($serializedJob->workload());
        $this->args = $job->getParams();
        $logMessage = "Starting Job";
        $this->_log($logMessage);

        $this->resetSummary();

        $this->setUp();
        $this->perform();   
        $this->tearDown();

        return true;
    }

////////////////////////////////////////////////////////////////////////////////////////////
    public function resetSummary()
    {
        $this->_summary = array(
            "totalRows" => 0,
            "errorRows" => 0,
            "newPatterns" => 0,
            "updatedPatterns" => 0,
            "newPrices" => 0,
            "updatedPrices" => array(
                "total" => 0,
                "increased" => 0,
                "decreased" => 0,
                "mantained" => 0
            )
        );

    }

    public function setUp()
    {
        $front = \Zend_Controller_Front::getInstance();
        $this->_bootstrap = $front->getParam('bootstrap');
        //$this->_logger = $this->_bootstrap->getResource('log');
        //if (is_null($this->_logger)) {
        //    $params = array(
        //        array(
        //            'writerName' => 'Null'
        //        )
        //    );
        //    $this->_logger = \Zend_Log::factory($params);
        //}

        $logMessage = "Starting Import Processor Job.";
        $this->_log($logMessage);

        $this->_targetPatternMapper = new \IvozProvider\Mapper\Sql\TargetPatterns();
        $this->_pricingPlansRelTargetPatternMapper = new \IvozProvider\Mapper\Sql\PricingPlansRelTargetPatterns();

    }

    public function perform()
    {
        $this->_log("Processing...");
        $this->_delimiter = $this->args["delimiter"];
        $this->_enclosure = $this->args["enclosure"];
        $this->_scape = $this->args["scape"];
        $this->_pricingPlanId = $this->args["parentId"];

//        var_dump($this->args); die();

        $this->_import($this->args);

        return true;
    }

    public function tearDown()
    {
        $logMessage = "Import Processor Job finished.";
        $this->_log($logMessage);
        $this->_logSummary();


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

                if (isset($this->args["ingoreFirst"]) && $this->args["ingoreFirst"] && $firstLine) {
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
                
                foreach ($this->args["forcedValues"] as $field => $value) {
                    $data[$field] = $value;
                }

                $this->_log(print_r($data, true));

                $this->_saveRow($data);

            }

        }

        return array("error" => false, "message" => "Data saved successfully.");
    }

    protected function _saveRow($data)
    {
        $where = array(
            "`brandId` = " . $data["brandId"],
            "`regExp` = '" . $data["regularExpresion"] . "'",
        );

        $this->_summary["totalRows"] ++;
        $targetPatternModels = $this->_targetPatternMapper->fetchList(implode(" AND " , $where));
        $targetPatternModel = array_shift($targetPatternModels);
        if (is_null($targetPatternModel)) {
            $targetPatternModel = new \IvozProvider\Model\TargetPatterns();
            $targetPatternModel
                ->stopChangeLog()
                ->setBrandId($data["brandId"])
                ->setName($data["targetPatternName"])
                ->setNameEn($data["targetPatternName"])
                ->setNameEs($data["targetPatternName"])
                ->setDescription($data["targetPatternDescription"])
                ->setDescriptionEn($data["targetPatternDescription"])
                ->setDescriptionEs($data["targetPatternDescription"])
                ->setRegExp($data["regularExpresion"]);
            try {
                $targetPatternModel->save();
            } catch (\Exception $e) {
                $this->_summary["errorRows"] ++;
                return;
            }

            $this->_summary["newPatterns"] ++;
            $this->_log("New target pattern created with regex '".$data["regularExpresion"]."'");
        } else {
            $this->_summary["updatedPatterns"] ++;
            $this->_log("Using target pattern with regex '".$data["regularExpresion"]."'");
        }

        $pricingPlanRelTargetPatternsConditions = array(
            "pricingPlanId" => $this->_pricingPlanId,
            "targetPatternId" => $targetPatternModel->getPrimaryKey(),
            "brandId" => $data["brandId"]
        );

        $pricingPlanRelTargetPatternsModel = $this->_pricingPlansRelTargetPatternMapper
            ->findOneByField(array_keys($pricingPlanRelTargetPatternsConditions), $pricingPlanRelTargetPatternsConditions);

        $isNewPrice = false;
        if (is_null($pricingPlanRelTargetPatternsModel)) {
            $isNewPrice = true;
            $pricingPlanRelTargetPatternsModel = new \IvozProvider\Model\PricingPlansRelTargetPatterns();
            $pricingPlanRelTargetPatternsModel
                ->stopChangeLog()
                ->setPricingPlanId($this->_pricingPlanId)
                ->setTargetPatternId($targetPatternModel->getPrimaryKey())
                ->setBrandId($data["brandId"])
            ;
            $this->_log("New price created");
        } else {

            $this->_log("Price updated");
        }

        $pricingPlanRelTargetPatternsModel
            ->stopChangeLog()
            ->setPerPeriodCharge($data["perPeriodCharge"])
            ->setConnectionCharge($data["connectionCharge"])
            ->setPeriodTime($data["periodTime"])
        ;

        try {
            $pricingPlanRelTargetPatternsModel->save();

            if ($isNewPrice) {
                $this->_summary["newPrices"] ++;
            } else {
                $this->_summary["updatedPrices"]["total"] ++;
            }

        } catch (\Exception $e) {
            $this->_summary["errorRows"] ++;
            return;
        }
    }

    protected function _logSummary()
    {
        $prefix = "[SUMMARY] ";

        $logMessage = $prefix. "Import summary: ";
        $this->_log($logMessage);

        $logMessage = $prefix. "Total Rows Processed: ". $this->_summary["totalRows"];
        $this->_log($logMessage);
        $logMessage = $prefix. "Rows With Errors: ". $this->_summary["errorRows"];
        $this->_log($logMessage);
        $logMessage = $prefix. "New Patterns: ". $this->_summary["newPatterns"];
        $this->_log($logMessage);
        $logMessage = $prefix. "Updated Patterns: ". $this->_summary["updatedPatterns"];
        $this->_log($logMessage);
        $logMessage = $prefix. "New Prices: ". $this->_summary["newPrices"];
        $this->_log($logMessage);
        $logMessage = $prefix. "Updated Prices: ". $this->_summary["updatedPrices"]["total"];
        $this->_log($logMessage);
        $logMessage = $prefix. "    Increased Prices: ". $this->_summary["updatedPrices"]["increased"];
        $this->_log($logMessage);
        $logMessage = $prefix. "    Decreased Prices: ". $this->_summary["updatedPrices"]["decreased"];
        $this->_log($logMessage);
        $logMessage = $prefix. "    Mantainded Prices: ". $this->_summary["updatedPrices"]["mantained"];
        $this->_log($logMessage);
    }

}
