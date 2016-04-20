<?php
require_once ("BaseController.php");
use IvozProvider\Mapper\Sql as Mapper;

/**
 * @brief Dynamic Hints controller
 *
 * This controller will be invoked to generate asterisk hints.
 * A new hint context will be created for each company where a new hint will
 * be defined for each configured user.
 *
 * @package AGI
 * @subpackage HintsController
 * @author Gaizka Elexpe <gelexpe@irontec.com>
 * @author Ivan Alonso [kaian] <kaian@irontec.com>
 */
class HintsController extends BaseController
{

    public function generatehintsAction ()
    {
        try {
            $companiesMapper = new Mapper\Companies();
            $companiesData = $companiesMapper->fetchList();
            foreach ($companiesData as $company) {
                // Inicializamos el array para cada empresa
                $response = array();
                $users = $company->getUsers();
                foreach ($users as $user) {
                    //Recogemos los usuarios de la empresa
                    $shortNumber = NULL;
                    $terminal = $user->getTerminal();
                    if (empty($terminal)) {
                        continue;
                    }
                    $extension = $user->getExtension();
                    if (empty($extension)) {
                        continue;
                    }
                    $response[$extension->getNumber()] = "PJSIP/" . $terminal->getName();
                }
                
                // Format context name
                echo "[company" . $company->getId() . "]\n";
                // Add context hint extensions
                foreach ($response as $exten => $interface) {
                    echo "exten => " . $exten . ",hint," . $interface . "\n";
                }
                echo "\n";
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
