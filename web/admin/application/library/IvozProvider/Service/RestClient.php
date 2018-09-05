<?php

namespace IvozProvider\Service;

class RestClient
{
    const LOGIN_ENDPOINT = '/admin_login';

    const REFRESH_TOKEN_ENDPOINT = '/token/refresh';

    const BILLABLE_CALL_ENDPOINT = '/billable_calls';

    /**
     * @var string
     */
    protected $token;

    /**
     * @var string
     */
    protected $refreshToken;

    public function __construct(
        string $token,
        string $refreshToken
    ) {
        $this->token = $token;
        $this->refreshToken = $refreshToken;
    }

    public static function getAdminToken(
        string $username,
        string $password
    ) {
        $apiUrl = self::getBaseUrl() . self::LOGIN_ENDPOINT;

        $context = self::getBaseStreamContextArguments('POST');
        $context['http'] += [
            'header' => "Accept: application/json\r\n"
                        . "Content-Type: application/x-www-form-urlencoded\r\n",
            'content' => http_build_query([
                'username' => $username,
                'password' => $password
            ])
        ];

        try {
            $response = file_get_contents(
                $apiUrl,
                false,
                stream_context_create($context)
            );

            return json_decode($response);

        } catch (\Exception $e) {
            throw new \DomainException('Unable to get API access token', 0, $e);
        }
    }

    protected static function getBaseUrl()
    {
        return 'https://'
            . $_SERVER['SERVER_NAME']
            . '/api/platform/'
            . basename($_SERVER['SCRIPT_FILENAME']);
    }

    protected static function getBaseStreamContextArguments($method = 'GET')
    {
        return [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false
            ],
            'http' => [
                'timeout' => 60,
                'method' => $method,
                'ignore_errors' => true
            ]
        ];
    }

    public function getBillableCalls(array $where = [])
    {
        $apiEndpoint =
            self::getBaseUrl()
            . self::BILLABLE_CALL_ENDPOINT
            . '?_pagination=false';

        $context = self::getBaseStreamContextArguments();
        $context['http'] += [
            'header' => "Accept: text/csv, text/json\r\n",
            'content' => http_build_query($where)
        ];

        try {
            return $this->request(
                $apiEndpoint,
                $context
            );

        } catch (\Exception $e) {
            throw new \DomainException('Unable to get Billable Calls', 0, $e);
        }
    }

    /**
     * @param string $apiEndpoint
     * @param \resource $context
     * @param bool $retryOnExpiredToken
     * @return string
     * @throws \Exception
     */
    private function request(string $apiEndpoint, array $context, bool $retryOnExpiredToken = true)
    {
        $requestContext = $context;
        $requestContext['http']['header'] .= "authorization: Bearer " . $this->token . "\r\n";

        $requestContext = stream_context_create($requestContext);
        $stream = fopen($apiEndpoint, 'r', false, $requestContext);

        $responseHeaders = stream_get_meta_data($stream);
        $headers = $responseHeaders['wrapper_data'] ?? [];
        $response = stream_get_contents($stream);

        if (strpos($headers[0], '401 Unauthorized') !== false) {

            if (!$retryOnExpiredToken) {
                throw new \Exception('Unauthorized');
            }

            $this->refreshToken();
            return $this->request($apiEndpoint, $context, false);
        }

        return $response;
    }

    private function refreshToken()
    {
        $apiEndpoint = self::getBaseUrl() . self::REFRESH_TOKEN_ENDPOINT;

        $context = self::getBaseStreamContextArguments('POST');
        $context['http'] += [
            'header' => "Accept: application/json\r\n"
                . "Content-Type: application/x-www-form-urlencoded\r\n",
            'content' => http_build_query([
                'refresh_token' => $this->refreshToken
            ])
        ];

        try {
            $response = file_get_contents(
                $apiEndpoint,
                false,
                stream_context_create($context)
            );

            $response = json_decode($response);
            $this->token = $response->token;

        } catch (\Exception $e) {
            throw new \DomainException('Unable to get API access token', 0, $e);
        }
    }
}