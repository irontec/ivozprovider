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
 * Data Mapper implementation for IvozProvider\Model\AstPsAors
 *
 * @package Mapper
 * @subpackage Sql
 * @author Luis Felipe Garcia
 */
namespace IvozProvider\Mapper\Sql;
class AstPsAors extends Raw\AstPsAors
{
    /**
     * Get endpoint name from a given contact
     *
     * @param string $contact
     */
    public function getSorceryByContact($contact)
    {
        $aor = $this->findOneByField('contact', $contact);
        if ($aor) {
            return $aor->getSorceryId();
        }
        return "";
    }
}
