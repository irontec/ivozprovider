Feature: Create faxes in outs
  In order to manage faxes in out
  As a user
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a fax out
    Given I add User Authorization header
     When I add "Content-Type" header equal to "multipart/form-data; boundary=----IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" multipart request to "/faxes_in_outs" with body:
    """
----IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="brand"

      {
          "fax": 1,
          "dst": "34688888881",
          "dstCountry": 1,
          "type": "Out"
      }
----IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="file"; filename="uploadable"
Content-Type: text/plain

This is file content
----IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be like:
    """
      {
          "src": null,
          "dst": "34688888881",
          "type": "Out",
          "pages": null,
          "status": "pending",
          "id": 5,
          "file": {
              "fileSize": 20,
              "mimeType": "text/plain; charset=us-ascii",
              "baseName": "uploadable"
          },
          "fax": 1,
          "dstCountry": 1,
          "calldate": "match:regexp(/\\d{4}-\\d{2}-\\d{2} \\d{2}:\\d{2}:\\d{2}/)"
      }
    """

  Scenario: Retrieve created fax out
    Given I add User Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "faxes_in_outs/5"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "src": null,
          "dst": "34688888881",
          "type": "Out",
          "pages": null,
          "status": "pending",
          "id": 5,
          "file": {
              "fileSize": 20,
              "mimeType": "text/plain; charset=us-ascii",
              "baseName": "uploadable"
          },
          "fax": {
              "name": "Test Fax",
              "email": null,
              "sendByEmail": false,
              "id": 1
          },
          "dstCountry": "~",
          "calldate": "match:regexp(/\\d{4}-\\d{2}-\\d{2} \\d{2}:\\d{2}:\\d{2}/)"
      }
    """

  @createSchema
  Scenario: Create a fax out without access to fax
    Given I add User Authorization header
    When I add "Content-Type" header equal to "multipart/form-data; boundary=----IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
    And I add "Accept" header equal to "application/json"
    And I send a "POST" multipart request to "/faxes_in_outs" with body:
    """
----IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="brand"

      {
          "fax": 2,
          "dst": "34688888881",
          "dstCountry": 1,
          "type": "Out"
      }
----IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="file"; filename="uploadable"
Content-Type: text/plain

This is file content
----IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
    Then the response status code should be 403

  @createSchema
  Scenario: Cannot create inbound faxes
    Given I add User Authorization header
    When I add "Content-Type" header equal to "multipart/form-data; boundary=----IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
    And I add "Accept" header equal to "application/json"
    And I send a "POST" multipart request to "/faxes_in_outs" with body:
    """
----IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="brand"

      {
          "fax": 1,
          "src": "34688888888",
          "dst": "34688888881",
          "type": "In"
      }
----IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="file"; filename="uploadable"
Content-Type: text/plain

This is file content
----IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
    Then the response status code should be 403
