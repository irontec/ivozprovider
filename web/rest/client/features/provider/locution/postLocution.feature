Feature: Create locutions
  In order to manage locutions
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a locution
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/locutions" with body:
    """
      {
          "name": "newLocution",
          "status": null,
          "encodedFile": {
              "fileSize": null,
              "mimeType": null,
              "baseName": null
          },
          "originalFile": {
              "fileSize": null,
              "mimeType": null,
              "baseName": null
          },
          "company": 1
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "name": "newLocution",
          "status": null,
          "id": 2,
          "encodedFile": {
              "fileSize": null,
              "mimeType": null,
              "baseName": null
          },
          "originalFile": {
              "fileSize": null,
              "mimeType": null,
              "baseName": null
          },
          "company": 1
      }
    """

  Scenario: Retrieve created locution
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "locutions/2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "name": "newLocution",
          "status": null,
          "id": 2,
          "encodedFile": {
              "fileSize": null,
              "mimeType": null,
              "baseName": null
          },
          "originalFile": {
              "fileSize": null,
              "mimeType": null,
              "baseName": null
          },
          "company": "~"
      }
    """
