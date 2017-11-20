<?php

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class MultimediaWorker extends Iron_Gearman_Worker
{
    /**
     * @var \Ivoz\Core\Application\Service\DataGateway
     */
    protected $dataGateway;

    protected function initRegisterFunctions()
    {
        $this->_registerFunction = array(
                'encodeFSOToMp3' => '_encode'
        );
    }

    protected function init()
    {
        if (\Zend_Registry::isRegistered("data_gateway")) {
            $this->dataGateway = \Zend_Registry::get("data_gateway");
        }
    }

    public function _encode(\GearmanJob $serializedJob)
    {
        // Thanks Gearmand, you've done your job
        $serializedJob->sendComplete("DONE");

        /** @var \IvozProvider\Gearmand\Jobs\Recoder $job */
        $job = igbinary_unserialize($serializedJob->workload());

        $entityId = $job->getId();
        $entityName = $job->getEntityName();
        $entityNameSegments = explode('\\', $entityName);
        $entityClass = end($entityNameSegments);

        $this->_logger->log($entityName . "-  start encode " , Zend_Log::INFO);

        $entityDto = $this->dataGateway->find(
            $entityName,
            $entityId
        );

        $entityDto->setStatus('encoding');
        $this->dataGateway->update($entityName, $entityDto);

        try {
            $originalFile = $entityDto->getOriginalFilePath();
            $originalFileNoExt = pathinfo($entityDto->getOriginalFileBaseName(), PATHINFO_FILENAME);

            // Convert original file to raw wav using avconv
            $dumpWavFile = sprintf("/tmp/%s%draw.wav", $entityClass, $entityId);
            $process = new Process([
                "avconv",
                "-i", $originalFile,
                "-b:a", "64k",
                "-ar", "8000",
                "-ac", "1",
                $dumpWavFile
            ]);
            $process->mustRun();

            $encodedFile = sprintf("/tmp/%s%d.wav", $entityClass, $entityId);
            $process = new Process([
                "sox",
                $dumpWavFile,
                "-b", "16",
                "-c", "1",
                $encodedFile,
                "rate", "-ql", "8000"
            ]);
            $process->mustRun();

            // Remove temp files
            unlink($dumpWavFile);

            $entityDto
                ->setEncodedFileBaseName($originalFileNoExt . '.wav')
                ->setEncodedFilePath($encodedFile)
                ->setStatus('ready');

        } catch(\Exception $e){
            $entityDto->setStatus('error');
            $this->_logger->log(
                "Failed to encode $entityClass id $entityId: " . $e->getMessage(),
                Zend_Log::ERR
            );
            throw $e;
        }

        try {
            // Store final status of encoded process
            $this->dataGateway->update($entityName, $entityDto);
            $this->_logger->log(
                "Encoding $entityClass with id $entityId ended with status " . $entityDto->getStatus(),
                Zend_Log::INFO
            );
        } catch(\Exception $e){
            $this->_logger->log(
                "Failed to update status of $entityClass id $entityId: " . $e->getMessage(),
                Zend_Log::INFO
            );
            throw $e;
        }

        // Done!
        exit(0);
    }

}
