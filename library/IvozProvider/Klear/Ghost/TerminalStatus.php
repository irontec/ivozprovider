<?php

class IvozProvider_Klear_Ghost_TerminalStatus extends KlearMatrix_Model_Field_Ghost_Abstract
{

    /**
     *
     * @param $model Terminal
     * @return HTML code to display SIP registrer status
     */
    public function getData ($model)
    {
        $where = array(
            "username = '" . $model->getName() . "'",
            "domain = '" . $model->getDomain() . "'"
        );

        // Try to find registry entry for this terminal
        $locationMapper = new \IvozProvider\Mapper\Sql\KamUsersLocation;
        $location = $locationMapper->fetchOne(implode(' AND ', $where), "expires DESC");

        // Draw a green tick if found, or red cross if not
        if (!is_null($location)) {
            return '<span class="ui-silk inline ui-silk-tick" title="Registered until ' . $location->getExpires() . '"></span>';
        } else {
            return '<span class="ui-silk inline ui-silk-exclamation"></span>';
        }
    }
}
