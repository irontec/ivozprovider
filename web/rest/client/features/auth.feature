Feature: Authorization checking
  In order to use the API
  As a client software developer
  I need to be authorized to access a given resource.

  @createSchema
  Scenario: An anonymous user retrieve a secured resource
    When I add "Accept" header equal to "application/ld+json"
    And  I send a "GET" request to "users"
    Then the response status code should be 401


  Scenario: An authenticated user retrieve a secured resource
    When I add Company Authorization header
    And  I add "Accept" header equal to "application/ld+json"
    And  I send a "GET" request to "users"
    Then the response status code should be 200
    And  the response should be in JSON

  Scenario: A higher order admin can exchange token
    When I exchange Client Authorization header
    And  I add "Accept" header equal to "application/ld+json"
    And  I send a "GET" request to "users"
    Then the response status code should be 200
    And  the response should be in JSON
