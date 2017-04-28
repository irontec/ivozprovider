<?php

/**
 * @author luis
 *
 */
class Ami_Connector
{

    /**
     * @var string
     */
    protected $_host;

    /**
     * @var string
     */
    protected $_port;

    /**
     * @var string
     */
    protected $_user;

    /**
     * @var string
     */
    protected $_pass;

    /**
     * @var resource
     */
    protected $_socket = null;

    /**
     * @var boolean
     */
    protected $_loggedIn = false;

    /**
     * @var Zend_Log
     */
    protected $_logger;

    /**
     * @var string
     */
    protected $_buffer = "";

    /**
     * @var string
     */
    protected $_in = null;

    /**
     * @var string
     */
    protected $_headers = array();

    /**
     * @var string
     */
    protected $_lastError;

    /**
     *
     * Creates a new instance of Asterisk Manager Interface Connector
     *
     * @param string $host[optional]
     * <p>Ip of the host to connect to</p>
     * @param string $port[optional]
     * <p>Port to use in the connection</p>
     * @param string $user[optional]
     * <p>Username to use in the logging in</p>
     * @param string $pass[optional]
     * <p>Password to use in the logging in</p>
     * @param string $logger[optional]
     * <p>Logger to use. It must be an instance of Zend_Log
     * @throws \Exception <p>
     * Throws an exception if the logger is not an instance of Zend_Log</p>
     */
    public function __construct($host = null, $port = null, $user = null, $pass = null, $logger = null)
    {

        $this->_host = $host;
        $this->_port = $port;
        $this->_user = $user;
        $this->_pass = $pass;

        $this->_logger = $logger;
        if (is_null($this->_logger)) {
            $params = array(
                    array(
                            'writerName' => 'Null'
                    )
            );
            $this->_logger = \Zend_Log::factory($params);
        }
        if (!$this->_logger instanceof \Zend_Log) {
            throw new \Exception("Logger must be an instance of Zend_Log");
        }


    }

    /**
     * Connects to de server and creates a socket
     *
     * @return string|boolean
     * <p>Returns server response to connection if success or false if error.</p>
     * <p>You can get last error with getLastError().</p>
     */
    public function connect()
    {

        if (is_null($this->_host) || is_null($this->_port) || is_null($this->_user) || is_null($this->_pass)) {
            $this->_log("You have to set host, port, user and password.", \Zend_Log::ERR);
            return false;
        }

        $this->_log("Connecting to ".$this->_host.":".$this->_port, \Zend_Log::INFO);
        $this->_socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        if ($this->_socket === false) {
            $this->_log("Error creatting socket. Error was: ".$this->_getError() , \Zend_Log::ERR);
            return false;
        }
        $result = socket_connect($this->_socket, $this->_host, $this->_port);
        if ($result === false) {
            $this->_log("Error connecting. Error was: ".$this->_getError(), \Zend_Log::ERR);
            return false;
        }
        $this->_log("Connected.", \Zend_Log::INFO);
        return $this->_parseMessage(socket_read($this->_socket, 2048));

    }

    /**
     * Logs in the server
     *
     * @return string|boolean
     * <p>Returns server response to logging in if success or false if error.</p>
     * <p>You can get last error with getLastError().</p>
     */
    public function login()
    {

        if (is_null($this->_socket)) {
            $this->_log("You are not connected.", \Zend_Log::INFO);
            if ($this->connect() === false) {
                return false;
            }
        }

        $this->_log("Logging in to ".$this->_host.":".$this->_port, \Zend_Log::INFO);
        $headers = array(
                "Action" => "Login",
                "username" => $this->_user,
                "secret" => $this->_pass,
                "Events" => "off"
            );

        $in = $this->_generateMessage($headers);

        if ($in === false) {
            return false;
        }

        $result = socket_write($this->_socket, $in, strlen($in));
        if ($result === false) {
            $this->_log("Error logging in. Error was: ".$this->_getError(), \Zend_Log::ERR);
            return false;
        }

        $this->_loggedIn = true;
        $response = $this->read();
        $this->_loggedIn = false;

        if (!$this->_success($response)) {
            $this->_log("Error logging in. Response was: ".$response["rawResponse"], \Zend_Log::ERR);
            return false;
        }

        $this->_loggedIn = true;
        $this->_log("Logged in", \Zend_Log::INFO);
        return $response;

    }

