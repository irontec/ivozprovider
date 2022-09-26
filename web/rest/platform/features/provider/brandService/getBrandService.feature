Feature: Retrieve brandService
  In order to manage brand services
  as a super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the brand json list
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "brand_services"
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
          },
          {
              "code": "93",
              "id": 4,
              "service": 5
          }
      ]
    """

  Scenario: Retrieve certain brand service json
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "brand_services/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "code": "94",
          "id": 1,
          "brand": "~",
          "service": {
              "iden": "DirectPickUp",
              "defaultCode": "94",
              "extraArgs": true,
              "id": 1,
              "name": {
                  "en": "en",
                  "es": "es",
                  "ca": "ca",
                  "it": "it"
              },
              "description": {
                  "en": "en",
                  "es": "es",
                  "ca": "ca",
                  "it": "it"
              }
          }
      }
    """
