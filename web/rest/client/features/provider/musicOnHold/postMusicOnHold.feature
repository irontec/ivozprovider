Feature: Create music on holds
  In order to manage music on holds
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a music on hold
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/music_on_holds" with body:
    """
      {
          "name": "Something new",
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
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "name": "Something new",
          "status": null,
          "id": 3
      }
    """

  Scenario: Retrieve created music on holds
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "music_on_holds/3"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "name": "Something new",
          "status": null,
          "id": 3,
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
