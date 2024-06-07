Feature: Retrieve web portals
  In order to manage web portals
  as a super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the web portal json list
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "web_portals"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "url": "https://brand-ivozprovider.irontec.com",
              "urlType": "brand",
              "name": "Irontec Ivozprovider Brand Admin Portal",
              "id": 2,
              "logo": {
                  "fileSize": 10,
                  "mimeType": "image/jpeg",
                  "baseName": "brand-logo.jpeg"
              }
          },
          {
              "url": "https://nologo-platform-ivozprovider.irontec.com",
              "urlType": "god",
              "name": "No logo",
              "id": 5,
              "logo": {
                  "fileSize": null,
                  "mimeType": null,
                  "baseName": null
              }
          },
          {
              "url": "https://platform-ivozprovider.irontec.com",
              "urlType": "god",
              "name": "Platform Administration Portal",
              "id": 1,
              "logo": {
                  "fileSize": 10,
                  "mimeType": "image/jpeg",
                  "baseName": "logo.jpeg"
              }
          }
      ]
      """

  Scenario: Retrieve certain web portal json
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "web_portals/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "url": "https://platform-ivozprovider.irontec.com",
          "urlType": "god",
          "name": "Platform Administration Portal",
          "color": "#000000",
          "id": 1,
          "logo": {
              "fileSize": 10,
              "mimeType": "image/jpeg",
              "baseName": "logo.jpeg"
          },
          "brand": null
      }
      """
