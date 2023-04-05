Feature: Create outgoing routings
  In order to manage outgoing routings
  As a brand admin
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
          "routingMode": "lcr",
          "prefix": null,
          "forceClid": false,
          "clid": null,
          "company": 2,
          "carrier": 1,
          "routingPattern": 1,
          "routingPatternGroup": null,
          "clidCountry": null,
          "carrierIds": [1]
      }
      """
     Then the response status code should be 201
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "type": "pattern",
          "priority": 2,
          "weight": 1,
          "routingMode": "lcr",
          "prefix": null,
          "stopper": false,
          "forceClid": false,
          "clid": null,
          "id": 3,
          "company": 2,
          "carrier": null,
          "routingPattern": 1,
          "routingPatternGroup": null,
          "routingTag": null,
          "clidCountry": null,
          "carrierIds": [
              1
          ]
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
          "routingMode": "lcr",
          "prefix": null,
          "stopper": false,
          "forceClid": false,
          "clid": null,
          "id": 3,
          "company": "~",
          "carrier": null,
          "routingPattern": {
              "prefix": "+34",
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
          },
          "routingPatternGroup": null,
          "routingTag": null,
          "clidCountry": null,
          "carrierIds": [
              1
          ]
      }
      """
