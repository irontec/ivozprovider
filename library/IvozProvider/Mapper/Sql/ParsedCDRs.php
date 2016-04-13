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
 * Data Mapper implementation for IvozProvider\Model\ParsedCDRs
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 */
namespace IvozProvider\Mapper\Sql;
class ParsedCDRs extends Raw\ParsedCDRs
{

    #    USER-USER: Llama un usuario y acaba hablando con otro usuario
    #    USER-PBX: Llama un usuario y la llamada muere en el AS
    #    USER-PSTN: Llama un usuario a un numero de la PSTN
    #    USER->PSTN: Llama un usuario a otro usuario y acaba hablando con un numero de la PSTN (desvio)
    #    PSTN-USER: Llamada externa entrante que acaba en un usuario
    #    PSTN-PBX: Llamada externa entrante que acaba en el AS
    #    PSTN->PSTN: Llamada externa entrante que acaba desviandose a un numero de la PSTN (desvio)

    protected $_tarificableTypes = array(
            "USER-PSTN",
            "USER->PSTN",
            "PSTN->PSTN"
    );

    public function fetchTarificableList(array $where = array(), $order = null, $limit = null, $offset = null)
    {

        $where[] = "type IN ('".implode("', '", $this->_tarificableTypes)."')";
        return $this->fetchList(implode(" AND ", $where), $order, $limit, $offset);
    }

    public function countTarificableByQuery(array $where = array())
    {

        $where[] = "type IN ('".implode("', '", $this->_tarificableTypes)."')";
        return $this->countByQuery(implode(" AND ", $where));
    }

    public function getTarificableTypes()
    {
        return $this->_tarificableTypes;
    }
}
