Feature: Retrieve company services
  In order to manage company services
  As a client admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the company services json list
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "company_services"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      [
          {
              "code": "94",
              "id": 1,
              "service": 1
          },
          {
              "code": "95",
              "id": 2,
              "service": 2
          },
          {
              "code": "93",
              "id": 3,
              "service": 3
          }
      ]
    """

  Scenario: Retrieve certain company service json
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "company_services/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "code": "94",
          "id": 1,
          "service": {
              "iden": "DirectPickUp",
              "defaultCode": "94",
              "extraArgs": true,
              "id": 1,
              "name": {
                  "en": "en",
                  "es": "es",
                  "ca": "ca"
              },
              "description": {
                  "en": "en",
                  "es": "es",
                  "ca": "ca"
              }
          }
      }
    """
