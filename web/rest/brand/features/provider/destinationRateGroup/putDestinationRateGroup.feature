Feature: Update destination rate group
  In order to manage destination rate group
  As a brand admin
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
          "lastExecutionError": null,
          "id": 1,
          "name": {
              "en": "Updated Standard",
              "es": "Standard Actualizado",
              "ca": "Standard Actualizado"
          },
          "description": {
              "en": "New Description",
              "es": "Descripción nueva",
              "ca": "Descripción nueva"
          },
          "file": {
              "fileSize": null,
              "mimeType": null,
              "baseName": null,
              "importerArguments": []
          },
          "currency": 2
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "status": null,
          "lastExecutionError": null,
          "deductibleConnectionFee": false,
          "id": 1,
          "name": {
              "en": "Updated Standard",
              "es": "Standard Actualizado",
              "ca": "Standard Actualizado",
              "it": "Standard"
          },
          "description": {
              "en": "New Description",
              "es": "Descripción nueva",
              "ca": "Descripción nueva",
              "it": ""
          },
          "file": {
              "fileSize": null,
              "mimeType": null,
              "baseName": null,
              "importerArguments": []
          },
          "currency": 2
      }
    """
