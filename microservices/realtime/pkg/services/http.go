package services

import (
	"crypto/tls"
	"encoding/json"
	"fmt"
	"io"
	"net/http"

	"irontec.com/realtime/pkg/config"
)

const ROLE_SUPER_ADMIN = "ROLE_SUPER_ADMIN"
const ROLE_BRAND_ADMIN = "ROLE_BRAND_ADMIN"
const ROLE_COMPANY_ADMIN = "ROLE_COMPANY_ADMIN"

var transport = &http.Transport{
	TLSClientConfig: &tls.Config{InsecureSkipVerify: true},
}

// Define a global HTTP client
var client = &http.Client{Transport: transport}

type CriteriaResponse struct {
	Criteria string `json:"criteria"`
}

func GetActiveCallsFilter(token string, role string) (*string, error) {
	var api string

	switch role {
	case ROLE_SUPER_ADMIN:
		api = config.GetHttpApiPlatform()
	case ROLE_BRAND_ADMIN:
		api = config.GetHttpApiBrand()
	case ROLE_COMPANY_ADMIN:
		api = config.GetHttpApiClient()
	}

	apiUrl := fmt.Sprintf(
		"%s/my/active_calls/realtime_filter",
		api,
	)

	req, err := http.NewRequest("GET", apiUrl, nil)

	if err != nil {
		fmt.Println("Error creating request:", err)
		return nil, err
	}

	req.Header.Set(
		"Authorization",
		fmt.Sprintf(
			"Bearer %s",
			token,
		),
	)

	// Perform the HTTP request using the global client
	resp, err := client.Do(req)
	if err != nil {
		fmt.Println("Error making request:", err)
		return nil, err
	}
	defer resp.Body.Close()

	if resp.StatusCode != http.StatusOK {
		fmt.Println("Request failed with status code:", resp.StatusCode)
		return nil, err
	}

	// Read the response body
	body, err := io.ReadAll(resp.Body)
	if err != nil {
		fmt.Println("Error reading response body:", err)
		return nil, err
	}
	var criteriaResponse *CriteriaResponse

	if err := json.Unmarshal(body, &criteriaResponse); err != nil {
		fmt.Println("Error unmarshaling JSON:", err)
		return nil, err
	}

	response := criteriaResponse.Criteria

	return &response, nil
}
