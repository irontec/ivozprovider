Feature: Create locutions
  In order to manage locutions
  As a client admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a locution
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "multipart/form-data; boundary=----IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" multipart request to "/locutions" with body:
    """
----IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="brand"

      {
          "name": "newLocution",
          "status": null
      }
----IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="originalFile"; filename="uploadable"
Content-Type: text/plain

This is file content
----IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "name": "newLocution",
          "status": "pending",
          "id": 2,
          "encodedFile": {
              "fileSize": null,
              "mimeType": null,
              "baseName": null
          },
          "originalFile": {
              "fileSize": 20,
              "mimeType": "text/plain; charset=us-ascii",
              "baseName": "uploadable"
          }
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
          "status": "pending",
          "id": 2,
          "encodedFile": {
              "fileSize": null,
              "mimeType": null,
              "baseName": null
          },
          "originalFile": {
              "fileSize": 20,
              "mimeType": "text/plain; charset=us-ascii",
              "baseName": "uploadable"
          }
      }
    """
