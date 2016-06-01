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
 * Data Mapper implementation for IvozProvider\Model\KamAccCdrs
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 */
namespace IvozProvider\Mapper\Sql;
class KamAccCdrs extends Raw\KamAccCdrs
{
    public function fetchTarificableList(array $where = array(), $order = null, $limit = null, $offset = null)
    {

        $where[] = "peeringContractId IS NOT NULL";
        return $this->fetchList(implode(" AND ", $where), $order, $limit, $offset);
    }

    public function countTarificableByQuery(array $where = array())
    {

        $where[] = "peeringContractId IS NOT NULL";
        return $this->countByQuery(implode(" AND ", $where));
    }
}
