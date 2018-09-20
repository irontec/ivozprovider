Feature: Retrieve music on holds
  In order to manage music on holds
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the music on holds json list
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "music_on_holds"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
          {
              "name": "Something good",
              "status": null,
              "id": 1
          },
          {
              "name": "Something good",
              "status": null,
              "id": 2
          }
      ]
    """

  Scenario: Retrieve certain music on hold json
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "music_on_holds/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be like:
    """
      {
          "name": "Something good",
          "status": null,
          "id": 1,
          "originalFile": {
              "fileSize": null,
              "mimeType": null,
              "baseName": null
          },
          "encodedFile": {
              "fileSize": null,
              "mimeType": null,
              "baseName": null
          },
          "company": null
      }
    """
