<?php

/**
 * Application Model
 *
 * @package IvozProvider\Model
 * @subpackage Model
 * @author Luis Felipe Garcia
 * @copyright ZF model generator
 * @license http://framework.zend.com/license/new-bsd     New BSD License
 */

/**
 * [entity]
 *
 * @package IvozProvider\Model
 * @subpackage Model
 * @author Luis Felipe Garcia
 */

namespace IvozProvider\Model;
class Users extends Raw\Users
{
    /**
     * This method is called just after parent's constructor
     */
    public function init()
    {
    }

    /**
     * Gets dependent Extensions_ibfk_2
     *
     * @param string or array $where
     * @return array The array of \IvozProvider\Model\Raw\Extensions
     *
     public function getExtension($where = null)
     {
     $extensions = $this->getExtensions($where, null, null);
     return array_shift($extensions);
     }

     /**
     * @return string or null
     */
    public function getUserTerminalInterface()
    {
        $terminal = $this->getTerminal();
        if (empty($terminal)) {
            return null;
        }
        return $terminal->getName();

    }

    /**
     * return associated endpoint with the user
     *
     * @return \IvozProvider\Model\Raw\AstPsEndpoints
     */
    public function getEndpoint()
    {
        $terminal = $this->getTerminal();
        if (!$terminal) return null;

        // $terminal->getAstPsEndpoints(); SIMPLY NOT WORKING :\
        $endpointMapper = new \IvozProvider\Mapper\Sql\AstPsEndpoints();
        $endpoint = $endpointMapper->findOneByField("terminalId", $terminal->getId());
        return $endpoint;
    }

    /**
     * Update this user endpoint with current model data
     */
    public function updateEndpoint()
    {
        // Update the endpoint
        $endpoint = $this->getEndpoint();
        if ($endpoint) {
            $endpoint->setPickupGroup($this->getPickUpGroupsIds())
                ->setCallerid(sprintf("%s <%s>", $this->getFullName(), $this->getExtensionNumber()))
                ->setMailboxes($this->getVoiceMail())
                ->save();
        }
    }

    /**
     * @return string with the voicemail
     */
    public function getVoiceMail()
    {
        if (!is_null($this->getVoiceMailUser())) {
            return $this->getVoiceMailUser() . '@' . $this->getVoiceMailContext();
        } else {
            return "";
        }
    }

    /**
     * @return string with the voicemail user
     */
    public function getVoiceMailUser()
    {
        $exten = $this->getExtensionNumber();
        if (!empty($exten)) {
            return $exten;
        } else {
            return "";
        }
    }

    /**
     * @return string with the voicemail context
     */
    public function getVoiceMailContext()
    {
        return 'company' . $this->getCompany()->getId();
    }

    /**
     * @return string
     */
    public function getOutgoingDDINumber($valueIfEmpty = "anonimo")
    {
        $DDI = $this->getOutgoingDDI();
        if ($DDI) {
            return $DDI->getDDIE164();
        }
        return $valueIfEmpty;
    }

    /**
     * @return string
     */
    public function getExtensionNumber()
    {
        $extension = $this->getExtension();
        if ($extension) {
            return $extension->getNumber();
        }
        return "";
    }

    /**
     * @return string or null
     */
    public function getDomain()
    {
        $compnies = $this->getCompany();
        if (!$compnies) {
            return null;
        }
        $brand = $compnies->getBrand();
        if (!$brand) {
            return null;
        }
        return $brand->getDomain();
    }

    /**
     * @param string $exten
     * @return bool canCall
     */
    public function hasSrcUserPerm($exten)
    {
        $callAcl = $this->getCallACL();
        if (empty($callAcl)) {
            return true;
        }
        return $callAcl->dstIsCallable($exten);
    }

    public function getPickUpGroups()
    {
        $pickUpGroups = array();
        $pickUpRelUsers = $this->getPickUpRelUsers();
        if (!empty($pickUpRelUsers)) {
            foreach ($pickUpRelUsers as $key => $pickUpRelUser) {
                $pickUpGroups[$key] = $pickUpRelUser->getPickUpGroup();
            }
        }
        return $pickUpGroups;
    }

    public function getPickUpGroupsIds()
    {
        $pickUpGroupIds = array();
        $pickUpRelUsers = $this->getPickUpRelUsers();
        if (!empty($pickUpRelUsers)) {
            foreach ($pickUpRelUsers as $pickUpRel) {
                array_push($pickUpGroupIds, $pickUpRel->getPickUpGroupId());
            }
        }
        return join(',', $pickUpGroupIds);
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        $fullName = $this->getName() . ' ' . $this->getLastname();
        return $fullName;
    }

    public function toArrayPortalForm()
    {

        $model = array();

        $model['id'] = $this->getId();
        $model['name'] = $this->getFullName();

        return $model;

    }

    public function canBeCalled()
    {
        // Check if user is valid to be called
        if (! $this->getActive()) {
            return false;
        }

        // Check if user has terminal configured
        if (empty($this->getTerminal())) {
            return false;
        }

        // Check if user has extension configured
        if (empty($this->getExtension())) {
            return false;
        }

        // Looks like a complete user
        return true;
    }

    public function getLanguageCode()
    {
        $language = $this->getLanguage();
        if (!$language) {
            return $this->getCompany()->getLanguageCode();
        }
        return $language->getIden();
    }

    public function getCountry($where = null, $orderBy = null, $avoidLoading = false)
    {
        $country = parent::getCountry($where, $orderBy, $avoidLoading);
        if (is_null($country)) {
            return $this->getCompany()->getCountries();
        }
        return $country;
    }

    /**
     * Convert a user dialed number to E164 form
     *
     * param string $number
     * return string number in E164
     */
    public function preferredToE164($number)
    {
        // Get company Data
        $callingCode = $this->getCountry()->getCallingCode();
        $outboundPrefix = $this->getCompany()->getOutboundPrefix();

        // Remove company outbound prefix
        $number = preg_replace("/^$outboundPrefix/", "", $number);

        // Remove international code
        $number = preg_replace("/^00/", "", $number, 1, $found);

        // No international code found
        if (! $found) {
            // Append user Calling code
            $callingCode =  $this->getCountry()->getCallingCode();
            $number = $callingCode . $number;
        }

        return $number;
    }

    /**
     * Convert a received number to User prefered format
     *
     * @param unknown $number
     */
    public function E164ToPreferred($number)
    {
        // Get company Data
        $callingCode = $this->getCountry()->getCallingCode();

        // Remove Calling code If matches the user one
        $number = preg_replace("/^$callingCode/", "", $number, 1, $count);

        // Or prefix with international code
        if (!$count) {
            $number = "00" . $number;
        }

        // Add Company outbound prefix
        $number = $this->getCompany()->getOutboundPrefix() . $number;


        return $number;
    }
}
