Feature: Retrieve company country
  In order to manage company country
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema @userApiContext
  Scenario: Retrieve the company country json list
    Given I add User Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "my/company_country"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      {
          "code": "ES",
          "countryCode": "+34",
          "id": 68,
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
