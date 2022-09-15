Feature: Retrieve ddis
  In order to manage ddi
  As a brand admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the ddi json list
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "ddis"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      [
          {
              "ddi": "123",
              "ddie164": "+34123",
              "id": 1,
              "company": 1,
              "ddiProvider": 1,
              "country": 68
          },
          {
              "ddi": "124",
              "ddie164": "+34124",
              "id": 2,
              "company": 4,
              "ddiProvider": 1,
              "country": 68
          },
          {
              "ddi": "121",
              "ddie164": "+34121",
              "id": 3,
              "company": 3,
              "ddiProvider": 1,
              "country": 68
          }
      ]
    """

  Scenario: Retrieve certain ddi json
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "ddis/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "ddi": "123",
          "ddie164": "+34123",
          "id": 1,
          "company": "~",
          "ddiProvider": {
              "description": "DDIProviderDescription",
              "name": "DDIProviderName",
              "externallyRated": false,
              "id": 1,
              "transformationRuleSet": 1
          },
          "country": {
              "code": "ES",
              "countryCode": "+34",
              "id": 68,
              "name": {
                  "en": "Spain",
                  "es": "España",
                  "ca": "España"
              },
              "zone": {
                  "en": "Europe",
                  "es": "Europa",
                  "ca": "Europa"
              }
          }
      }
    """
