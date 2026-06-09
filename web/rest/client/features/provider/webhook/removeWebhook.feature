Feature: Remove webhooks
  In order to manage webhooks
  As a company admin
  I need to be able to remove my company's webhooks through the API.

  @createSchema
  Scenario: Remove my webhook
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/webhooks/1"
     Then the response status code should be 204
