Feature: Update Trusted addresses
  In order to manage Trusted addresses
  As a brand admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update an Trusted addresses
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/trusteds/1" with body:
      """
      {
          "srcIp": "194.30.6.88",
          "proto": "any",
          "fromPattern": null,
          "ruriPattern": null,
          "tag": "1",
          "description": "new desc",
          "priority": 1,
          "company": 1
      }
      """
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "srcIp": "194.30.6.88",
          "proto": "any",
          "fromPattern": null,
          "ruriPattern": null,
          "tag": "1",
          "description": "new desc",
          "priority": 1,
          "id": 1,
          "company": 1
      }
      """
