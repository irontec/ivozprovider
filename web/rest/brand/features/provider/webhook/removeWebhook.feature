Feature: Remove webhooks
  In order to manage webhooks
  As a brand admin
  I need to be able to remove them through the API.

  @createSchema
  Scenario: Remove a webhook
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/webhooks/1"
     Then the response status code should be 204

  Scenario: Cannot remove webhook from other brand
    Given I add "Authorization" header equal to "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE0MjAwNzAwMjMsImV4cCI6MjAzNTUxMTIyMywidXNlciI6MiwiYWRtaW4iOiJicmFuZCIsInJvbGVzIjpbIlJPTEVfQlJBTkRfQURNSU4iXX0.l5CJr4aPlQzUZJKDKinGGW9k-xFnPF7iaBGY9ZbQsbc"
     When I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/webhooks/1"
     Then the response status code should be 401
