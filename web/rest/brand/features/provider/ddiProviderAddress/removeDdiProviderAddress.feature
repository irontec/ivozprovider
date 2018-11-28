Feature: Manage ddi provider addresses
  In order to manage ddi provider addresses
  As an super admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a ddi provider address
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/ddi_provider_addresses/1"
     Then the response status code should be 204
