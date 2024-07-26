Feature: Create web portals
  In order to manage web portals
  As a brand admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a web portal
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/web_portals" with body:
      """
      {
          "url": "https://post-example.com",
          "urlType": "user",
          "name": "Platform user Portal",
          "id": 1,
          "logo": {
              "fileSize": null,
              "mimeType": null,
              "baseName": null
          },
          "company": 2
      }
      """
     Then the response status code should be 201
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "url": "https://post-example.com",
          "urlType": "user",
          "name": "Platform user Portal",
          "color": "#000000",
          "id": 7,
          "logo": {
              "fileSize": null,
              "mimeType": null,
              "baseName": null
          },
          "company": 2
      }
      """

  Scenario: Retrieve created web portals
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "web_portals/7"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "url": "https://post-example.com",
          "urlType": "user",
          "name": "Platform user Portal",
          "id": 7,
          "logo": {
              "fileSize": null,
              "mimeType": null,
              "baseName": null
          },
          "company": {
            "id": 2
          }
      }
      """

  Scenario: Can not create god web portal
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/web_portals" with body:
      """
      {
          "url": "https://post-god-example.com",
          "urlType": "god",
          "name": "Platform god Portal",
          "id": 1,
          "logo": {
              "fileSize": null,
              "mimeType": null,
              "baseName": null
          }
      }
      """
     Then the response status code should be 403
