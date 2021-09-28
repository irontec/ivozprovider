Feature: Create brand servers
  In order to manage brand services
  as a super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create an brand services
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/brand_services" with body:
    """
      {
          "code": "11",
          "brand": 1,
          "service": 4
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "code": "11",
          "id": 5,
          "brand": 1,
          "service": 4
      }
    """

  Scenario: Retrieve created brand service
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "brand_services/5"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "code": "11",
          "id": 5,
          "brand": "~",
          "service": {
              "iden": "RecordLocution",
              "defaultCode": "00",
              "extraArgs": true,
              "id": 4,
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
