Feature: Retrieve company assistants
  In order to manage company assistants
  As a user
  I need to be able to retrieve them through the API.

  @createSchema @userApiContext
  Scenario: Retrieve the company assistants json list
    Given I add User Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "my/company_assistants"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      []
    """
