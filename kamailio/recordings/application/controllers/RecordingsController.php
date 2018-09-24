<?php
use IvozProvider\Mapper\Sql as Mapper;
use IvozProvider\Model as Model;
use IvozProvider\Utils\SizeFormatter;

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
    }

    public function processAction()
    {
        // Store statistics
        $stats = array(
            'deleted' => 0,
            'skipped' => 0,
            'encoded' => 0,
            'error'   => 0
        );

        // Store handled companies
        $companies = array();
        $brands = array();

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
                    $stats['deleted']++;
                    $this->_logger->log(sprintf("[Recordings] Deleting empty file %s\n", $filename), \Zend_Log::INFO);
                    unlink($this->_rawRecordingsDir . $filename);
                    continue;
                }

                // Check if this file is .rtp
                if (substr($filename, -6) == ".a.rtp")
                    array_push($files, $filename);
           }
        }

        $this->_logger->log(
                        sprintf("[Recordings] Processing %d files in recording dir %s\n", count($files), $this->_rawRecordingsDir),
                        \Zend_Log::INFO);

        // Get a mappers to reuse multiple times
        $kamAccCdrsMapper = new Mapper\KamAccCdrs;
        $recordingsMapper = new Mapper\Recordings;

        // Check each recording file
        foreach ($files as $filename) {

            // Store valid files
            if (preg_match("/((.*)=.*\.(\d+))\.[ao]\.rtp$/", $filename, $matches)) {
                $file = $matches[1];
                $callid = $matches[2];
                $recordcnt = $matches[3];
            } else {
                $this->_logger->log(sprintf("[Recordings][ERROR] Unable to get info from filename %s\n", $filename), \Zend_Log::INFO);
                continue;
            }

            // Get Call-Id hash id
            $hashid = substr(md5($callid),0,8);

            // Get callid from file
            $this->_logger->log(sprintf("[Recordings][%s] Checking file %s [record=%d]\n", $hashid, $file, $recordcnt), \Zend_Log::INFO);

            // Look if the converstation with that id has ended
            $kamAccCdr = $kamAccCdrsMapper->findOneByField("callid", $callid);
            if (!$kamAccCdr) {
                $stats['skipped']++;
                $this->_logger->log(sprintf("[Recordings][%s] Call with id = %s has not yet finished!\n", $hashid, $callid), \Zend_Log::INFO);
                continue;
            }

            // Convert files to .wav
            $extract_rtp = $this->_rawRecordingsDir . $file;
            $extract_wav = $this->_rawRecordingsDir . $callid . '.' . $recordcnt . '.wav';
            $extract_cmd = "/usr/bin/extractaudio -d '$extract_rtp' '$extract_wav' >/dev/null";
            $this->_logger->log(sprintf("[Recordings][%s] Extracting audio into %s\n", $hashid, basename($extract_wav)), \Zend_Log::INFO);
            exec($extract_cmd, $output, $retval);
            if ($retval != 0) {
                $stats['error']++;
                $this->_logger->log(sprintf("[Recordings][%s] Failed to extract audio: Command was %s\n", $hashid, $extract_cmd), \Zend_Log::INFO);
                continue;
            }

            // Convert .wav to .mp3
            $convert_wav = $this->_rawRecordingsDir . $callid . '.' . $recordcnt . ".wav";
            $convert_mp3 = $this->_rawRecordingsDir . $callid . '.' . $recordcnt . ".mp3";
            $metadata = '-metadata artist="'. $callid .'"';

            $convert_cmd = "/usr/bin/avconv -i '$convert_wav' $metadata '$convert_mp3' 2>&1 >/dev/null";
            $this->_logger->log(sprintf("[Recordings][%s] Encoding to %s\n", $hashid, basename($convert_mp3)), \Zend_Log::INFO);
            exec($convert_cmd, $output, $retval);
            if ($retval != 0) {
                $stats['error']++;
                $this->_logger->log(sprintf("[Recordings][%s] Failed to convert audio: Command was %s\n", $hashid, $convert_cmd), \Zend_Log::INFO);
                continue;
            }

            // Get created mp3 information
            $mp3info = new \Zend_Media_Mpeg_Abs($convert_mp3);
            $duration = $mp3info->getLengthEstimate();

            // Create an entry in Recordings table with the file
            $recording = new Model\Recordings;

            $recorder = '';
            if ($kamAccCdr->getProxy() == 'USER') {
                $type = 'ondemand';
                if ($kamAccCdr->getXcallid()) {
                    // If call second leg, callee is who activated the recording
                    $recorder = $kamAccCdr->getCallee();
                } else {
                    // If call first leg, caller is who activated the recording
                    $recorder = $kamAccCdr->getCaller();
                }
            } else {
                $type = 'ddi';
                if ($kamAccCdr->getXcallid()) {
                    // If call first leg, caller is who activated the recording
                    $recorder = $kamAccCdr->getCaller();
                } else {
                    // If call second leg, callee is who activated the recording
                    $recorder = $kamAccCdr->getCallee();
                }
            }

            $recording->setRecorder($recorder);

            // Get company and brand for this recording
            $company = $kamAccCdr->getCompany();
            $brand = $company->getBrand();

            // Get current company usage
            $companyLimit = $company->getRecordingsLimit();
            if ($companyLimit > 0) {
                $companyUsed = $company->getRecordingsDiskUsage();
                $companyUsage = $companyUsed * 100 / $companyLimit;
            }

            // Get current brand usage
            $brandLimit = $brand->getRecordingsLimit();
            if ($brandLimit > 0) {
                $brandUsed = $brand->getRecordingsDiskUsage();
                $brandUsage = $brandUsed * 100 / $brandLimit;
            }

            /*
             * 20180820111934_onDemand-109_202_109.mp3
             * datetime_type_recorder_source_destination.mp3
             */
            $baseName =
                preg_replace(
                    '/[^\d]/',
                    '',
                    $kamAccCdr->getStartTimeUtc()
                )
                . '_'
                . $type
                . '-'
                . $recorder
                . '_'
                . $kamAccCdr->getCaller()
                . '_'
                . $kamAccCdr->getCallee()
                . '.mp3';

            $recording
                ->setCompanyId($kamAccCdr->getCompanyId())
                ->setCalldate($kamAccCdr->getStartTimeUtc())
                ->setType($type)
                ->setCallid($kamAccCdr->getCallid())
                ->setDuration($duration)
                ->setCaller($kamAccCdr->getCaller())
                ->setCallee($kamAccCdr->getCallee())
                ->putRecordedFile($convert_mp3, $baseName);

            // Store this Recording
            $recordId = $recordingsMapper->save($recording);
            $this->_logger->log(
                            sprintf("[Recordings][%s] Create Recordings entry with id %s\n", $hashid, $recordId),
                            \Zend_Log::INFO);

            // If this company has disk space limit
            if ($companyLimit > 0) {
                // Check the new used space
                $companyNewUsage = ($companyUsed + $recording->getRecordedFileFileSize()) * 100 / $companyLimit;
                $this->_logger->log(sprintf("[Recordings][company%d] DiskUsage %d%%\n", $company->getId(), $companyNewUsage), \Zend_Log::INFO);

                // Space over available!
                if ($companyNewUsage >= 100) {
                    // Rotate old company recordings
                    $this->rotateCompanyRecordings($company);
                } else if ($companyUsage < 80 && $companyNewUsage >= 80) {
                    // Space over 80%, send notification email
                    $this->sendCompanyMail($company);
                }
            }

            // If this brand has disk space limit
            if ($brandLimit > 0) {
                // Check the new used space
                $brandNewUsage = ($brandUsed + $recording->getRecordedFileFileSize()) * 100 / $brandLimit;
                $this->_logger->log(sprintf("[Recordings][brand%d] DiskUsage %d%%\n", $brand->getId(), $brandNewUsage), \Zend_Log::INFO);

                // Space over available!
                if ($brandNewUsage >= 100) {
                    // Rotate old brands recordings
                    $this->rotateBrandRecordings($brand);
                } else if ($brandUsage < 80 && $brandNewUsage >= 80) {
                    // Space over 80%, send notification email
                    $this->sendBrandMail($brand);
                }
            }

            // Remove encoded files
            unlink($convert_wav);
            $stats['encoded']++;
       }

        // Total processed calls
        $total = $stats['encoded'] + $stats['error'] + $stats['deleted'] + $stats['skipped'];
        $summary = sprintf("[Recordings] Total %d processed: %d successful, %d error, %d deleted, %d skipped.\n",
                        $total, $stats['encoded'], $stats['error'], $stats['deleted'], $stats['skipped']);
        $this->_logger->log($summary, \Zend_Log::INFO);

    }

    private function rotateCompanyRecordings($company)
    {
        $usage = $company->getRecordingsDiskUsage();
        $limit = $company->getRecordingsLimit();
        $recordings = $company->getRecordings();

        while ($usage >= $limit && !empty($recordings)) {
            $oldest = array_shift($recordings);
            $summary = sprintf("[Recordings][Company%d] MaxDiskLimit reached (%s/%s): Recording %d has been rotated out.\n",
                    $company->getId(),
                    SizeFormatter::sizeToHuman($usage),
                    SIzeFormatter::sizeToHuman($limit),
                    $oldest->getId());
            $this->_logger->log($summary, \Zend_Log::INFO);
            $usage -= $oldest->getRecordedFileFileSize();
            $oldest->delete();
        }
    }

    private function rotateBrandRecordings($brand)
    {
        $usage = $brand->getRecordingsDiskUsage();
        $limit = $brand->getRecordingsLimit();

        // Get brand companies
        $companyIds = array();
        foreach ($brand->getCompanies() as $company) {
            array_push($companyIds, $company->getId());
        }

        // Get removable calls
        $recordingsMapper = new \IvozProvider\Mapper\Sql\Recordings();
        $recordings = $recordingsMapper->fetchList("companyId IN (".implode(',', $companyIds).")", "calldate ASC", 10);

        while ($usage >= $limit && !empty($recordings)) {
            $oldest = array_shift($recordings);
            $summary = sprintf("[Recordings][Brand%d] MaxDiskLimit reached (%s/%s): Recording %d has been rotated out.\n",
                    $brand->getId(),
                    SizeFormatter::sizeToHuman($usage),
                    SIzeFormatter::sizeToHuman($limit),
                    $oldest->getId());
            $this->_logger->log($summary, \Zend_Log::INFO);
            $usage -= $oldest->getRecordedFileFileSize();
            $oldest->delete();
        }
    }

    public function sendBrandMail($brand)
    {
        try {
            // Get defaults mail settings
            $config = \Zend_Controller_Front::getInstance()->getParam('bootstrap');
            $mail = $config->getOption('mail');
            $default_fromname = $mail['fromname'];
            $default_fromuser = $mail['fromuser'];
            $voicemail = $config->getOption('voicemail');

            $body = file_get_contents(APPLICATION_PATH . "/../templates/emailBrands_body.tmpl");
            $subject = file_get_contents(APPLICATION_PATH . "/../templates/emailBrands_subject.tmpl");

            $fromName = $brand->getFromName();
            if (empty($fromName)) $fromName = $default_fromname;
            $fromAddress = $brand->getFromAddress();
            if (empty($fromAddress)) $fromAddress = $default_fromuser;

            $substitution = array(
                '${BRAND_NAME}'     => $brand->getName(),
                '${BRAND_ID}'       => $brand->getId(),
                '${DISK_USAGE}'     => SizeFormatter::sizeToHuman($brand->getRecordingsDiskUsage()),
                '${DISK_LIMIT}'     => SizeFormatter::sizeToHuman($brand->getRecordingsLimit()),
            );

            foreach ($substitution as $search => $replace) {
                $body = str_replace($search, $replace, $body);
                $subject = str_replace($search, $replace, $subject);
            }

            $mail = new Zend_Mail('UTF-8');
            $mail->setBodyText($body);
            $mail->setSubject($subject);
            $mail->setFrom($fromAddress, $fromName);
            $mail->addTo($brand->getRecordingsLimitEmail());
            $mail->send();

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function sendCompanyMail($company)
    {
        try {
            // Get defaults mail settings
            $config = \Zend_Controller_Front::getInstance()->getParam('bootstrap');
            $mail = $config->getOption('mail');
            $default_fromname = $mail['fromname'];
            $default_fromuser = $mail['fromuser'];
            $voicemail = $config->getOption('voicemail');
            $brand = $company->getBrand();

            $body = file_get_contents(APPLICATION_PATH . "/../templates/emailCompanies_body.tmpl");
            $subject = file_get_contents(APPLICATION_PATH . "/../templates/emailCompanies_subject.tmpl");

            $fromName = $brand->getFromName();
            if (empty($fromName)) $fromName = $default_fromname;
            $fromAddress = $brand->getFromAddress();
            if (empty($fromAddress)) $fromAddress = $default_fromuser;

            $substitution = array(
                '${COMPANY_NAME}'     => $company->getName(),
                '${COMPANY_ID}'       => $company->getId(),
                '${DISK_USAGE}'       => SizeFormatter::sizeToHuman($company->getRecordingsDiskUsage()),
                '${DISK_LIMIT}'       => SizeFormatter::sizeToHuman($company->getRecordingsLimit()),
            );

            foreach ($substitution as $search => $replace) {
                $body = str_replace($search, $replace, $body);
                $subject = str_replace($search, $replace, $subject);
            }

            $mail = new Zend_Mail('UTF-8');
            $mail->setBodyText($body);
            $mail->setSubject($subject);
            $mail->setFrom($fromAddress, $fromName);
            $mail->addTo($company->getRecordingsLimitEmail());
            $mail->send();

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
