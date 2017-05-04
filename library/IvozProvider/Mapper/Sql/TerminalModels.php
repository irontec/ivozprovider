<?php

/**
 * Application Model Mapper
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 * @copyright ZF model generator
 * @license http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * Data Mapper implementation for IvozProvider\Model\TerminalModels
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 */
namespace IvozProvider\Mapper\Sql;
class TerminalModels extends Raw\TerminalModels
{
    public function save(\IvozProvider\Model\Raw\TerminalModels $model, $forceInsert = false){
        $genericMustChange = $model->hasChange("genericTemplate");
        $specificMustChange = $model->hasChange("specificTemplate");

        $bootstrap = \Zend_Controller_Front::getInstance()->getParam('bootstrap');
        $conf = (Object) $bootstrap->getOptions();
        $pk = parent::save($model, $forceInsert);

        if (!isset($conf->Iron) || !isset($conf->Iron['fso'])) {
            return $pk;
        }
        $path = $conf->Iron['fso']['localStoragePath'];
        $route = $path . DIRECTORY_SEPARATOR . "Provision_template" . DIRECTORY_SEPARATOR . $pk;
//         var_dump($pk);
        if( $genericMustChange ){
            try{
                $template = $model->getGenericTemplate();
                $this->createFolder($route);
                $file = "generic.phtml";
                $this->saveFiles($file, $route, $template);
            }
            catch (\Exception $e){
                throw $e;
            }
        }

        if( $specificMustChange ){
            try{
                $template = $model->getSpecificTemplate();
                $this->createFolder($route);
                $file = "specific.phtml";
                $this->saveFiles($file, $route, $template);
            }
            catch (\Exception $e){
                throw $e;
            }
        }

        return $pk;
    }

    protected function createFolder($route){
        if (!file_exists($route)) {
            $old = umask(0);
            mkdir($route, 0777, true);
            umask($old);
        }
    }

    protected function saveFiles($file, $route, $template){
        $fileRoute = $route . DIRECTORY_SEPARATOR .$file;
        if( file_exists($fileRoute)) {
            rename($fileRoute, $fileRoute . ".back");
        }
        file_put_contents($fileRoute, $template);
    }

}
