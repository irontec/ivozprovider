Feature: Retrieve destination rate group
  In order to manage destination rate group
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the destination rate group json list
    Given I add Brand Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "destination_rate_groups"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
          {
              "status": "inProgress",
              "id": 1,
              "name": {
                  "en": "Standard",
                  "es": "Standard"
              },
              "file": {
                  "fileSize": null,
                  "mimeType": null,
                  "baseName": null,
                  "importerArguments": []
              },
              "brand": 1,
              "currency": null
          }
      ]
    """

  Scenario: Retrieve certain destination rate group json
    Given I add Brand Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "destination_rate_groups/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be like:
    """
      {
          "status": "inProgress",
          "id": 1,
          "name": {
              "en": "Standard",
              "es": "Standard"
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
          "currency": null
      }
    """
