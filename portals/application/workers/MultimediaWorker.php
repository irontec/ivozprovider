<?php


use IvozProvider\Mapper\Sql\MusicOnHold;
class MultimediaWorker extends Iron_Gearman_Worker
{
    protected $_timeout = 10000; // 1000 = 1 second
    protected $_mapper;
    protected $_frontend;
    protected $_modelName;

    protected function initRegisterFunctions()
    {
        $this->_registerFunction = array(
                'encodeFSOToMp3' => '_encode'
        );
    }

    protected function init()
    {
        $this->_mapper = new MusicOnHold();
    }

    protected function timeout()
    {
        $this->_mapper->getDbTable()->getAdapter()->closeConnection();
    }

    public function _encode(\GearmanJob $serializedJob)
    {
        $this->_logger->log($this->_modelName . "-  start encode " , Zend_Log::INFO);
        $job = igbinary_unserialize($serializedJob->workload());

        $id = $job->getId();
        $this->_modelName = $job->getModelName();

        $mapperRoute = "\\IvozProvider\\Mapper\\Sql\\".$this->_modelName;
        $mapper = new $mapperRoute();

        $model = $mapper->find($id);

        $model->setStatus('encoding')
              ->save();

        try {
            $originalFile = $model->fetchOriginalFile()->getFilePath();
            $filename = pathinfo($model->getOriginalFileBaseName(), PATHINFO_FILENAME);

            $path = $this->_getFilePath();
            $encodedFilePath = $path . DIRECTORY_SEPARATOR . 'tmp';
            $encodedFile = $encodedFilePath . DIRECTORY_SEPARATOR . $filename .'.wav';

            $this->_createFolder($encodedFilePath);

            $cmd = 'avconv -i ' . str_replace(" ", "\ ", "'$originalFile'") . ' -b:a 64k -ar 8000 -ac 1 ' . "'$encodedFile'";
            $this->_logger->log($this->_modelName . "-  " . $cmd, Zend_Log::INFO);
            exec($cmd);

            $model->putEncodedFile($encodedFile, $filename .'.wav');
            $model->setStatus("ready")
                  ->save();


            if ($this->_modelName == "MusicOnHold" || $this->_modelName == "GenericMusicOnHold") {
                $astMusicOnHoldMapper = new \IvozProvider\Mapper\Sql\AstMusiconhold();
                $astMusicOnHold = $astMusicOnHoldMapper->findOneByField("name", $model->getOwner());// $model->getOwner() en el MusicOnHold es el companyId y en el GenericMusicOnHold el brandId

                if (is_null($astMusicOnHold)) {
                    $this->_replicateModelInAstMusicOnHold($model, $model->fetchEncodedFile(false));
                }
            }
            $this->_logger->log($this->_modelName . "-  end encode", Zend_Log::INFO);
         }
         catch(\Exception $e){
             $model->setStatus("error")
                   ->save();
             $this->_logger->log($this->_modelName . "-  Error recodering MusicOnHold with id " . $id . "  " . $e->getMessage(), Zend_Log::ERR);

         }
    }

    protected function _getFilePath(){
        $bootstrap = \Zend_Controller_Front::getInstance()->getParam('bootstrap');
        $conf = (Object) $bootstrap->getOptions();
        $path = $conf->Iron['fso']['localStoragePath'];
        return $path;
    }

    protected function _createFolder($encodedFilePath){
        if (!file_exists($encodedFilePath)) {
            $old = umask(0);
            mkdir($encodedFilePath, 0755, true);
            umask($old);
        }
    }

    protected function _replicateModelInAstMusicOnHold($model, $fso)
    {
        $filePath = $fso->getFilePath();
        $folderPath = dirname($filePath);

        $astMusicOnHold = new \IvozProvider\Model\AstMusiconhold();
        $astMusicOnHold->setName($model->getOwner())
        ->setMode("files")
        ->setDirectory($folderPath)
        ->setFormat("alaw")
        ->setStamp('CURRENT_TIMESTAMP') // pequeño truco de los modelos
        ->save();
    }


}