    /**
     * Sends message to the server
     *
     * @param string|array $in[optional]
     * <p>Message to be sent</p>
     * <p>In can be a key => value array or a string</p>
     * <p>If set, this will be sent, if not it will check if headers are set</p>
     * @param string $closeSocket[optional]
     * <p>Either you want to close connection after sending (true) or not (false).</p>
     * <p>Default false</p>
     * @return boolean|string
     * <p> Return server response if success or false if error.</p>
     * <p>You can get last error with getLastError().</p>
     */
    public function send($in = null, $closeSocket = true)
    {

        if (!$this->_loggedIn) {
            $this->_log("You are not logged in.", \Zend_Log::INFO);
            $logged = $this->login();
            if (!$logged) {
                return false;
            }
        }

        if (!empty($this->_headers)) {
            $this->_in = $this->_headers;
        }

        if (!is_null($in)) {
            $this->_in = $in;
        }

        if (is_null($this->_in)) {
            $this->_log("Can't send message. You have to set the message first.", \Zend_Log::ERR);
            return false;
        }

        $message = $this->_generateMessage($this->_in);

        if ($message === false) {
            return false;
        }

        $result = socket_write($this->_socket, $message, strlen($message));
        if ($result === false) {
            $this->_log("Error sending message. Error was: ".$this->_getError() , \Zend_Log::ERR);
            if ($closeSocket) {
                $this->close();
            }
            return false;
        }

        $response = $this->read();

        $this->_log("Message '".$message."' was sent.", \Zend_Log::INFO);
        $this->_log("Response was: '".$response["rawResponse"]."'", \Zend_Log::INFO);

        if ($closeSocket) {
            $this->close();
        }
        return $response;
    }

    /**
     * Closes connection
     */
    public function close()
    {

        if (is_null($this->_socket)) {
            $this->_log("You cant close connection. There is no connection.", \Zend_Log::ERR);
            return false;
        }

        if ($this->logoff() === false) {
            socket_close($this->_socket);
            $this->_socket = null;
        }
        $this->_log("Connection closed.", \Zend_Log::INFO);

    }

    public function logoff()
    {
        if ($this->_loggedIn === false) {
            $this->_log("You can't log off. You are not logged in.", \Zend_Log::ERR);
            return false;
        }
        $headers = array(
                "Action" => "Logoff"
        );

        $response = $this->send($headers, false);

        if ($response === false) {
            $this->_log("Error logging off", \Zend_Log::ERR);
            return false;
        }

        $this->_loggedIn = false;
        $this->_socket = null;
        return $response;
    }

    /**
     * Gets last error in a formatted way
     *
     * @return string
     * <p>Returns last error in the format of "(code) error message"</p>
     */
    protected function _getError()
    {

        $errorCode = socket_last_error($this->_socket);
        $errorMessage = socket_strerror($errorCode);
        $error = "(".$errorCode.") ".$errorMessage;
        return $error;

    }

    /**
     *
     * Reads server message
     *
     * @param number $microSecondsTimeout[optional]
     * @return string|false
     * <p>Returns the server message</p>
     */
    public function read($microSecondsTimeout = 500000)
    {

        if (!$this->_loggedIn) {
            $this->_log("You are not logged in. Logging in.", \Zend_Log::INFO);
            $logged = $this->login();
            if ($logged === false) {
                return false;
            }
        }

        $microSecondsToSleep = 5000;
        $continueReading = true;
        if ($microSecondsTimeout <= 0) {
            $continueReading = false;
        }

        socket_set_nonblock($this->_socket);
        while ($continueReading) {
            if ($microSecondsTimeout <= 0) {
                $message = "Error reading socket: timeout";
                $this->_log($message, \Zend_Log::ERR);
                break;
            }
            $microSecondsTimeout -= $microSecondsToSleep;

            $buf = socket_read($this->_socket, 2048);
            $this->_buffer .= $buf;
            $bufferParts = explode("\r\n\r\n", $this->_buffer);
            if (count($bufferParts) == 2) {
                $message = $bufferParts[0];
                $this->_buffer = $bufferParts[1];
                $continueReading = false;
            }
            usleep($microSecondsToSleep);
        }
        socket_set_block($this->_socket);

        return $this->_parseMessage($message);

    }

