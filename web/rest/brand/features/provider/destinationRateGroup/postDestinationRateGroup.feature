  Feature: Create destination rate group
  In order to manage destination rate group
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a destination rate group
    Given I add Brand Authorization header
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "POST" request to "/destination_rate_groups" with body:
    """
      {
          "name": {
              "en": "New DR",
              "es": "New DR"
          },
          "description": {
              "en": "",
              "es": ""
          },
          "brand": "1",
          "currency": "1"
      }
    """
    Then the response status code should be 201
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
          "status": null,
          "id": 2,
          "name": {
              "en": "New DR",
              "es": "New DR"
          },
          "description": {
              "en": "",
              "es": ""
          },
          "file": {
              "fileSize": null,
              "mimeType": null,
              "baseName": null,
              "importerArguments": []
          },
          "brand": 1,
          "currency": 1
      }
    """

  Scenario: Retrieve created destination rate group
    Given I add Brand Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "destination_rate_groups/2"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be like:
    """
      {
          "status": null,
          "id": 2,
          "name": {
              "en": "New DR",
              "es": "New DR"
          },
          "description": {
              "en": "",
              "es": ""
          },
          "file": {
              "fileSize": null,
              "mimeType": null,
              "baseName": null,
              "importerArguments": []
          },
          "brand": "~",
          "currency": {
              "iden": "EUR",
              "symbol": "\u20ac",
              "id": 1,
              "name": {
                  "en": "Euro",
                  "es": "Euro"
              }
          }
      }
    """
