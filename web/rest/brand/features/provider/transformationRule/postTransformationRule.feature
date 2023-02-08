Feature: Create transformation rules
  In order to manage transformation rules
  As a brand admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a transformation rule
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/transformation_rules" with body:
      """
      {
          "type": "callerout",
          "description": "From e164 to usansolocity",
          "priority": 10,
          "matchExpr": "^\\+34([0-9]+)$",
          "replaceExpr": "\u0001",
          "transformationRuleSet": 1
      }
      """
     Then the response status code should be 201
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "type": "callerout",
          "description": "From e164 to usansolocity",
          "priority": 10,
          "matchExpr": "^\\+34([0-9]+)$",
          "replaceExpr": "\u0001",
          "id": 9,
          "transformationRuleSet": 1
      }
      """

  Scenario: Retrieve created transformation rule
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "/transformation_rules/9"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "type": "callerout",
          "description": "From e164 to usansolocity",
          "priority": 10,
          "matchExpr": "^\\+34([0-9]+)$",
          "replaceExpr": "\u0001",
          "id": 9,
          "transformationRuleSet": {
              "description": "Brand 1 transformation for Spain",
              "internationalCode": "00",
              "trunkPrefix": "",
              "areaCode": "",
              "nationalLen": 9,
              "generateRules": false,
              "id": 1,
              "name": {
                  "en": "Brand 1 transformation for Spain",
                  "es": "Marca 1 tansformacion para España",
                  "ca": "Marca 1 tansformacion para España",
                  "it": "Brand 1 transformation for Spain"
              },
              "country": 68,
              "editable": true
          }
      }
      """

  @createSchema
  Scenario: Cannot set unmanaged relationship
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/transformation_rules" with body:
      """
      {
          "type": "callerout",
          "description": "From e164 to usansolocity",
          "priority": 10,
          "matchExpr": "^\\+34([0-9]+)$",
          "replaceExpr": "\u0001",
          "transformationRuleSet": 2
      }
      """
     Then the response status code should be 403
