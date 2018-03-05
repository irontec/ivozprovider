Feature: Retrieve lcr rules
  In order to manage lcr rules
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the lcr rules json list
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "lcr_rules"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
          {
              "prefix": "+93",
              "fromUri": "^b1c[0-9]+$",
              "tag": "Afghanistan",
              "id": 1
          },
          {
              "prefix": "+93",
              "fromUri": "^b1c1$",
              "tag": "Afghanistan",
              "id": 2
          }
      ]
    """

  Scenario: Retrieve certain lcr rules json
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "lcr_rules/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
          "lcrId": 1,
          "prefix": "+93",
          "fromUri": "^b1c[0-9]+$",
          "requestUri": null,
          "stopper": 0,
          "enabled": 1,
          "tag": "Afghanistan",
          "description": "",
          "id": 1,
          "routingPattern": {
              "regExp": "+34",
              "id": 1,
              "name": {
                  "en": "en",
                  "es": "es"
              },
              "description": {
                  "en": "en",
                  "es": "es"
              },
              "brand": 1
          },
          "outgoingRouting": {
              "type": "pattern",
              "priority": 11,
              "weight": 6,
              "id": 2,
              "brand": 1,
              "company": null,
              "peeringContract": 1,
              "routingPattern": 1,
              "routingPatternGroup": null
          }
      }
    """
