Feature: Retrieve outgoing routings
  In order to manage outgoing routings
  As a brand admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the outgoing routings json list
    Given I add Brand Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "outgoing_routings"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
          {
              "type": "pattern",
              "priority": 1,
              "weight": 1,
              "routingMode": "static",
              "stopper": false,
              "id": 1,
              "company": 1,
              "carrier": 1,
              "routingPattern": 1,
              "routingPatternGroup": null,
              "routingTag": 1
          },
          {
              "type": "pattern",
              "priority": 11,
              "weight": 6,
              "routingMode": "static",
              "stopper": false,
              "id": 2,
              "company": null,
              "carrier": 1,
              "routingPattern": 1,
              "routingPatternGroup": null,
              "routingTag": 1
          }
      ]
    """

  Scenario: Retrieve certain outgoing routing json
    Given I add Brand Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "outgoing_routings/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be like:
    """
       {
          "type": "pattern",
          "priority": 1,
          "weight": 1,
          "routingMode": "static",
          "prefix": null,
          "forceClid": false,
          "clid": null,
          "id": 1,
          "company": "~",
          "carrier": "~",
          "routingPattern": {
              "prefix": "+34",
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
          },
          "routingPatternGroup": null,
          "routingTag": {
              "name": "TagName",
              "tag": "123#",
              "id": 1
          },
          "clidCountry": null,
          "carrierIds": []
      }
    """
