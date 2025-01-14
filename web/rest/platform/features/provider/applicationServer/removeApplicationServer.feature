Feature: Remove application servers
  In order to manage application servers
  as a super admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove an application server
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/application_servers/4"
     Then the response status code should be 204

  @createSchema
  Scenario: Remove a used application server
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/application_servers/1"
     Then the response status code should be 403
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/problem+json; charset=utf-8"
      And the JSON should be like:
      """
      {
         "detail":"Unable delete this element, due to is being used by unknown"
      }
      """
