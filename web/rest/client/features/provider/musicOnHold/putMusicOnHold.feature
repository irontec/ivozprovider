Feature: Update music on holds
  In order to manage music on holds
  As an super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a music on hold
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/music_on_holds/1" with body:
    """
      {
          "name": "Something updated",
          "status": null,
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
          "company": 1
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be like:
    """
     {
          "name": "Something updated",
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
          "company": "~"
      }
    """
