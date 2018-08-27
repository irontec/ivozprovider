Feature: Retrieve timezones
  In order to manage timezones
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the timezones json list
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "timezones"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
          {
              "tz": "Europe/Madrid",
              "id": 1
          },
          {
              "tz": "Europe/London",
              "id": 2
          }
      ]
    """

  Scenario: Retrieve certain timezones json
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "timezones/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
          "tz": "Europe/Madrid",
          "comment": "mainland",
          "id": 1,
          "label": {
              "en": "en",
              "es": "es"
          },
          "country": {
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
