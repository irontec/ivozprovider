Feature: Retrieve transformation rules
  In order to manage transformation rules
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the transformation rules json list
    Given I add Brand Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "transformation_rules"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
          {
              "type": "callerin",
              "description": "From special national to e164",
              "priority": 4,
              "matchExpr": "^([0-9]+)$",
              "replaceExpr": "+34\u0001",
              "id": 5
          },
          {
              "type": "calleein",
              "description": "From special national to e164",
              "priority": 4,
              "matchExpr": "^([0-9]+)$",
              "replaceExpr": "+34\u0001",
              "id": 6
          },
          {
              "type": "callerout",
              "description": "From e164 to special national",
              "priority": 3,
              "matchExpr": "^\\+34([0-9]+)$",
              "replaceExpr": "\u0001",
              "id": 7
          },
          {
              "type": "calleeout",
              "description": "From e164 to special national",
              "priority": 3,
              "matchExpr": "^\\+34([0-9]+)$",
              "replaceExpr": "\u0001",
              "id": 8
          }
      ]
    """

  Scenario: Retrieve certain transformation rule json
    Given I add Brand Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "transformation_rules/5"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
          "type": "callerin",
          "description": "From special national to e164",
          "priority": 4,
          "matchExpr": "^([0-9]+)$",
          "replaceExpr": "+34\u0001",
          "id": 5,
          "transformationRuleSet": {
              "description": "",
              "internationalCode": "00",
              "trunkPrefix": "",
              "areaCode": "",
              "nationalLen": 9,
              "generateRules": false,
              "id": 2,
              "name": {
                  "en": "en",
                  "es": "es"
              },
              "brand": 1,
              "country": 1
          }
      }
    """
