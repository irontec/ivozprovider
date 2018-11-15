Feature: Update transformation rules
  In order to manage transformation rules
  As an super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a transformation rule
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/transformation_rules/5" with body:
    """
      {
          "type": "callerin",
          "description": "Updated",
          "priority": 5,
          "matchExpr": "^([0-9]+)$",
          "replaceExpr": "+34\u0001",
          "transformationRuleSet": 2
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
       {
          "type": "callerin",
          "description": "Updated",
          "priority": 5,
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
