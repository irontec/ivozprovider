Feature: Create music on holds
  In order to manage music on holds
  As a client admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a music on hold
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "multipart/form-data; boundary=----IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" multipart request to "/music_on_holds" with body:
    """
----IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="brand"

      {
          "name": "Something new"
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
          "name": "Something new",
          "status": "pending",
          "id": 3,
          "originalFile": {
              "fileSize": 20,
              "mimeType": "text/plain; charset=us-ascii",
              "baseName": "uploadable"
          },
          "encodedFile": {
              "fileSize": null,
              "mimeType": null,
              "baseName": null
          }
      }
    """

  Scenario: Retrieve created music on holds
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "music_on_holds/3"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "name": "Something new",
          "status": "pending",
          "id": 3,
          "originalFile": {
              "fileSize": 20,
              "mimeType": "text/plain; charset=us-ascii",
              "baseName": "uploadable"
          },
          "encodedFile": {
              "fileSize": null,
              "mimeType": null,
              "baseName": null
          }
      }
    """
