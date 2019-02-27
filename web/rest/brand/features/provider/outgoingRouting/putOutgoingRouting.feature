Feature: Update outgoing routings
  In order to manage outgoing routings
  As an super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update an outgoing routings
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/outgoing_routings/1" with body:
    """
      {
          "type": "pattern",
          "priority": 2,
          "weight": 2,
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
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be like:
    """
      {
          "type": "pattern",
          "priority": 2,
          "weight": 2,
          "routingMode": "static",
          "prefix": null,
          "forceClid": false,
          "clid": null,
          "id": 1,
          "brand": "~",
          "company": "~",
          "carrier": "~",
          "routingPattern": "~",
          "routingPatternGroup": null,
          "clidCountry": null
      }
    """
