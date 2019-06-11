Feature: Retrieve web portals
  In order to manage web portals
  As an super admin
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
              "url": "https://example.com",
              "name": "Platform Administration Portal",
              "id": 1
          },
          {
              "url": "https://brand-ivozprovider.irontec.com",
              "name": "Irontec Ivozprovider Brand Admin Portal",
              "id": 2
          },
          {
              "url": "https://client-ivozprovider.irontec.com",
              "name": "Irontec Ivozprovider Client Admin Portal",
              "id": 3
          },
          {
              "url": "https://users-ivozprovider.irontec.com",
              "name": "Irontec Ivozprovider User Admin Portal",
              "id": 4
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
          "url": "https://example.com",
          "klearTheme": "redmond",
          "urlType": "god",
          "name": "Platform Administration Portal",
          "userTheme": "default",
          "id": 1,
          "logo": {
              "fileSize": null,
              "mimeType": null,
              "baseName": null
          },
          "brand": null
      }
    """
