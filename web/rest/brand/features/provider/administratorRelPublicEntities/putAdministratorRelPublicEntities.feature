Feature: Manage administrator rel public entities
  In order to manage administrator rel public entities
  as a super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a administrator rel public entities
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/administrator_rel_public_entities/64" with body:
    """
      {
          "create": false,
          "read": false,
          "update": false,
          "delete": false,
          "administrator": 4,
          "publicEntity": 64
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "create": false,
          "read": false,
          "update": false,
          "delete": false,
          "id": 64,
          "administrator": {
              "username": "test_company_admin",
              "pass": "****",
              "email": "test@irontec.com",
              "active": true,
              "restricted": false,
              "name": "Admin Name",
              "lastname": "Admin Lastname",
              "id": 4,
              "company": 1,
              "timezone": 145
          },
          "publicEntity": {
              "iden": "TransformationRuleSets",
              "fqdn": "Ivoz\\Provider\\Domain\\Model\\TransformationRuleSet\\TransformationRuleSet",
              "platform": false,
              "brand": true,
              "client": true,
              "id": 64,
              "name": {
                  "en": "TransformationRuleSets",
                  "es": "TransformationRuleSets",
                  "ca": "TransformationRuleSets",
                  "it": "TransformationRuleSets"
              }
          }
      }
    """
