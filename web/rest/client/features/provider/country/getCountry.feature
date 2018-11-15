Feature: Retrieve countries
  In order to manage countries
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the countries json list
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "countries"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      [
          {
              "code": "ES",
              "id": 1,
              "name": {
                  "en": "Spain",
                  "es": "España"
              }
          },
          {
              "code": "GB",
              "id": 2,
              "name": {
                  "en": "United Kingdom",
                  "es": "Reino Unido"
              }
          },
          {
              "code": "JP",
              "id": 3,
              "name": {
                  "en": "Japan",
                  "es": "Japón"
              }
          }
      ]
    """

  Scenario: Retrieve certain country json
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "countries/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      {
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
    """
