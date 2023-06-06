Feature: Retrieve active calls

  @createSchema
  Scenario: Retrieve my web theme json
    When I add "Accept" header equal to "application/json"
     And I send a "GET" request to "/my/theme"
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
      """
      {
          "name": "Irontec Ivozprovider User Admin Portal",
          "theme": "default",
          "logo": "https://users-ivozprovider.irontec.com/api/my/logo/4/user-logo.jpeg"
      }
      """
