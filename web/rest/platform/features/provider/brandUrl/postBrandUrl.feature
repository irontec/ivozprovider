Feature: Create brand urls
  In order to manage brand urls
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create an brand url
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/brand_urls" with body:
    """
      {
          "url": "https://post-example.com",
          "klearTheme": "redmond",
          "urlType": "user",
          "name": "Platform user Portal",
          "userTheme": "default",
          "id": 1,
          "logo": {
              "fileSize": null,
              "mimeType": null,
              "baseName": null
          },
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
          "name": "Platform user Portal",
          "id": 4
      }
    """

  Scenario: Retrieve created brand urls
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "brand_urls/3"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "url": "https://users.artemis.irontec.com",
          "klearTheme": "redmond",
          "urlType": "user",
          "name": "Users",
          "userTheme": "default",
          "id": 3,
          "logo": {
              "fileSize": null,
              "mimeType": null,
              "baseName": null
          },
          "brand": "~"
      }
    """
