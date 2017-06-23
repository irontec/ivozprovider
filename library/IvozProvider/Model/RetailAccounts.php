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
 * [entity][rest]
 *
 * @package IvozProvider\Model
 * @subpackage Model
 * @author Luis Felipe Garcia
 */
 
namespace IvozProvider\Model;
class RetailAccounts extends Raw\RetailAccounts
{
    /**
     * This method is called just after parent's constructor
     */
    public function init()
    {
    }

    public function getContact()
    {
        return sprintf("sip:%s@%s",
            $this->getName(),
            $this->getDomain());
    }

    public function getSorcery()
    {
        return sprintf("b%dc%dr%d_%s",
                        $this->getCompany()->getBrandId(),
                        $this->getCompanyId(),
                        $this->getId(),
                        $this->getName());
    }

    /**
     * @brief Return Retail Account country or company if null
     */
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
    public function preferredToE164($prefnumber)
    {
        // Remove company outbound prefix
        $prefnumber = $this->getCompany()->removeOutboundPrefix($prefnumber);
        // Get user country
        $country = $this->getCountry();
        // Return e164 number dialed by this user
        return $country->preferredToE164($prefnumber, $this->getAreaCode());
    }

    /**
     * Convert a received number to User prefered format
     *
     * @param unknown $number
     */
    public function E164ToPreferred($e164number)
    {
        // Get User country
        $country = $this->getCountry();
        // Convert from E164 to user country preferred format
        $prefnumber = $country->E164ToPreferred($e164number, $this->getAreaCode());
        // Add Company outbound prefix
        return $this->getCompany()->addOutboundPrefix($prefnumber);
    }

    /**
     * Obtain content for X-Info-Retail header
     *
     * @param called $number
     */
    public function getRequestUri($callee)
    {
        if ($this->getDirectConnectivity() == 'yes') {
            return $this->getRequestDirectUri($callee);
        } else {
            // Only Kamailio knows this!
            return 'dynamic';
        }
    }

    public function getRequestDirectUri($callee)
    {
        $uri = sprintf("sip:%s@%s", $callee, $this->getIp());

        // Check if the configured port is not the standard (5060)
        $port = $this->getPort();
        if (!is_null($port) && $port != 5060) {
            $uri .= ":$port";
        }

        // Check if the configured transport is not the standard (UDP)
        $transport = $this->getTransport();
        if ($transport != 'udp') {
            $uri .= ";transport=$tranport";
        }

        return $uri;
    }

    public function getAstPsEndpoint()
    {
        $endpointMapper = new \IvozProvider\Mapper\Sql\AstPsEndpoints();
        return $endpointMapper->findOneByField("retailAccountId", $this->getId());
    }

    public function getLanguageCode()
    {
        $language = $this->getLanguage();
        if (!$language) {
            return $this->getCompany()->getLanguageCode();
        }
        return $language->getIden();
    }

    /**
     * Get Retail Account outgoingDDI
     * If no DDI is assigned, retrieve company's default DDI
     * @return \IvozProvider\Model\Raw\DDIs or NULL
     */
    public function getOutgoingDDI($where = null, $orderBy = null, $avoidLoading = false)
    {
        $ddi = parent::getOutgoingDDI($where, $orderBy, $avoidLoading);
        if (empty($ddi)) {
            $ddi = $this->getCompany()->getOutgoingDDI($where, $orderBy, $avoidLoading);
        }
        return $ddi;
    }

    /**
     * Get DDI associated with this retail Account
     *
     * @return \IvozProvider\Model\Raw\DDIs or NULL
     */
    public function getDDI($ddieE164)
    {
        $ddis = $this->getDDIs("DDIE164='" . $ddieE164 . "'");
        return array_shift($ddis);
    }


}
