<?php
namespace Ivoz\Provider\Domain\Service\TerminalModel;

use Ivoz\Provider\Domain\Model\TerminalModel\TerminalModelInterface;

class PersistTemplates implements TerminalModelLifecycleEventHandlerInterface
{
    public function __construct() {}

    public function execute(TerminalModelInterface $entity, $isNew)
    {
        $genericMustChange = $entity->hasChanged('genericTemplate');
        $specificMustChange = $entity->hasChanged('specificTemplate');

        /**
         * @todo
         */
        throw new \Exception('Not FSO implemented yet');

        if (!$genericMustChange && !$specificMustChange) {
            return;
        }


//        $path = $conf->Iron['fso']['localStoragePath'];
//        $route = $path . DIRECTORY_SEPARATOR . "Provision_template" . DIRECTORY_SEPARATOR . $pk;
//
//        if ($genericMustChange) {
//            try {
//                $template = $model->getGenericTemplate();
//                $this->createFolder($route);
//                $file = "generic.phtml";
//                $this->saveFiles($file, $route, $template);
//
//            } catch (\Exception $e) {
//                throw $e;
//            }
//        }
//
//        if ($specificMustChange){
//            $template = $model->getSpecificTemplate();
//            $this->createFolder($route);
//            $file = "specific.phtml";
//            $this->saveFiles($file, $route, $template);
//        }
    }
}