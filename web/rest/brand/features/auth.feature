Feature: Authorization checking
  In order to use the API
  As a client software developer
  I need to be authorized to access a given resource.

  @createSchema
  Scenario: An anonymous user cannot retrieve a secured resource
    When I add "Accept" header equal to "application/ld+json"
    And  I send a "GET" request to "companies"
    Then the response status code should be 401

  Scenario: An authenticated user can retrieve a secured resource
    When I add Brand Authorization header
    And  I add "Accept" header equal to "application/ld+json"
    And  I send a "GET" request to "companies"
    Then the response status code should be 200
    And  the response should be in JSON

  Scenario: A higher order admin can exchange token
    When I exchange Brand Authorization header
    And  I add "Accept" header equal to "application/ld+json"
    And  I send a "GET" request to "companies"
    Then the response status code should be 200
    And  the response should be in JSON

  Scenario: A higher order admin can exchange internal token
    When I exchange internal Brand Authorization header
    And  I add "Accept" header equal to "application/ld+json"
    And  I send a "GET" request to "companies"
    Then the response status code should be 200
    And  the response should be in JSON

  Scenario: An authenticated brand user retrieve a secured resource
    Given I add Brand Authorization header
    And  I add "Accept" header equal to "application/json"
    And  I send a "GET" request to "/services/unassigned"
    Then the response status code should be 200
    And  the response should be in JSON

  Scenario: Unauthenticated brand users cannot retrieve a secured resource
    And  I add "Accept" header equal to "application/json"
    And  I send a "GET" request to "/services/unassigned"
    Then the response status code should be 401