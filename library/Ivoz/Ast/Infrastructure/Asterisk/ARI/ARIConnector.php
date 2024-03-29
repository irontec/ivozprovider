<?php

namespace Ivoz\Ast\Infrastructure\Asterisk\ARI;

use Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServer;
use Ivoz\Provider\Domain\Model\ApplicationServer\ApplicationServerRepository;
use Ivoz\Provider\Domain\Model\FaxesInOut\FaxesInOutInterface;
use Psr\Log\LoggerInterface;

/**
 * @brief Wrapper around Application servers ARI requests
 *
 * @package Asterisk
 * @subpackage ARI
 * @author Ivan Alonso [kaian] <kaian@irontec.com>
 */
class ARIConnector
{
    /**
     * Exceptions thrown
     */
    public const NO_SERVERS_AVAILABLE_EXCEPTION = 9001;

    /**
     * Connection information
     */
    /** @var int */
    protected $_port;
    /** @var string */
    protected $_user;
    /** @var string */
    protected $_pass;
    /** @var LoggerInterface */
    protected $_logger;

    /**
     * @var ApplicationServerRepository
     */
    protected $applicationServerRepository;

    /**
     * Creates a new instance of Asterisk Rest Interface Connector
     * @param string $userName
     * @param string $password
     * @param int $port
     */
    public function __construct(
        ApplicationServerRepository $applicationServerRepository,
        LoggerInterface $logger,
        $userName,
        $password,
        $port
    ) {
        $this->applicationServerRepository = $applicationServerRepository;
        $this->_logger = $logger;

        $this->_user = $userName;
        $this->_pass = $password;
        $this->_port = $port;
    }

    /**
     * Initialize connection handler options that can be used for multiple
     * further requests.
     *
     * @return \CurlHandle cURL handler on success, FALSE otherwise
     */
    private function _createConnectionHandler()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_USERPWD, $this->_user . ":" . $this->_pass);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));

        return $ch;
    }

    /**
     * Makes a POST request to the given URL using a previously initialized cURL
     * handler. In case of error, curl_error can be used to retrieve a
     * descriptive problem text.
     *
     * @param \CurlHandle $ch cURL handler previusly initializated
     * @param string $url HTTP URL
     * @param array $postdata key/value array to be converted into JSON POST body
     * @return string|bool true on success or false on failure. However, if the CURLOPT_RETURNTRANSFER
     * option is set, it will return the result on success, false on failure.
     */
    private function _post($ch, $url, array $postdata)
    {
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postdata, JSON_THROW_ON_ERROR));
        curl_setopt($ch, CURLOPT_URL, $url);
        return curl_exec($ch);
    }

    /**
     * Makes a PUT request to the given URL using a previously initialized cURL
     * handler. In case of error, curl_error can be used to retrieve a
     * descriptive problem text.
     *
     * @param \CurlHandle $ch cURL handler previusly initializated
     * @param string $url HTTP URL
     * @param array $postdata key/value array to be converted into JSON POST body
     * @return string|bool true on success or false on failure. However, if the CURLOPT_RETURNTRANSFER
     * option is set, it will return the result on success, false on failure.
     */
    private function _put($ch, $url, array $postdata)
    {
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postdata, JSON_THROW_ON_ERROR));
        curl_setopt($ch, CURLOPT_URL, $url);
        return curl_exec($ch);
    }

    /**
     * Sends an ARI request to existing Applications Servers to request sending
     * a Fax file to external number configured in the faxfile Destination.
     *
     * @param FaxesInOutInterface $faxFile
     *
     * @throws \Exception if no Application Server is available
     *
     * @return void
     */
    public function sendFaxfileRequest(FaxesInOutInterface $faxFile)
    {
        $applicationServers = $this->applicationServerRepository->findAll();

        // Try sending the request to all existing Application Servers secuentially
        /**
         * @var ApplicationServer $as
         */
        foreach ($applicationServers as $as) {
            $destination = $faxFile->getDst();
            $asAddress = $as->getIp();
            $company = $faxFile
                ->getFax()
                ->getCompany();

            // Get a new connection handler for this application server
            $ch = $this->_createConnectionHandler();

            // Setup POST body content
            $post = array(
                    'endpoint'  => "Local/$destination@faxes",
                    'context'   => 'faxes-send',
                    'extension' => $destination,
                    'variables' => array(
                            '__LOGTAG'    => 'b' . $company->getBrand()->getId(),
                            '__CID_HASH'  => 'faxout' . $faxFile->getId(),
                            '__FAXFILE_ID' => (string) $faxFile->getId(),
                    )
            );

            // Get Application server restAPI URL
            $url = 'http://' . $asAddress . ':' . $this->_port . '/ari/channels';
            $this->_logger->info("Sending ARI Request to $url...");

            // Request a new call
            $response = $this->_post($ch, $url, $post);
            if ($response !== false) {
                $this->_logger->info("Request successfully enqueued to $url");

                return;
            }

            // Error sending request, try next Application server
            $this->_logger->error("Error sending fax to $url:" . curl_error($ch));
        }

        // No Application Server handled our request
        throw new \DomainException(
            'No Application Server available.',
            self::NO_SERVERS_AVAILABLE_EXCEPTION
        );
    }

    /**
     * Sends an ARI request to all Applications Servers to request dialplan reloading
     *
     * @return void
     */
    public function sendDialplanReloadRequest()
    {
        $this->_logger->info("Sending Dialplan reload request to all application servers.");

        $applicationServers = $this->applicationServerRepository->findAll();

        /** @var ApplicationServer $as */
        foreach ($applicationServers as $as) {
            $asAddress = $as->getIp();

            // Get a new connection handler for this application server
            $ch = $this->_createConnectionHandler();

            // Get Application server restAPI URL
            $url = 'http://' . $asAddress . ':' . $this->_port . '/ari/asterisk/modules/pbx_config.so';
            $this->_logger->info("Sending ARI Request to $url");

            // Request reload
            $response = $this->_put($ch, $url, []);

            if ($response === false || curl_getinfo($ch, CURLINFO_HTTP_CODE) !== 204) {
                $this->_logger->error("Error realoading $as dialplan:" . curl_error($ch));
            }
        }
    }

    /**
     * Sends an ARI request to all Applications Servers to update device state
     *
     * @return void
     */
    public function sendHintUpdateRequest(string $deviceName, string $deviceState)
    {
        $this->_logger->info("Sending request to set $deviceName to $deviceState state");

        $applicationServers = $this->applicationServerRepository->findAll();

        /** @var ApplicationServer $as */
        foreach ($applicationServers as $as) {
            $asAddress = $as->getIp();

            // Get a new connection handler for this application server
            $ch = $this->_createConnectionHandler();

            // Get Application server restAPI URL
            $url = sprintf(
                "http://%s:%d/ari/deviceStates/%s?deviceState=%s",
                $asAddress,
                $this->_port,
                $deviceName,
                $deviceState,
            );
            $this->_logger->info("Sending ARI Request to $url");

            // Request reload
            $response = $this->_put($ch, $url, []);

            if ($response !== false) {
                $this->_logger->info("Request successfully enqueued to $url");
                continue;
            }

            // Error sending request
            $this->_logger->error("Error setting hint state to $url:" . curl_error($ch));
        }
    }
}
