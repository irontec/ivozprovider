Feature: Authorization checking
  In order to use the API
  As a client software developer
  I need to be authorized to access a given resource.

  @createSchema
  Scenario: An anonymous user retrieve a secured resource
     When I add "Accept" header equal to "application/ld+json"
      And I send a "GET" request to "users_cdrs"
     Then the response status code should be 401

  Scenario: An authenticated user retrieve a secured resource
    Given I add User Authorization header
      And I add "Accept" header equal to "application/ld+json"
      And I send a "GET" request to "users_cdrs"
     Then the response status code should be 200
      And the response should be in JSON

  Scenario: An authenticated user retrieve a secured resource
    Given I add User Authorization header
      And I add "Accept" header equal to "application/json"
      And I send a "GET" request to "/my/profile"
     Then the response status code should be 200
      And the response should be in JSON

  Scenario: Unauthenticated users cannot retrieve a secured resource
      And I add "Accept" header equal to "application/json"
      And I send a "GET" request to "/my/profile"
     Then the response status code should be 401

  Scenario: A higher order admin can exchange token
     When I exchange User Authorization header
      And I add "Accept" header equal to "application/ld+json"
      And I send a "GET" request to "/my/profile"
     Then the response status code should be 200
      And the response should be in JSON

  Scenario: A user can refresh its token
    Given I add "Accept" header equal to "application/json"
     When I send a "POST" request to "/token/refresh" with parameters:
        | key           | value               |
        | refresh_token | alice-refresh-token |
     Then the response status code should be 200
      And the response should be in JSON
      And the JSON node "token" should exist

  Scenario: A disabled user cannot refresh its token
    Given I add "Accept" header equal to "application/json"
     When I send a "POST" request to "/token/refresh" with parameters:
        | key           | value              |
        | refresh_token | dana-refresh-token |
     Then the response status code should be 401

  Scenario: A disabled user cannot use a previously issued token
    Given I add User Authorization header for "dana@democompany.com"
      And I add "Accept" header equal to "application/json"
     When I send a "GET" request to "/my/profile"
     Then the response status code should be 401

  Scenario: Impersonating a disabled user does not give a usable token
    Given I exchange User Authorization header for "dana@democompany.com"
      And I add "Accept" header equal to "application/json"
     When I send a "GET" request to "/my/profile"
     Then the response status code should be 401

  Scenario: An active user can log in from a host that is not a web portal
    Given I add "Accept" header equal to "application/json"
     When I send a "POST" request to "https://not-a-web-portal.irontec.com/user_login" with parameters:
        | key      | value                 |
        | email    | alice@democompany.com |
        | password | changeme              |
     Then the response status code should be 200
      And the JSON node "token" should exist

  Scenario: An active user can refresh its token from a host that is not a web portal
    Given I add "Accept" header equal to "application/json"
     When I send a "POST" request to "https://not-a-web-portal.irontec.com/token/refresh" with parameters:
        | key           | value               |
        | refresh_token | alice-refresh-token |
     Then the response status code should be 200
      And the JSON node "token" should exist

  Scenario: An impersonated active user can use the API from a host that is not a web portal
    Given I exchange User Authorization header
      And I add "Accept" header equal to "application/json"
     When I send a "GET" request to "https://not-a-web-portal.irontec.com/my/profile"
     Then the response status code should be 200