    /**
     *
     * Parse server response to array
     *
     * @param string $response
     * <p>Server response</p>
     * @return array
     * <p>Returns a key value array with the response.</p>
     * <p>"rawResponse" key has the $response as is.</p>
     */
    protected function _parseMessage($message)
    {

        $parsedResponse = array(
                "rawResponse" => $message
        );

        $messageParts = explode("\r\n", $message);
        if (count($messageParts) == 1) {
            $messagePartse = explode("\n", $message);
        }
        $n = 1;
        foreach ($messageParts as $value) {
            $valueParts = explode(":", $value);
            if (count($valueParts) == 2) {
                $parsedResponse[trim($valueParts[0])] = trim($valueParts[1]);
            } else {
                $headerName = "Undefined-".$n;
                $parsedResponse[$headerName] = $value;
                $n++;
            }
        }

        return $parsedResponse;
    }

    /**
     *
     * Checks if parsed response has "Response" => "Success"
     *
     * @param array $response
     * <p>Parsed response</p>
     * @return boolean
     * <p>Return true if has "Response" => "Success" or false if any else</p>
     */
    protected function _success($response)
    {
        if (!isset($response["Response"])) {
            return false;
        }

        if ($response["Response"] == "Success") {
            return true;
        }

        return false;
    }

    /**
     *
     * Sets server ip
     *
     * @param string $host
     * @return Ami_Connector
     */
    public function setHost ($host)
    {
        $this->_host = $host;
        return $this;
    }

    /**
     * Sets server port
     *
     * @param string $port
     * @return Ami_Connector
     */
    public function setPort ($port)
    {
        $this->_port = $port;
        return $this;
    }

    /**
     *
     * Sets user name for logging in
     *
     * @param string $user
     * @return Ami_Connector
     */
    public function setUser ($user)
    {
        $this->_user = $user;
        return $this;
    }

    /**
     *
     * Sets password for logging in
     *
     * @param string $pass
     * @return Ami_Connector
     */
    public function setPassword ($pass)
    {
        $this->_pass = $pass;
        return $this;
    }

    /**
     *
     * <p>Ads Header to the message to be sent.</p>
     * <p>It will be formatted as:</p>
     * <p>Header: Value</p>
     *
     * @param string $header
     * @param string $value
     * @return Ami_Connector
     */
    public function addHeader($header, $value)
    {
        $this->_headers[$header] = $value;
        return $this;
    }

    /**
     *
     * <p>Sets the Headers to be sent</p>
     * <p>These Headers will generate the message</p>
     *
     * @param array $headers
     * <p>Key => Value array will be formatted as string:</p>
     * <p>    Key1: Value1\r\n</br>
     *        Key2: Value2\r\n</br>
     *        \r\n</p>
     * @return Ami_Connector
     */
    public function setHeaders (array $headers)
    {
        $this->_headers = $headers;
        return $this;
    }

    /**
     *
     * Restes the Headers.
     *
     * @return Ami_Connector
     */
    public function resetHeaders ()
    {
        $this->_in = null;
        $this->_headers = array();
        return $this;
    }


    /**
     *
     * Returns las error.
     *
     * @return string
     */
    public function getLastError()
    {
        $lastError = $this->_lastError;
        $this->_lastError = "";
        return $lastError;
    }

    /**
     *
     * Set Logger to use
     *
     * @param Zend_Log $logger
     * @throws \Exception
     * @return Ami_Connector
     */
    public function setLogger($logger)
    {
        if (!$logger instanceof \Zend_Log) {
            throw new \Exception("Logger must be an instance of Zend_Log");
        }
        $this->_logger = $logger;
        return $this;
    }

    /**
     *
     * Logs message to registered logger.
     *
     * @param string $message
     * @param int $priority
     */
    protected function _log($message, $priority)
    {
        if ($priority <= \Zend_Log::ERR) {
            $this->_lastError = $message;
        }
        $this->_logger->log("[AMIC] ".$message , $priority);
    }

    protected function _generateMessage($headers)
    {
        if (is_array($headers)) {
            $message = "";
            foreach ($headers as $header => $value) {
                $message .= $header.": ".$value."\r\n";
            }
            $message .= "\r\n";

            return $message;
        }

        if (is_string($headers)) {
            $headers = rtrim($headers);
            return $headers."\r\n\r\n";
        }

        $this->_log("Unkown format of message.", \Zend_Log::ERR);

        return false;
    }
}