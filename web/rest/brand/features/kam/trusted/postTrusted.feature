Feature: Create Trusted addresses
  In order to manage Trusted addresses
  As a brand admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create an Trusted addresses
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/trusteds" with body:
      """
      {
          "srcIp": "127.0.1.2",
          "proto": "any",
          "fromPattern": null,
          "ruriPattern": null,
          "tag": "1",
          "description": "desc",
          "priority": 0,
          "company": 1
      }
      """
     Then the response status code should be 201
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "srcIp": "127.0.1.2",
          "proto": "any",
          "fromPattern": null,
          "ruriPattern": null,
          "tag": "1",
          "description": "desc",
          "priority": 0,
          "id": 2,
          "company": 1
      }
      """

  Scenario: Retrieve created trusted addresses
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "trusteds/2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "srcIp": "127.0.1.2",
          "proto": "any",
          "fromPattern": null,
          "ruriPattern": null,
          "tag": "1",
          "description": "desc",
          "priority": 0,
          "id": 2,
          "company": "~"
      }
      """
