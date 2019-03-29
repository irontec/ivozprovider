Feature: Retrieve extensions
  In order to manage extensions
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the extensions json list
    Given I add User Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "my/call_forward_settings"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      []
    """
