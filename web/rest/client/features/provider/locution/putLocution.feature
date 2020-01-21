Feature: Update locutions
  In order to manage locutions
  As a client admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a locutions
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/locutions/1" with body:
    """
      {
          "name": "updatesLocution",
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
          }
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be like:
    """
     {
          "name": "updatesLocution",
          "status": null,
          "id": 1,
          "encodedFile": {
              "fileSize": null,
              "mimeType": null,
              "baseName": null
          },
          "originalFile": {
              "fileSize": null,
              "mimeType": null,
              "baseName": null
          }
      }
    """


  @createSchema
  Scenario: Update locution file
    Given I add Company Authorization header
    When I add "Content-Type" header equal to "multipart/form-data; boundary=----IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
    And I add "Accept" header equal to "application/json"
    And I send a "PUT" multipart request to "/locutions/1" with body:
    """
----IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="brand"

      {
          "name": "updatedLocution"
      }
----IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="originalFile"; filename="uploadable"
Content-Type: text/plain

This is updated file content
----IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be like:
    """
     {
          "name": "updatedLocution",
          "status": "pending",
          "id": 1,
          "encodedFile": {
              "fileSize": 1,
              "mimeType": "audio/x-wav; charset=binary",
              "baseName": "locution.wav"
          },
          "originalFile": {
              "fileSize": 28,
              "mimeType": "text/plain; charset=us-ascii",
              "baseName": "uploadable"
          }
      }
    """
