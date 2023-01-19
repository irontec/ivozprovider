Feature: Update administrator Acl
  In order to manage administrators acl
  As a brand admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Update an administrator
    Given I add Brand Authorization header
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "POST" request to "/administrators/7/revoke_all" with body:
    """
      [1,2,3]
    """
    Then the response status code should be 200

  Scenario: Update an administrator
    Given I add Brand Authorization header
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "POST" request to "/administrators/7/grant_all" with body:
    """
      [1,2,3]
    """
    Then the response status code should be 200

  Scenario: Update an administrator
    Given I add Brand Authorization header
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "POST" request to "/administrators/7/grant_read_only" with body:
    """
      [1,2,3]
    """
    Then the response status code should be 200

  Scenario: Update an administrator
    Given I add Brand Authorization header
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "POST" request to "/administrators/444/revoke_all" with body:
    """
      [1,2,3]
    """
    Then the response status code should be 404