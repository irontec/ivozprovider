Feature: Retrieve web theme
  In order to manage web theme
  As a user
  I need to be able to retrieve them through the API.

  @createSchema @userApiContext
  Scenario: Retrieve the web theme json list
    Given I add User Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "my/web_theme"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "name": "Irontec Ivozprovider User Admin Portal",
          "theme": "default",
          "logo": "https://users-ivozprovider.irontec.com/fso/webPortal/4-"
      }
      """
