<?php

class IvozProvider_Klear_Ghost_RegisterStatus extends KlearMatrix_Model_Field_Ghost_Abstract
{
    /**
     * Get Register Status for Terminals
     * @param Terminal $model
     * @return string HTML code to display SIP register status icon
     */
    public function getTerminalStatusIcon($model)
    {
        return $this->getLocationStatusIcon($model);
    }

    /**
     * Get Register Status for Terminals
     * @param Terminal $model
     * @return string HTML code to display SIP register status
     */
    public function getTerminalStatus($model)
    {
        return $this->getLocationStatus($model);
    }

    /**
     * Get Register Status for Friends
     * @param Friend $model
     * @return string HTML code to display SIP register status icon
     */
    public function getFriendStatusIcon($model)
    {
        $registerStatus = $this->getDirectConnectivityStatus($model);
        if (empty($registerStatus)) {
            $registerStatus = $this->getLocationStatusIcon($model);
        }
        return $registerStatus;
    }

    /**
     * Get Register Status for Friends
     * @param Friend $model
     * @return string HTML code to display SIP register status
     */
    public function getFriendStatus($model)
    {
        $registerStatus = $this->getDirectConnectivityStatus($model);
        if (empty($registerStatus)) {
            $registerStatus = $this->getLocationStatus($model);
        }
        return $registerStatus;
    }

    /**
     * Get Register Status for Retail Accounts
     * @param RetailAccount $model
     * @return string HTML code to display SIP register status icon
     */
    public function getRetailAccountStatusIcon($model)
    {
        $registerStatus = $this->getDirectConnectivityStatus($model);
        if (empty($registerStatus)) {
            $registerStatus = $this->getLocationStatusIcon($model);
        }
        return $registerStatus;
    }

    /**
     * Get Register Status for Retail Accounts
     * @param RetailAccount $model
     * @return string HTML code to display SIP register status
     */
    public function getRetailAccountStatus($model)
    {
        $registerStatus = $this->getDirectConnectivityStatus($model);
        if (empty($registerStatus)) {
            $registerStatus = $this->getLocationStatus($model);
        }
        return $registerStatus;
    }

    /**
     * Check if entity has direct connectivity enabled
     * @param Friend/RetailAccount $model
     * @return string HTML code to display SIP register status or empty string
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
     * @param Terminal/Friend/RetailAccount $model
     * @return string HTML code to display SIP register status icon
     */
    private function getLocationStatusIcon($model)
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

    /**
     * Get Register Status from UsersLocation Table
     * @param Terminal/Friend/RetailAccount $model
     * @return string HTML code to display SIP register status
     */
    private function getLocationStatus($model)
    {
        $where = array(
            "username = '" . $model->getName() . "'",
            "domain = '" . $model->getDomain() . "'"
        );

        // Find registry entries
        $locationMapper = new \IvozProvider\Mapper\Sql\KamUsersLocation;
        $locations = $locationMapper->fetchList(implode(' AND ', $where), "expires DESC");

        if (!empty($locations)) {
            $registerStatus = '<table width="100%" >';

            foreach ($locations as $location) {
                $registerStatus .= sprintf('
                            <tr>
                                <td><span class="ui-silk inline ui-silk-tick" title="Registered until %s"/> %s </td>
                                <td><span class="ui-silk inline ui-silk-telephone" title="Contact Address" /> %s</td>
                                <td><span class="ui-silk inline ui-silk-world" title="Received Address" /> %s</td>
                            </tr>',
                        $location->getExpires(),
                        $location->getUserAgent(),
                        $location->getContactSrc(),
                        $location->getReceivedSrc()
                );
            }

            $registerStatus .= '</table>';
        } else {
            // Draw a red cross if not active registries found
            $registerStatus = '<span class="ui-silk inline ui-silk-exclamation" /> Not Registered';
        }

        return $registerStatus;
    }
}
