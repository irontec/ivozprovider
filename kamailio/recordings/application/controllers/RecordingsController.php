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
    private $_recordDir = "/opt/irontec/ivozprovider/storage/ivozprovider_model_recordings.originalfile/";

    private $_interval = 180;

    public function processAction()
    {
        while (true) {
            $this->processRecordings();
            sleep($this->_interval);
        }
    }

    public function processRecordings ()
    {
        // Get a list of pending recordings
        $files = array();
        if ($dir = opendir($this->_recordDir)) {
            while (false !== ($file = readdir($dir))) {
                if (preg_match("/((.*)=.*)\.a\.rtp$/", $file, $matches)) {
                    $file = $matches[1];
                    $callid = $matches[2];
                    $files[$callid] = $file;
                }
            }
        }

        //$this->_helper->log("[Recordings] Processing %d files in recording dir\n", count($files));
        printf("[Recordings] Processing %d files in recording dir %s\n", count($files), $this->_recordDir);

        // Get a mappers to reuse multiple times
        $kamAccCdrsMapper = new Mapper\KamAccCdrs;
        $recordingsMapper = new Mapper\Recordings;

        // Check each recording file
        foreach ($files as $callid => $file) {

            // Get Call-Id hash id
            $hashid = substr(md5($callid),0,8);

            // Get callid from file
            printf("[Recordings][%s] Checking file %s\n", $hashid, $file);

            // Look if the converstation with that id has ended
            $kamAccCdr = $kamAccCdrsMapper->findOneByField("callid", $callid);
            if (!$kamAccCdr) {
                printf("[Recordings][%s] Call with id = %s has not yet finished!\n", $hashid, $callid);
                continue;
            }

            // Convert files to .wav
            $extract_rtp = $this->_recordDir . $file;
            $extract_wav = $this->_recordDir . $callid . '.wav';
            $extract_cmd = "/usr/bin/extractaudio -sd '$extract_rtp' '$extract_wav' >/dev/null";
            printf("[Recordings][%s] Extracting audio into %s\n", $hashid, basename($extract_wav));
            exec($extract_cmd, $output, $retval);
            if ($retval != 0) {
                printf("[Recordings][%s] Failed to extract audio: Command was %s\n", $hashid, $extract_cmd);
                continue;
            }

            // Convert .wav to .mp3
            $convert_wav = $this->_recordDir . $callid . ".wav";
            $convert_mp3 = $this->_recordDir . $callid . ".mp3";
            $convert_cmd = "/usr/bin/avconv -i '$convert_wav' '$convert_mp3' 2>&1 >/dev/null";
            printf("[Recordings][%s] Encoding to %s\n", $hashid, basename($convert_mp3));
            exec($convert_cmd, $output, $retval);
            if ($retval != 0) {
                printf("[Recordings][%s] Failed to convert audio: Command was %s\n", $hashid, $convert_cmd);
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
            printf("[Recordings][%s] Create Recordings entry with id %s\n", $hashid, $recordId);

            // Remove encoded files
            unlink($convert_wav);

        }
    }

}