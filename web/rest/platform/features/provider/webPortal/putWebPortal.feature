Feature: Update web portals
  In order to manage web portals
  as a super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update an web portals
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/web_portals/2" with body:
    """
      {
          "url": "https://updated-example.com",
          "urlType": "god",
          "name": "Updated Portal",
          "color": "#000000",
          "productName": "Edit Ivoz Provider",
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
     And the JSON should be equal to:
    """
      {
          "url": "https://updated-example.com",
          "urlType": "god",
          "name": "Updated Portal",
          "color": "#000000",
          "productName": "Edit Ivoz Provider",
          "id": 2,
          "logo": {
              "fileSize": null,
              "mimeType": null,
              "baseName": null
          },
          "brand": null,
          "company": null
      }
    """

  @createSchema
  Scenario: Update a web portal logo
    Given I add Authorization header
    When I add "Content-Type" header equal to "application/json"
    When I add "Content-Type" header equal to "multipart/form-data; boundary=----IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
    And I add "Accept" header equal to "application/json"
    And I send a "PUT" multipart request to "/web_portals/2" with body:
    """
----IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="brand"

      {
        "name": "Updated Portal"
      }
----IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="Logo"; filename="uploadable"
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
          "name": "Updated Portal",
          "color": "#000000",
          "logo": {
              "fileSize": 28,
              "mimeType": "text/plain; charset=us-ascii",
              "baseName": "uploadable"
          },
          "url": "https://brand-ivozprovider.irontec.com",
          "urlType": "brand",
          "productName": "Brand text",
          "id": 2,
          "brand": 1,
          "company": null
      }
    """
