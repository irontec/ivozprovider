<?php
namespace Ivoz\Provider\Domain\Service\TerminalModel;

use Ivoz\Provider\Domain\Model\TerminalModel\TerminalModelInterface;

class PersistTemplates implements TerminalModelLifecycleEventHandlerInterface
{
    protected $localStoragePath;

    public function __construct(string $localStoragePath)
    {
        $this->localStoragePath = $localStoragePath;
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
            . "Provision_template"
            . DIRECTORY_SEPARATOR
            . $entity->getId();

        if ($genericMustChange) {
            $template = $entity->getGenericTemplate();
            $this->createFolder($route);
            $file = "generic.phtml";
            $this->saveFiles($file, $route, $template);
        }

        if ($specificMustChange) {
            $template = $entity->getSpecificTemplate();
            $this->createFolder($route);
            $file = "specific.phtml";
            $this->saveFiles($file, $route, $template);
        }
    }

    protected function createFolder($route)
    {
        if (!file_exists($route)) {
            $old = umask(0);
            mkdir($route, 0777, true);
            umask($old);
        }
    }

    protected function saveFiles($file, $route, $template)
    {
        $fileRoute = $route . DIRECTORY_SEPARATOR .$file;
        if( file_exists($fileRoute)) {
            rename($fileRoute, $fileRoute . ".back");
        }
        file_put_contents($fileRoute, $template);
    }
}