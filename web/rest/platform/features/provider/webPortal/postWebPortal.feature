Feature: Create web portals
  In order to manage web portals
  as a super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a web portal
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/web_portals" with body:
    """
      {
          "url": "https://post-example.com",
          "urlType": "brand",
          "name": "Platform brand Portal",
          "brand": 1
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "url": "https://post-example.com",
          "urlType": "brand",
          "name": "Platform brand Portal",
          "color": "#000000",
          "id": 7,
          "logo": {
              "fileSize": null,
              "mimeType": null,
              "baseName": null
          },
          "brand": 1,
          "company": null
      }
    """

  Scenario: Retrieve created web portals
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "web_portals/7"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "url": "https://post-example.com",
          "urlType": "brand",
          "name": "Platform brand Portal",
          "color": "#000000",
          "id": 7,
          "logo": {
              "fileSize": null,
              "mimeType": null,
              "baseName": null
          },
          "brand": "~"
      }
    """

  @createSchema
  Scenario: Create a web portal with logo
    Given I add Authorization header
    When I add "Content-Type" header equal to "multipart/form-data; boundary=----IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
    And I add "Accept" header equal to "application/json"
    And I send a "POST" multipart request to "/web_portals" with body:
    """
----IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="brand"

      {
          "url": "https://post-example.com",
          "urlType": "brand",
          "name": "Platform brand Portal",
          "brand": 1
      }
----IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="Logo"; filename="uploadable"
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
          "url": "https://post-example.com",
          "urlType": "brand",
          "name": "Platform brand Portal",
          "color": "#000000",
          "id": 7,
          "logo": {
              "fileSize": 20,
              "mimeType": "text/plain; charset=us-ascii",
              "baseName": "uploadable"
          },
          "brand": 1,
          "company": null
      }
    """
