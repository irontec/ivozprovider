Feature: Retrieve match list patterns
  In order to manage match list patterns
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the match list patterns json list
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "match_list_patterns"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
          {
              "description": "test desc",
              "type": "number",
              "regexp": null,
              "numbervalue": "946002050",
              "id": 1
          }
      ]
    """

  Scenario: Retrieve certain match list pattern json
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "match_list_patterns/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
          "description": "test desc",
          "type": "number",
          "regexp": null,
          "numbervalue": "946002050",
          "id": 1,
          "matchList": {
              "name": "testMatchlist",
              "id": 1,
              "brand": null,
              "company": 1
          },
          "numberCountry": {
              "code": "ES",
              "countryCode": "+34",
              "id": 1,
              "name": {
                  "en": "Spain",
                  "es": "España"
              },
              "zone": {
                  "en": "Europe",
                  "es": "Europa"
              }
          }
      }
    """
