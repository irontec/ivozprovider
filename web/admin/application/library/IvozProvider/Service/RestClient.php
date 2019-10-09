<?php

namespace IvozProvider\Service;

class RestClient
{
    const LOGIN_ENDPOINT = '/admin_login';

    const EXCHANGE_ENDPOINT = '/token/exchange';

    const REFRESH_TOKEN_ENDPOINT = '/token/refresh';

    const BILLABLE_CALL_ENDPOINT = '/billable_calls';

    const RATING_PLANS_ENDPOINT = '/rating_plan_groups/{id}/prices';

    protected $token;
    protected $refreshToken;

    protected static $apiBaseUrl;

    /**
     * @var array
     */
    protected static $lastRequestInfo = [];

    public function __construct(
        string $token,
        string $refreshToken
    ) {
        $this->token = $token;
        $this->refreshToken = $refreshToken;
    }

    public function getToken()
    {
        return $this->token;
    }

    public static function setBaseUrl(string $baseUrl)
    {
        self::$apiBaseUrl = $baseUrl;
    }

    public static function getAdminToken(
        string $username,
        string $password,
        string $type = 'platform'
    ) {
        $apiUrl = self::getApiUrl(self::getBaseUrl(), $type) . self::LOGIN_ENDPOINT;

        $options = self::getBaseRequestOptions('POST');
        $options[CURLOPT_HTTPHEADER] = [
            "Accept: application/json",
            "Content-Type: application/x-www-form-urlencoded"
        ];
        $options[CURLOPT_POST] = 1;
        $options[CURLOPT_POSTFIELDS] = http_build_query([
            'username' => $username,
            'password' => $password
        ]);

        try {
            $response = self::sendRequest($apiUrl, $options);

            if (is_null($response)) {
                throw new \Exception('Empty response');
            }

            $jsonResponse = json_decode($response);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception('Invalid response format');
            }

            return $jsonResponse;
        } catch (\Exception $e) {
            throw new \DomainException('Unable to get API access token', 0, $e);
        }
    }

    public static function exchangeAdminToken(
        string $token,
        string $username,
        string $type = 'brand',
        string $baseUrl = null
    ) {
        $baseUrl = $baseUrl ?? self::getBaseUrl();
        $apiUrl = self::getApiUrl($baseUrl, $type) . self::EXCHANGE_ENDPOINT;

        $options = self::getBaseRequestOptions('POST');
        $options[CURLOPT_HTTPHEADER] = [
            "Accept: application/json",
            "Content-Type: application/x-www-form-urlencoded"
        ];
        $options[CURLOPT_POST] = 1;
        $options[CURLOPT_POSTFIELDS] = http_build_query([
            'token' => $token,
            'username' => $username
        ]);

        try {
            $response = self::sendRequest($apiUrl, $options);

            if (is_null($response)) {
                throw new \Exception('Empty response');
            }

            $jsonResponse = json_decode($response);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception('Invalid response format');
            }

            return $jsonResponse;
        } catch (\Exception $e) {
            throw new \DomainException('Unable to get API access token', 0, $e);
        }
    }

    private static function sendRequest($url, $options)
    {
        $options[CURLOPT_URL] = $url;
        $options[CURLOPT_RETURNTRANSFER] = true;

        $ch = curl_init();
        curl_setopt_array($ch, $options);

        $response = curl_exec($ch);
        self::$lastRequestInfo = curl_getinfo($ch);
        curl_close($ch);

        return $response;
    }

    protected static function getBaseUrl()
    {
        return self::$apiBaseUrl
            ? self::$apiBaseUrl
            : 'https://' . $_SERVER['SERVER_NAME'];
    }

    protected static function getApiUrl(string $baseUrl, $api = 'platform')
    {
        return
            $baseUrl
            . '/api/'
            . $api
            . '/'
            . basename($_SERVER['SCRIPT_FILENAME']);
    }

    protected static function getBaseRequestOptions($method = 'GET')
    {
        return [
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_CONNECTTIMEOUT => 60,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_FRESH_CONNECT => true,
            CURLOPT_RETURNTRANSFER => true
        ];
    }

    public function getBillableCalls(array $where = [], $api = 'platform')
    {
        $where['_pagination'] = "false";
        $apiEndpoint =
            self::getApiUrl(self::getBaseUrl(), $api)
            . self::BILLABLE_CALL_ENDPOINT
            . '?' . http_build_query($where);

        $options = self::getBaseRequestOptions();
        $options[CURLOPT_HTTPHEADER] = [
            "Accept: text/csv, text/json"
        ];

        try {
            return $this->request(
                $apiEndpoint,
                $options
            );
        } catch (\Exception $e) {
            throw new \DomainException('Unable to get External Calls', 0, $e);
        }
    }

    public function getRatingPlanGroupPrices($ratingPlanGroupId = 1)
    {
        $endpoint = str_replace(
            '{id}',
            $ratingPlanGroupId,
            self::RATING_PLANS_ENDPOINT
        );

        $apiUrl = self::getApiUrl(self::getBaseUrl(), 'client') . $endpoint;
        $options = self::getBaseRequestOptions();
        $options[CURLOPT_HTTPHEADER] = [
            "Accept: text/csv, text/json"
        ];

        try {
            return $this->request(
                $apiUrl,
                $options
            );
        } catch (\Exception $e) {
            throw new \DomainException(
                'Unable to get Rating Plans',
                $e->getCode(),
                $e
            );
        }
    }

    /**
     * @param string $apiEndpoint
     * @param \resource $requestOptions
     * @param bool $retryOnExpiredToken
     * @return string
     * @throws \Exception
     */
    private function request(string $apiEndpoint, array $options, bool $retryOnExpiredToken = true)
    {
        $requestOptions = $options;
        if (!isset($requestOptions[CURLOPT_HTTPHEADER])) {
            $requestOptions[CURLOPT_HTTPHEADER] = [];
        }

        $requestOptions[CURLOPT_HTTPHEADER][] = "Authorization: Bearer " . $this->token;
        $response = self::sendRequest($apiEndpoint, $requestOptions);

        if (self::$lastRequestInfo['http_code'] === 401) {
            if (!$retryOnExpiredToken) {
                throw new \Exception('Unauthorized');
            }

            $this->refreshToken();
            return $this->request($apiEndpoint, $options, false);
        } elseif (self::$lastRequestInfo['http_code'] >= 400) {
            throw new \DomainException(
                'There was an error',
                self::$lastRequestInfo['http_code']
            );
        }

        return $response;
    }

    private function refreshToken()
    {
        $this->token = self::getRefreshedToken(
            $this->refreshToken
        );
    }

    public static function getRefreshedToken(string $refreshToken, string $baseUrl = null, string $api = 'platform')
    {
        $baseUrl = $baseUrl ?? self::getBaseUrl();
        $apiUrl = self::getApiUrl($baseUrl, $api) . self::REFRESH_TOKEN_ENDPOINT;

        $options = self::getBaseRequestOptions('POST');
        $options[CURLOPT_HTTPHEADER] = [
            "Accept: application/json",
            "Content-Type: application/x-www-form-urlencoded"
        ];
        $options[CURLOPT_POST] = 1;
        $options[CURLOPT_POSTFIELDS] = http_build_query([
            'refresh_token' =>  $refreshToken
        ]);

        try {
            $response = self::sendRequest($apiUrl, $options);

            $jsonResponse = json_decode($response);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception('Invalid response format');
            }

            return $jsonResponse->token;
        } catch (\Exception $e) {
            throw new \DomainException('Unable to get API access token', 0, $e);
        }
    }
}
