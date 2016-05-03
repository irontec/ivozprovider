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
                // Format context name
                echo "[company" . $company->getId() . "]\n";
                echo 'exten => _X.,hint,${RT_HINT(${EXTEN},${CONTEXT})}';
                echo "\n\n";
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
