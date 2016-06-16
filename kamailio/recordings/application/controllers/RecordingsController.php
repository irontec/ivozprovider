<?php
use IvozProvider\Mapper\Sql as Mapper;
use IvozProvider\Model as Model;

/**
 *
 * @package Recordings
 * @subpackage RecordingsController
 *
 * Handle actions on raw recorded files
 *
 */
class RecordingsController extends Zend_Controller_Action
{
    protected $_logger;

    protected $_rawRecordingsDir;

    protected $_interval;

    public function init()
    {
        $bootstrap = \Zend_Controller_Front::getInstance()->getParam('bootstrap');
        $this->_logger = $bootstrap->getResource('log');
        if (is_null($this->_logger)) {
            $params = array(
                    array(
                            'writerName' => 'Null'
                    )
            );
            $this->_logger = \Zend_Log::factory($params);
        }

        if (is_null($bootstrap)) {
            $conf = new \Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini', APPLICATION_ENV);
            $config = (Object) $conf->toArray();
        } else {
            $config = (Object) $bootstrap->getOptions();
        }

        $this->_rawRecordingsDir = $config->recordings['rawRecordingsDir'];
        $this->_interval  = $config->recordings['interval'];
    }

    public function processAction()
    {
        while (true) {
            try {
                $this->processRecordings();
                $this->_logger->log(
                                sprintf("[Recordings] Sleeping for %d seconds.\n", $this->_interval),
                                \Zend_Log::INFO);
            } catch (Exception $e) {
                $this->_logger->log(
                                sprintf("[Recordings] An error occurred processing recordings: %s.\n", $e->getMessage()),
                                \Zend_Log::ERR);
            }
            sleep($this->_interval);
        }
    }

    public function processRecordings ()
    {
        // Get a list of pending recordings
        $files = array();
        if ($dir = opendir($this->_rawRecordingsDir)) {
            while (false !== ($filename = readdir($dir))) {
                // Absolute path to file
                $filenameabs = $this->_rawRecordingsDir . $filename;

                // Only handle files
                if (!is_file($filenameabs))
                    continue;

                // Delete empty files
                if (filesize($filenameabs) === 0) {
                    $this->_logger->log(sprintf("[Recordings] Deleting empty file %s\n", $filename), \Zend_Log::INFO);
                    unlink($filenameabs);
                    continue;
                }

                // Store valid files
                if (preg_match("/((.*)=.*)\.[ao]\.rtp$/", $filename, $matches)) {
                    $file = $matches[1];
                    $callid = $matches[2];
                    $files[$callid] = $file;
                }
            }
        }

        $this->_logger->log(
                        sprintf("[Recordings] Processing %d files in recording dir %s\n", count($files), $this->_rawRecordingsDir),
                        \Zend_Log::INFO);

        // Get a mappers to reuse multiple times
        $kamAccCdrsMapper = new Mapper\KamAccCdrs;
        $recordingsMapper = new Mapper\Recordings;

        // Check each recording file
        foreach ($files as $callid => $file) {

            // Get Call-Id hash id
            $hashid = substr(md5($callid),0,8);

            // Get callid from file
            $this->_logger->log(
                            sprintf("[Recordings][%s] Checking file %s\n", $hashid, $file),
                            \Zend_Log::INFO);

            // Look if the converstation with that id has ended
            $kamAccCdr = $kamAccCdrsMapper->findOneByField("callid", $callid);
            if (!$kamAccCdr) {
                $this->_logger->log(
                                sprintf("[Recordings][%s] Call with id = %s has not yet finished!\n", $hashid, $callid),
                                \Zend_Log::INFO);
                continue;
            }

            // Convert files to .wav
            $extract_rtp = $this->_rawRecordingsDir . $file;
            $extract_wav = $this->_rawRecordingsDir . $callid . '.wav';
            $extract_cmd = "/usr/bin/extractaudio -sd '$extract_rtp' '$extract_wav' >/dev/null";
            $this->_logger->log(
                            sprintf("[Recordings][%s] Extracting audio into %s\n", $hashid, basename($extract_wav)),
                            \Zend_Log::INFO);
            exec($extract_cmd, $output, $retval);
            if ($retval != 0) {
                $this->_logger->log(
                                sprintf("[Recordings][%s] Failed to extract audio: Command was %s\n", $hashid, $extract_cmd),
                                \Zend_Log::INFO);
                continue;
            }

            // Convert .wav to .mp3
            $convert_wav = $this->_rawRecordingsDir . $callid . ".wav";
            $convert_mp3 = $this->_rawRecordingsDir . $callid . ".mp3";
            $convert_cmd = "/usr/bin/avconv -i '$convert_wav' '$convert_mp3' 2>&1 >/dev/null";
            $this->_logger->log(
                            sprintf("[Recordings][%s] Encoding to %s\n", $hashid, basename($convert_mp3)),
                            \Zend_Log::INFO);
            exec($convert_cmd, $output, $retval);
            if ($retval != 0) {
                $this->_logger->log(
                                sprintf("[Recordings][%s] Failed to convert audio: Command was %s\n", $hashid, $convert_cmd),
                                \Zend_Log::INFO);
                continue;
            }

            // Create an entry in Recordings table with the file
            $recording = new Model\Recordings;
            $recording->setCompanyId($kamAccCdr->getCompanyId())
                ->setCallid($kamAccCdr->getCallid())
                ->setDuration($kamAccCdr->getDuration())
                ->setCaller($kamAccCdr->getCaller())
                ->setCallee($kamAccCdr->getCallee())
                ->putRecordedFile($convert_mp3);

            // Store this Recording
            $recordId = $recordingsMapper->save($recording);
            $this->_logger->log(
                            sprintf("[Recordings][%s] Create Recordings entry with id %s\n", $hashid, $recordId),
                            \Zend_Log::INFO);

            // Remove encoded files
            unlink($convert_wav);

        }
    }

}
