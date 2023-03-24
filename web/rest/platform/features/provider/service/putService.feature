Feature: Update services
  In order to manage services
  as a super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a service
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/services/1" with body:
      """
      {
          "defaultCode": "98",
          "extraArgs": true
      }
      """
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "iden": "DirectPickUp",
          "defaultCode": "98",
          "extraArgs": true,
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
      }
      """

  @createSchema
  Scenario: Cannot update required services field
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/services/1" with body:
      """
      {
          "iden": "UpdatedDirectPickUp",
          "defaultCode": "98",
          "extraArgs": true,
          "name": {
              "en": "english",
              "es": "ingles",
              "ca": "ingles",
              "it": "italiano"
          },
          "description": {
              "en": "descEn",
              "es": "descEs",
              "ca": "descCa",
              "it": "descIt"
          }
      }
      """
     Then the response status code should be 400
