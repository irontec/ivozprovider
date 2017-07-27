<?php

class IvozProvider_Klear_Ghost_RegisterStatus extends KlearMatrix_Model_Field_Ghost_Abstract
{
    /**
     * Get Register Status for Terminals
     * @param $model Terminal
     * @return HTML code to display SIP registrer status
     */
    public function getTerminalStatus ($model)
    {
        return $this->getLocationStatus($model);
    }

    /**
     * Get Register Status for Friends
     * @param $model Friend
     * @return HTML code to display SIP registrer status
     */
    public function getFriendStatus ($model)
    {
        $registerStatus = $this->getDirectConnectivityStatus($model);
        if (empty($registerStatus)) {
            $registerStatus = $this->getLocationStatus($model);
        }
        return $registerStatus;
    }

    /**
     * Get Register Status for Retail Accounts
     * @param $model RetailAccount
     * @return HTML code to display SIP registrer status
     */
    public function getRetailAccountStatus ($model)
    {
        $registerStatus = $this->getDirectConnectivityStatus($model);
        if (empty($registerStatus)) {
            $registerStatus = $this->getLocationStatus($model);
        }
        return $registerStatus;
    }

    /**
     * Check if entity has direct connectivity enabled
     * @param $model Friend or Retail Account
     * @return HTML code to display SIP registrer status or empty string
     */
    private function getDirectConnectivityStatus($model)
    {
        // No Dynamic Status
        if ($model->getDirectConnectivity() === 'yes') {
            return '<span class="ui-silk inline ui-silk-arrow-right" title="Direct connectivity"></span>';
        }
        return "";
    }

    /**
     * Get Register Status from UsersLocation Table
     * @param $model Terminal, Friend or Retail Account
     * @return HTML code to display SIP registrer status
     */
    private function getLocationStatus ($model)
    {
        $where = array(
            "username = '" . $model->getName() . "'",
            "domain = '" . $model->getDomain() . "'"
        );

        // Try to find registry entry
        $locationMapper = new \IvozProvider\Mapper\Sql\KamUsersLocation;
        $location = $locationMapper->fetchOne(implode(' AND ', $where), "expires DESC");

        // Draw a green tick if found
        if (!is_null($location)) {
            return '<span class="ui-silk inline ui-silk-tick" title="Registered until ' . $location->getExpires() . '"></span>';
        }

        // Draw a red cross if not found
        return '<span class="ui-silk inline ui-silk-exclamation"></span>';
    }
}
