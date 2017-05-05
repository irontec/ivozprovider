<?php
namespace Asterisk\ARI;

/**
 * @brief Wrapper around Application servers ARI requests
 *
 * @package Asterisk
 * @subpackage ARI
 * @author Ivan Alonso [kaian] <kaian@irontec.com>
 */
class Connector
{
    /**
     * Exceptions thrown
     */
    const NO_SERVERS_AVAILABLE_EXCEPTION = 9001;

    /**
     * Connection information
     */
    protected $_host;
    protected $_port;
    protected $_user;
    protected $_pass;

    /**
     * @var Zend_Log
     */
    protected $_logger;

    /**
     * Creates a new instance of Asterisk Rest Interface Connector
     */
    public function __construct()
    {
        $params = array(array('writerName' => 'Null'));
        $this->_logger = \Zend_Log::factory($params);

        // Get Asterisk credetentials from application configuration
        $bootstrap = \Zend_Controller_Front::getInstance()->getParam('bootstrap');
        if (is_null($bootstrap)) {
            $conf = new \Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini', APPLICATION_ENV);
            $config = (Object) $conf->toArray();
        } else {
            $config = (Object) $bootstrap->getOptions();
        }

        $this->_user = $config->ari["userName"];
        $this->_pass = $config->ari["password"];
        $this->_port = $config->ari["port"];
    }

    /**
     * Initialize connection handler options that can be used for multiple
     * further requests.
     *
     * @return cURL handler on success, FALSE otherwise
     */
    private function _createConnectionHandler()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_USERPWD, $this->_user . ":" . $this->_pass);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
        return $ch;
    }

    /**
     * Makes a POST request to the given URL using a previously initialized cURL
     * handler. In case of error, curl_error can be used to retrieve a
     * descriptive problem text.
     *
     * @param resource $ch cURL handler previusly initializated
     * @param string $url HTTP URL
     * @param array $postdata key/value array to be converted into JSON POST body
     * @return TRUE on success, FALSE otherwise
     */
    private function _post($ch, $url, $postdata)
    {
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postdata));
        curl_setopt($ch, CURLOPT_URL, $url);
        return curl_exec($ch);
    }

    /**
     * Sends an ARI request to existing Applications Servers to request sending
     * a Fax file to external number configured in the faxfile Destination.
     *
     * @param \IvozProvider\Model\Raw\FaxesInOut $faxfile
     * @throws \Exception if no Application Server is available
     */
    public function sendFaxfileRequest(\IvozProvider\Model\Raw\FaxesInOut $faxfile)
    {
        $applicationServersMapper = new \IvozProvider\Mapper\Sql\ApplicationServers();
        $applicationServer = $applicationServersMapper->fetchList();

        // Try sending the request to all existing Application Servers secuentially
        foreach ($applicationServer as $as) {
            $destination = $faxfile->getDst();
            $asAddress = $as->getIp();
            $company = $faxfile->getFax()->getCompany();

            // Get a new connection handler for this application server
            $ch = $this->_createConnectionHandler();

            // Setup POST body content
            $post = array(
                    "endpoint"  => "Local/$destination@faxes",
                    "context"   => "faxes-send",
                    "extension" => $destination,
                    "variables" => array(
                            "__LOGTAG"    => "b" . $company->getBrandId(),
                            "__CID_HASH"  => "faxout" . $faxfile->getId(),
                            "__FAXFILE_ID" => (string) $faxfile->getId(),
                    )
            );

            // Get Application server restAPI URL
            $url = "http://" . $asAddress . ":" . $this->_port . "/ari/channels";
            $this->_logger->log("Sending ARI Request to $url...", \Zend_Log::INFO);

            // Reques a new call
            $response = $this->_post($ch, $url, $post);
            if ($response !== false) {
                $this->_logger->log("Request successfully enqueued to $url", \Zend_Log::INFO);
                return;
            }

            // Error sending request, try next Application server
            $this->_logger->log("Error sending fax to $url:" . curl_error($ch), \Zend_Log::ERR);
        }

        // No Application Server handled our request
        throw new \Exception("No Application Server available.", self::NO_SERVERS_AVAILABLE_EXCEPTION);

    }
}

