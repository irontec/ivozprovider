Feature: Update music on holds
  In order to manage music on holds
  As a client admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a music on hold
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/music_on_holds/2" with body:
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
          }
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
          "id": 2,
          "originalFile": {
              "fileSize": null,
              "mimeType": null,
              "baseName": null
          },
          "encodedFile": {
              "fileSize": null,
              "mimeType": null,
              "baseName": null
          }
      }
    """


  @createSchema
  Scenario: Update a music on hold file
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "multipart/form-data; boundary=----IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" multipart request to "/music_on_holds/2" with body:
    """
----IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="musicOnHold"

      {}
----IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="OriginalFile"; filename="uploadable"
Content-Type: text/plain

This is file content
----IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be like:
    """
     {
          "name": "Something good",
          "status": "pending",
          "id": 2,
          "originalFile": {
              "fileSize": 20,
              "mimeType": "text\/plain; charset=us-ascii",
              "baseName": "uploadable"
          },
          "encodedFile": {
              "fileSize": null,
              "mimeType": null,
              "baseName": null
          }
      }
    """
