Feature: Create outgoing routings
  In order to manage outgoing routings
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create an outgoing routing
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/outgoing_routings" with body:
    """
      {
          "type": "pattern",
          "priority": 2,
          "weight": 1,
          "routingMode": "static",
          "prefix": null,
          "forceClid": false,
          "clid": null,
          "brand": 1,
          "company": 2,
          "carrier": 1,
          "routingPattern": 1,
          "routingPatternGroup": null,
          "clidCountry": null
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be like:
    """
      {
          "type": "pattern",
          "priority": 2,
          "weight": 1,
          "routingMode": "static",
          "id": 3,
          "company": 2
      }
    """

  Scenario: Retrieve created outgoing routing
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "outgoing_routings/3"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "type": "pattern",
          "priority": 2,
          "weight": 1,
          "routingMode": "static",
          "prefix": null,
          "forceClid": false,
          "clid": null,
          "id": 3,
          "brand": "~",
          "company": "~",
          "carrier": "~",
          "routingPattern": "~",
          "routingPatternGroup": null,
          "clidCountry": null
      }
    """
