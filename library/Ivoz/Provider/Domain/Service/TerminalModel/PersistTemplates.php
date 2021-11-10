<?php

namespace Ivoz\Provider\Domain\Service\TerminalModel;

use Ivoz\Provider\Domain\Model\TerminalModel\TerminalModelInterface;
use Symfony\Component\Filesystem\Filesystem;

class PersistTemplates implements TerminalModelLifecycleEventHandlerInterface
{
    public function __construct(
        private string $localStoragePath,
        private Filesystem $fs
    ) {
    }

    public static function getSubscribedEvents()
    {
        return [
            self::EVENT_POST_PERSIST => 10
        ];
    }

    /**
     * @return void
     */
    public function execute(TerminalModelInterface $entity)
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

    /**
     * @return void
     */
    protected function createFolder(string $route)
    {
        $folderExists = $this->fs->exists($route);
        if ($folderExists) {
            return;
        }

        $old = umask(0);
        $this->fs->mkdir($route, 0777);
        umask($old);
    }

    /**
     * @return void
     *
     * @param null|string $template
     */
    protected function saveFiles(string $file, string $route, ?string $template)
    {
        $fileRoute = $route . DIRECTORY_SEPARATOR . $file;
        $fileExists = $this->fs->exists($fileRoute);

        if ($fileExists) {
            $backupExists = $this->fs->exists($fileRoute . '.back');
            if ($backupExists) {
                $this->fs->remove(
                    $fileRoute . '.back'
                );
            }
            $this->fs->rename(
                $fileRoute,
                $fileRoute . '.back'
            );
        }

        $this->fs->dumpFile(
            $fileRoute,
            $template ?? ''
        );
    }
}
