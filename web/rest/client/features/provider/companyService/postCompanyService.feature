Feature: Create company services
  In order to manage company services
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a company service
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "company_services" with body:
    """
      {
          "code": "92",
          "service": 4
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "code": "92",
          "id": 7,
          "company": 1,
          "service": 4
      }
    """

  Scenario: Retrieve created company service
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "company_services/7"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "code": "92",
          "id": 7,
          "company": "~",
          "service": {
              "iden": "RecordLocution",
              "defaultCode": "00",
              "extraArgs": true,
              "id": 4,
              "name": {
                  "en": "en",
                  "es": "en"
              },
              "description": {
                  "en": "en",
                  "es": "en"
              }
          }
      }
    """
