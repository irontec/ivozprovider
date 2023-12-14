package services

import (
	"crypto/tls"
	"encoding/json"
	"fmt"
	"io"
	"net/http"
	"reflect"
	"strings"

	logger "github.com/sirupsen/logrus"
	"irontec.com/realtime/pkg/config"
	"irontec.com/realtime/pkg/utils"
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

func GetActiveCallsFilter(token string, role string, filters *utils.Register) (*string, error) {
	var api string
	var queryFilters string = ""

	switch role {
	case ROLE_SUPER_ADMIN:
		api = config.GetHttpApiPlatform()
		queryFilters = getFiltersFromRegister(filters)
	case ROLE_BRAND_ADMIN:
		api = config.GetHttpApiBrand()
		queryFilters = getFiltersFromRegister(filters)
	case ROLE_COMPANY_ADMIN:
		api = config.GetHttpApiClient()
	}

	apiUrl := fmt.Sprintf(
		"%s/my/active_calls/realtime_filter?%s",
		api,
		queryFilters,
	)

	req, err := http.NewRequest("GET", apiUrl, nil)

	if err != nil {
		logger.Errorf("Error creating request: %v", err)
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
		logger.Errorf("Error making request: %v", err)
		return nil, err
	}
	defer resp.Body.Close()

	if resp.StatusCode != http.StatusOK {
		logger.Errorf("Request failed with status code: %v", resp.StatusCode)
		return nil, err
	}

	// Read the response body
	body, err := io.ReadAll(resp.Body)
	if err != nil {
		logger.Errorf("Error reading response body: %v", err)
		return nil, err
	}
	var criteriaResponse *CriteriaResponse

	if err := json.Unmarshal(body, &criteriaResponse); err != nil {
		logger.Errorf("Error unmarshaling JSON: %v", err)
		return nil, err
	}

	response := criteriaResponse.Criteria

	return &response, nil
}

func getFiltersFromRegister(filters *utils.Register) string {
	queryFilters := ""
	if filters == nil {
		return queryFilters
	}

	if filters.Trunks != nil {
		val := reflect.ValueOf(filters.Trunks).Elem()

		for i := 0; i < val.NumField(); i++ {
			field := val.Field(i)
			fieldName := val.Type().Field(i).Name

			notNil := field.Interface() != reflect.Zero(field.Type()).Interface()
			if notNil {
				queryFilters += fmt.Sprintf(
					"%s=%v&",
					strings.ToLower(fieldName),
					field.Interface(),
				)
			}
		}
	}

	return queryFilters
}
