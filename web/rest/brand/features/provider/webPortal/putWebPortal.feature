Feature: Update web portals
  In order to manage web portals
  As a brand admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update an web portals
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/web_portals/3" with body:
      """
      {
          "url": "https://updated-example.com",
          "klearTheme": "redmond",
          "urlType": "user",
          "name": "Updated Portal",
          "userTheme": "default",
          "logo": {
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
          "url": "https://updated-example.com",
          "klearTheme": "redmond",
          "urlType": "user",
          "name": "Updated Portal",
          "userTheme": "default",
          "id": 3,
          "logo": {
              "fileSize": null,
              "mimeType": null,
              "baseName": null
          }
      }
      """

  @createSchema
  Scenario: Update web portal logo
   Given I add Brand Authorization header
    When I add "Content-Type" header equal to "multipart/form-data; boundary=----IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
     And I add "Accept" header equal to "application/json"
     And I send a "PUT" multipart request to "/web_portals/3" with body:
    """
----IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="brand"

      {}
----IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="Logo"; filename="uploadable"
Content-Type: text/plain

This is file content
----IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
    {
        "url": "https://client-ivozprovider.irontec.com",
        "klearTheme": "irontec-red",
        "urlType": "admin",
        "name": "Irontec Ivozprovider Client Admin Portal",
        "userTheme": "default",
        "id": 3,
        "logo": {
            "fileSize": 20,
            "mimeType": "text/plain; charset=us-ascii",
            "baseName": "uploadable"
        }
    }
    """

  Scenario: Retrieve uploaded web portal logo
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "/web_portals/3/logo"
     Then the response status code should be 200
      And the header "Content-Type" should be equal to "text/plain; charset=us-ascii"