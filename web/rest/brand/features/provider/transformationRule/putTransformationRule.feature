Feature: Update transformation rules
  In order to manage transformation rules
  As an super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a transformation rule
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/transformation_rules/1" with body:
    """
      {
          "type": "callerout",
          "description": "updated From e164 to special national",
          "priority": 4,
          "matchExpr": "^\\+34([0-9]+)$",
          "replaceExpr": "\u0001",
          "id": 1,
          "transformationRuleSet": 2
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
       {
          "type": "callerout",
          "description": "updated From e164 to special national",
          "priority": 4,
          "matchExpr": "^\\+34([0-9]+)$",
          "replaceExpr": "\u0001",
          "id": 1,
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
