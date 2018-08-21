Feature: Retrieve brand urls
  In order to manage brand urls
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the brand url json list
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "brand_urls"
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
              "url": "https://test-ivozprovider.irontec.com",
              "name": "Irontec Ivozprovider God Portal",
              "id": 2
          },
          {
              "url": "https://users.artemis.irontec.com",
              "name": "Users",
              "id": 3
          }
      ]
    """

  Scenario: Retrieve certain brand url json
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "brand_urls/1"
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
          "brand": "~"
      }
    """
