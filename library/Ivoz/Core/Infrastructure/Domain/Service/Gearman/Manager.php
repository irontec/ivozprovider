<?php

namespace Ivoz\Core\Infrastructure\Domain\Service\Gearman;

class Manager
{
    const WORKER_PATH = '/opt/irontec/ivozprovider/web/admin/application/workers';

    private static $_gearmanServers;
    private static $_options;

    /**
     * @return void
     */
    public static function setOptions($options)
    {
        self::$_options = $options;
    }

    /**
     * Retrieves the current Gearman Servers
     *
     * @return array
     */
    public static function getServers()
    {
        if (self::$_gearmanServers === null) {
            self::$_gearmanServers = implode(",", self::$_options['servers']);
        }

        return self::$_gearmanServers;
    }

    /**
     * Creates a GearmanClient instance and sets the job servers
     *
     * @return \GearmanClient
     */
    public static function getClient()
    {
        $gmclient= new \GearmanClient();
        $servers = self::getServers();
        $gmclient->addServers($servers);
        if (isset(self::$_options['client']) &&
            isset(self::$_options['client']['timeout'])) {
            $gmclient->setTimeout(self::$_options['client']['timeout']);
        }

        return $gmclient;
    }

    /**
     * Creates a GearmanWorker instance
     *
     * @return \GearmanWorker
     */
    public static function getWorker()
    {
        $worker = new \GearmanWorker();
        $servers = self::getServers();

        $worker->addServers($servers);

        return $worker;
    }

    /**
     * Given a worker name, it checks if it can be loaded. If it's possible,
     * it creates and returns a new instance.
     *
     * @param string $workerName
     * @param string $logFile
     * @return \GearmanWorker
     */
    public static function runWorker($workerName, $logFile = null)
    {
        $workerName .= 'Worker';
        $workerFile = self::WORKER_PATH . '/' . $workerName . '.php';

        if (!file_exists($workerFile)) {
            throw new \InvalidArgumentException(
                "Worker not found: {$workerFile}"
            );
        }

        require $workerFile;

        if (!class_exists($workerName)) {
            throw new \InvalidArgumentException(
                "class {$workerName} not found in {$workerFile}"
            );
        }

        return new $workerName($logFile);
    }
}
