<?php

namespace IvozProvider\Service;

class RestClient
{
    const LOGIN_ENDPOINT = '/admin_login';

    const REFRESH_TOKEN_ENDPOINT = '/token/refresh';

    const BILLABLE_CALL_ENDPOINT = '/billable_calls';

    const RATING_PLANS_ENDPOINT = '/my/rating_plan_prices';

    /**
     * @var string
     */
    protected $token;

    /**
     * @var string
     */
    protected $refreshToken;

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

    public static function getAdminToken(
        string $username,
        string $password
    ) {
        $apiUrl = self::getBaseUrl() . self::LOGIN_ENDPOINT;

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

    protected static function getBaseUrl($api = 'platform')
    {
        return 'https://127.0.0.1/api/'
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

    public function getBillableCalls(array $where = [])
    {
        $where['_pagination'] = "false";
        $apiEndpoint =
            self::getBaseUrl()
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
            throw new \DomainException('Unable to get Billable Calls', 0, $e);
        }
    }

    public function getRatingPlans($ratingPlanId = 1)
    {
        $apiEndpoint =
            self::getBaseUrl('brand')
            . self::RATING_PLANS_ENDPOINT
            . '?id=' . $ratingPlanId;

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
            throw new \DomainException('Unable to get Rating Plans', 0, $e);
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
        }

        return $response;
    }

    private function refreshToken()
    {
        $apiUrl = self::getBaseUrl() . self::REFRESH_TOKEN_ENDPOINT;

        $options = self::getBaseRequestOptions('POST');
        $options[CURLOPT_HTTPHEADER] = [
            "Accept: application/json",
            "Content-Type: application/x-www-form-urlencoded"
        ];
        $options[CURLOPT_POST] = 1;
        $options[CURLOPT_POSTFIELDS] = http_build_query([
            'refresh_token' =>  $this->refreshToken
        ]);

        try {
            $response = self::sendRequest($apiUrl, $options);

            $jsonResponse = json_decode($response);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception('Invalid response format');
            }

            $this->token = $jsonResponse->token;
        } catch (\Exception $e) {
            throw new \DomainException('Unable to get API access token', 0, $e);
        }
    }
}
