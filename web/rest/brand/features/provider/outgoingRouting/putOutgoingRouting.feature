Feature: Update outgoing routings
  In order to manage outgoing routings
  As a brand admin
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
     And the JSON should be equal to:
    """
      {
          "type": "pattern",
          "priority": 2,
          "weight": 2,
          "routingMode": "static",
          "prefix": null,
          "stopper": false,
          "forceClid": false,
          "clid": null,
          "id": 1,
          "company": 2,
          "carrier": 1,
          "routingPattern": 1,
          "routingPatternGroup": null,
          "routingTag": 1,
          "clidCountry": null,
          "carrierIds": []
      }
    """
