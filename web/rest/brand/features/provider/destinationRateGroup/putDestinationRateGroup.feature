Feature: Update destination rate group
  In order to manage destination rate group
  As an super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a destination rate group
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/destination_rate_groups/1" with body:
    """
      {
          "status": null,
          "id": 1,
          "name": {
              "en": "Updated Standard",
              "es": "Standard Actualizado"
          },
          "description": {
              "en": "New Description",
              "es": "Descripción nueva"
          },
          "file": {
              "fileSize": null,
              "mimeType": null,
              "baseName": null,
              "importerArguments": []
          },
          "brand": 1,
          "currency": 2
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be like:
    """
      {
          "status": null,
          "id": 1,
          "name": {
              "en": "Updated Standard",
              "es": "Standard Actualizado"
          },
          "description": {
              "en": "New Description",
              "es": "Descripci\u00f3n nueva"
          },
          "file": {
              "fileSize": null,
              "mimeType": null,
              "baseName": null,
              "importerArguments": []
          },
          "brand": "~",
          "currency": {
              "iden": "USD",
              "symbol": "$",
              "id": 2,
              "name": {
                  "en": "Dollar",
                  "es": "D\u00f3llar"
              }
          }
      }
    """
