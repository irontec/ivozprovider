Feature: Manage proxy trunks rel brands
  In order to manage proxy trunks rel brands
  as a super admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Cannot remove a proxy trunks rel brands in use
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/proxy_trunks_rel_brands/1"
     Then the response status code should be 403
