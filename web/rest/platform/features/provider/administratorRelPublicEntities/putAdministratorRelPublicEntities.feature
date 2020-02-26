Feature: Manage administrator rel public entities
  In order to manage administrator rel public entities
  as a super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a administrator rel public entities
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/administrator_rel_public_entities/230" with body:
    """
      {
          "create": true,
          "read": false,
          "update": true,
          "delete": false,
          "administrator": 1,
          "publicEntity": 105
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "create": true,
          "read": false,
          "update": true,
          "delete": false,
          "id": 230,
          "administrator": {
              "username": "admin",
              "pass": "****",
              "email": "admin@example.com",
              "active": true,
              "restricted": false,
              "name": "admin",
              "lastname": "ivozprovider",
              "id": 1,
              "brand": null,
              "company": null,
              "timezone": 145
          },
          "publicEntity": {
              "iden": "ProxyTrunks",
              "fqdn": "Ivoz\\Provider\\Domain\\Model\\ProxyTrunk\\ProxyTrunk",
              "platform": true,
              "brand": false,
              "client": false,
              "id": 105,
              "name": {
                  "en": "ProxyTrunks",
                  "es": "ProxyTrunks",
                  "ca": "ProxyTrunks",
                  "it": "ProxyTrunks"
              }
          }
      }
    """
