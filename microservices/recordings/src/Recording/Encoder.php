<?php

namespace Recording;

use Ivoz\Core\Domain\Service\EntityPersisterInterface;
use Ivoz\Kam\Domain\Model\AccCdr\AccCdrInterface;
use Ivoz\Kam\Domain\Model\AccCdr\AccCdrRepository;
use Ivoz\Provider\Domain\Model\Recording\RecordingDTO;
use IvozProvider\Utils\SizeFormatter;
use Symfony\Bridge\Monolog\Logger;
use Symfony\Component\Process\Process;


class Encoder
{
    /**
     * @var AccCdrRepository
     */
    protected $cdrRepository;

    /**
     * @var EntityPersisterInterface
     */
    protected $entityPersister;

    /**
     * @var string
     */
    protected $rawRecordingsDir;

    /**
     * @var Logger
     */
    protected $logger;

    public function __construct(
        AccCdrRepository $cdrRepository,
        EntityPersisterInterface $entityPersister,
        string $rawRecordingsDir,
        Logger $logger

    ) {
        $this->cdrRepository = $cdrRepository;
        $this->entityPersister = $entityPersister;
        $this->rawRecordingsDir = $rawRecordingsDir;
        $this->logger = $logger;
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

        // Ignore process when recordings folder does not exist
        if (!is_dir($this->rawRecordingsDir)) {
            return;
        }

        // Get a list of pending recordings
        $files = array();
        if ($dir = opendir($this->rawRecordingsDir)) {
            while (false !== ($filename = readdir($dir))) {
                // Absolute path to file
                $filenameabs = $this->rawRecordingsDir . $filename;

                // Only handle files
                if (!is_file($filenameabs))
                    continue;

                // Delete empty files
                if (filesize($filenameabs) === 0) {
                    $stats['deleted']++;
                    $this->logger->info(sprintf("[Recordings] Deleting empty file %s\n", $filename));
                    unlink($this->rawRecordingsDir . $filename);
                    continue;
                }

                // Check if this file is .rtp
                if (substr($filename, -6) == ".a.rtp")
                    array_push($files, $filename);
           }
        }

        $this->logger->info(
            sprintf("[Recordings] Processing %d files in recording dir %s\n", count($files), $this->rawRecordingsDir)
        );

        // Check each recording file
        foreach ($files as $filename) {

            // Store valid files
            if (preg_match("/((.*)=.*\.(\d+))\.[ao]\.rtp$/", $filename, $matches)) {
                $file = $matches[1];
                $callid = $matches[2];
                $recordcnt = $matches[3];
            } else {
                $this->logger->error(sprintf("[Recordings][ERROR] Unable to get info from filename %s\n", $filename));
                continue;
            }

            // Get Call-Id hash id
            $hashid = substr(md5($callid),0,8);

            // Get callid from file
            $this->logger->info(sprintf("[Recordings][%s] Checking file %s [record=%d]\n", $hashid, $file, $recordcnt));

            // Look if the converstation with that id has ended
            /** @var AccCdrInterface $kamAccCdr */
            $kamAccCdr = $this->cdrRepository->findOneBy(['callid' => $callid]);
            if (!$kamAccCdr) {
                $stats['skipped']++;
                $this->logger->info(sprintf("[Recordings][%s] Call with id = %s has not yet finished!\n", $hashid, $callid));
                continue;
            }

            // Convert files to .wav
            $extractRtp = $this->rawRecordingsDir . $file;
            $extractWav = $this->rawRecordingsDir . $callid . '.' . $recordcnt . '.wav';
            $this->logger->info(sprintf("[Recordings][%s] Extracting audio into %s\n", $hashid, basename($extractWav)));

            $extractProcess = new Process([
                "/usr/bin/extractaudio",
//                "-d",
                $extractRtp,
                $extractWav
            ]);
            $extractProcess->mustRun();

            if ($extractProcess->getExitCode() != 0) {
                $stats['error']++;
                $this->logger->error(
                    sprintf(
                        "[Recordings][%s] Failed to extract audio: Command was %s\n",
                        $hashid,
                        $extractProcess->getCommandLine()
                    )
                );
                continue;
            }

            // Convert .wav to .mp3
            $convertWav = $this->rawRecordingsDir . $callid . '.' . $recordcnt . ".wav";
            $convertMp3 = $this->rawRecordingsDir . $callid . '.' . $recordcnt . ".mp3";
            $this->logger->info(sprintf("[Recordings][%s] Encoding to %s\n", $hashid, basename($convertMp3)));

            $convertProcess = new Process([
                "/usr/bin/avconv",
                "-y",
                "-i",
                $convertWav,
                $convertMp3
            ]);
            $convertProcess->mustRun();

            if ($convertProcess->getExitCode() != 0) {
                $stats['error']++;
                $this->logger->error(
                    sprintf(
                        "[Recordings][%s] Failed to convert audio: Command was %s\n",
                        $hashid,
                        $convertProcess->getCommandLine()
                    )
                );
                continue;
            }

            // Get created mp3 information
            $mp3info = new \Zend_Media_Mpeg_Abs($convertMp3);
            $duration = $mp3info->getLengthEstimate();

            // Create an entry in Recordings table with the file
            $recordingDto = new RecordingDTO();

            if ($kamAccCdr->getProxy() == 'USER') {
                $type = 'ondemand';
                if ($kamAccCdr->getXcallid()) {
                    // If call second leg, callee is who activated the recording
                    $recorder = $kamAccCdr->getCallee();
                } else {
                    // If call first leg, caller is who activated the recording
                    $recorder = $kamAccCdr->getCaller();
                }

                $recordingDto->setRecorder($recorder);

            } else {
                $type = 'ddi';
            }

            // Get company and brand for this recording
            $company = $kamAccCdr->getCompany();

            $recordingDto->setCompanyId($company->getId())
                ->setCalldate($kamAccCdr->getStartTime())
                ->setType($type)
                ->setCallid($kamAccCdr->getCallid())
                ->setDuration($duration)
                ->setCaller($kamAccCdr->getCaller())
                ->setCallee($kamAccCdr->getCallee())
                ->setRecordedFileBaseName($callid . '.mp3')
                ->setRecordedFilePath($convertMp3);

            // Store this Recording
            $recording = $this->entityPersister->persistDto($recordingDto, null, true);
            $this->logger->info(
                sprintf("[Recordings][%s] Create Recordings entry with id %s\n", $hashid, $recording->getId())
            );
//
//            // If this company has disk space limit
//            if ($companyLimit > 0) {
//                // Check the new used space
//                $companyNewUsage = ($companyUsed + $recordingDto->getRecordedFileFileSize()) * 100 / $companyLimit;
//                $this->logger->info(sprintf("[Recordings][company%d] DiskUsage %d%%\n", $company->getId(), $companyNewUsage));
//
//                // Space over available!
//                if ($companyNewUsage >= 100) {
//                    // Rotate old company recordings
//                    $this->rotateCompanyRecordings($company);
//                } else if ($companyUsage < 80 && $companyNewUsage >= 80) {
//                    // Space over 80%, send notification email
//                    $this->sendCompanyMail($company);
//                }
//            }
//
//            // If this brand has disk space limit
//            if ($brandLimit > 0) {
//                // Check the new used space
//                $brandNewUsage = ($brandUsed + $recordingDto->getRecordedFileFileSize()) * 100 / $brandLimit;
//                $this->logger->info(sprintf("[Recordings][brand%d] DiskUsage %d%%\n", $brand->getId(), $brandNewUsage));
//
//                // Space over available!
//                if ($brandNewUsage >= 100) {
//                    // Rotate old brands recordings
//                    $this->rotateBrandRecordings($brand);
//                } else if ($brandUsage < 80 && $brandNewUsage >= 80) {
//                    // Space over 80%, send notification email
//                    $this->sendBrandMail($brand);
//                }
//            }

            // Remove encoded files
            unlink($convertWav);
            $stats['encoded']++;
       }

        // Total processed calls
        $total = $stats['encoded'] + $stats['error'] + $stats['deleted'] + $stats['skipped'];
        $summary = sprintf(
            "[Recordings] Total %d processed: %d successful, %d error, %d deleted, %d skipped.\n",
            $total,
            $stats['encoded'],
            $stats['error'],
            $stats['deleted'],
            $stats['skipped']
        );
        $this->logger->info($summary);
    }

//    private function rotateCompanyRecordings($company)
//    {
//        $usage = $company->getRecordingsDiskUsage();
//        $limit = $company->getRecordingsLimit();
//        $recordings = $company->getRecordings();
//
//        while ($usage >= $limit && !empty($recordings)) {
//            $oldest = array_shift($recordings);
//            $summary = sprintf("[Recordings][Company%d] MaxDiskLimit reached (%s/%s): Recording %d has been rotated out.\n",
//                    $company->getId(),
//                    SizeFormatter::sizeToHuman($usage),
//                    SIzeFormatter::sizeToHuman($limit),
//                    $oldest->getId());
//            $this->logger->info($summary);
//            $usage -= $oldest->getRecordedFileFileSize();
//            $oldest->delete();
//        }
//    }
//
//    private function rotateBrandRecordings($brand)
//    {
//        $usage = $brand->getRecordingsDiskUsage();
//        $limit = $brand->getRecordingsLimit();
//
//        // Get brand companies
//        $companyIds = array();
//        foreach ($brand->getCompanies() as $company) {
//            array_push($companyIds, $company->getId());
//        }
//
//        // Get removable calls
//        $recordingRepository = new \IvozProvider\Mapper\Sql\Recordings();
//        $recordings = $recordingRepository->fetchList("companyId IN (".implode(',', $companyIds).")", "calldate ASC", 10);
//
//        while ($usage >= $limit && !empty($recordings)) {
//            $oldest = array_shift($recordings);
//            $summary = sprintf("[Recordings][Brand%d] MaxDiskLimit reached (%s/%s): Recording %d has been rotated out.\n",
//                    $brand->getId(),
//                    SizeFormatter::sizeToHuman($usage),
//                    SIzeFormatter::sizeToHuman($limit),
//                    $oldest->getId());
//            $this->logger->info($summary);
//            $usage -= $oldest->getRecordedFileFileSize();
//            $oldest->delete();
//        }
//    }
//
//    private function sendBrandMail($brand)
//    {
//        try {
//            // Get defaults mail settings
//            $config = \Zend_Controller_Front::getInstance()->getParam('bootstrap');
//            $mail = $config->getOption('mail');
//            $default_fromname = $mail['fromname'];
//            $default_fromuser = $mail['fromuser'];
//            $voicemail = $config->getOption('voicemail');
//
//            $body = file_get_contents(APPLICATION_PATH . "/../templates/emailBrands_body.tmpl");
//            $subject = file_get_contents(APPLICATION_PATH . "/../templates/emailBrands_subject.tmpl");
//
//            $fromName = $brand->getFromName();
//            if (empty($fromName)) $fromName = $default_fromname;
//            $fromAddress = $brand->getFromAddress();
//            if (empty($fromAddress)) $fromAddress = $default_fromuser;
//
//            $substitution = array(
//                '${BRAND_NAME}'     => $brand->getName(),
//                '${BRAND_ID}'       => $brand->getId(),
//                '${DISK_USAGE}'     => SizeFormatter::sizeToHuman($brand->getRecordingsDiskUsage()),
//                '${DISK_LIMIT}'     => SizeFormatter::sizeToHuman($brand->getRecordingsLimit()),
//            );
//
//            foreach ($substitution as $search => $replace) {
//                $body = str_replace($search, $replace, $body);
//                $subject = str_replace($search, $replace, $subject);
//            }
//
//            $mail = new Zend_Mail('utf8');
//            $mail->setBodyText($body);
//            $mail->setSubject($subject);
//            $mail->setFrom($fromAddress, $fromName);
//            $mail->addTo($brand->getRecordingsLimitEmail());
//            $mail->send();
//
//        } catch (Exception $e) {
//            echo $e->getMessage();
//        }
//    }
//
//    private function sendCompanyMail($company)
//    {
//        try {
//            // Get defaults mail settings
//            $config = \Zend_Controller_Front::getInstance()->getParam('bootstrap');
//            $mail = $config->getOption('mail');
//            $default_fromname = $mail['fromname'];
//            $default_fromuser = $mail['fromuser'];
//            $voicemail = $config->getOption('voicemail');
//            $brand = $company->getBrand();
//
//            $body = file_get_contents(APPLICATION_PATH . "/../templates/emailCompanies_body.tmpl");
//            $subject = file_get_contents(APPLICATION_PATH . "/../templates/emailCompanies_subject.tmpl");
//
//            $fromName = $brand->getFromName();
//            if (empty($fromName)) $fromName = $default_fromname;
//            $fromAddress = $brand->getFromAddress();
//            if (empty($fromAddress)) $fromAddress = $default_fromuser;
//
//            $substitution = array(
//                '${COMPANY_NAME}'     => $company->getName(),
//                '${COMPANY_ID}'       => $company->getId(),
//                '${DISK_USAGE}'       => SizeFormatter::sizeToHuman($company->getRecordingsDiskUsage()),
//                '${DISK_LIMIT}'       => SizeFormatter::sizeToHuman($company->getRecordingsLimit()),
//            );
//
//            foreach ($substitution as $search => $replace) {
//                $body = str_replace($search, $replace, $body);
//                $subject = str_replace($search, $replace, $subject);
//            }
//
//            $mail = new Zend_Mail('utf8');
//            $mail->setBodyText($body);
//            $mail->setSubject($subject);
//            $mail->setFrom($fromAddress, $fromName);
//            $mail->addTo($company->getRecordingsLimitEmail());
//            $mail->send();
//
//        } catch (Exception $e) {
//            echo $e->getMessage();
//        }
//    }
}
