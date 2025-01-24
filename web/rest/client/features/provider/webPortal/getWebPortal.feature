Feature: Retrieve web portals
  In order to manage web portals
  As a company admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the web portal json list
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "web_portals"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "url": "https://users-ivozprovider.irontec.com",
              "urlType": "user",
              "name": "Irontec Ivozprovider User Admin Portal",
              "id": 4,
              "logo": {
                  "fileSize": 10,
                  "mimeType": "image/jpeg",
                  "baseName": "user-logo.jpeg"
              },
              "company": null
          },
          {
              "url": "https://users2-ivozprovider.irontec.com",
              "urlType": "user",
              "name": "Irontec Ivozprovider User Admin Portal",
              "id": 6,
              "logo": {
                  "fileSize": 10,
                  "mimeType": "image/jpeg",
                  "baseName": "user-logo.jpeg"
              },
              "company": 1
          }
      ]
      """
