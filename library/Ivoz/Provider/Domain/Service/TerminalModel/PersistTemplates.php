<?php

namespace Ivoz\Provider\Domain\Service\TerminalModel;

use Ivoz\Provider\Domain\Model\TerminalModel\TerminalModelInterface;
use Symfony\Component\Filesystem\Filesystem;

class PersistTemplates implements TerminalModelLifecycleEventHandlerInterface
{
    /**
     * @var string
     */
    protected $localStoragePath;

    /**
     * @var Filesystem
     */
    protected $fs;

    public function __construct(
        string $localStoragePath,
        Filesystem $fs
    ) {
        $this->localStoragePath = $localStoragePath;
        $this->fs = $fs;
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => 10
        ];
    }

    public function execute(TerminalModelInterface $entity, $isNew)
    {
        $genericMustChange = $entity->hasChanged('genericTemplate');
        $specificMustChange = $entity->hasChanged('specificTemplate');

        if (!$genericMustChange && !$specificMustChange) {
            return;
        }

        $route =
            $this->localStoragePath
            . DIRECTORY_SEPARATOR
            . 'Provision_template'
            . DIRECTORY_SEPARATOR
            . $entity->getId();

        if ($genericMustChange) {
            $template = $entity->getGenericTemplate();
            $this->createFolder($route);
            $file = 'generic.phtml';
            $this->saveFiles($file, $route, $template);
        }

        if ($specificMustChange) {
            $template = $entity->getSpecificTemplate();
            $this->createFolder($route);
            $file = 'specific.phtml';
            $this->saveFiles($file, $route, $template);
        }
    }

    protected function createFolder($route)
    {
        $folderExists = $this->fs->exists($route);
        if ($folderExists) {
            return;
        }

        $old = umask(0);
        $this->fs->mkdir($route, 0777);
        umask($old);
    }

    protected function saveFiles($file, $route, $template)
    {
        $fileRoute = $route . DIRECTORY_SEPARATOR .$file;
        $fileExists = $this->fs->exists($fileRoute);

        if($fileExists) {
            $this->fs->rename(
                $fileRoute,
                $fileRoute . '.back'
            );
        }

        $this->fs->dumpFile($fileRoute, $template);
    }
}