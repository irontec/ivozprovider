Feature: Update webhooks
  In order to manage webhooks
  As a brand admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a webhook
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/webhooks/1" with body:
      """
      {
          "name": "Updated Start Webhook",
          "uri": "https://webhook.updated.com/start",
          "eventStart": true,
          "eventRing": true,
          "eventAnswer": false,
          "eventEnd": false,
          "template": "{\"event\": \"updated\", \"callId\": \"{callId}\"}"
      }
      """
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "name": "Updated Start Webhook",
          "description": null,
          "uri": "https://webhook.updated.com/start",
          "eventStart": true,
          "eventRing": true,
          "eventAnswer": false,
          "eventEnd": false,
          "template": "{\"event\": \"updated\", \"callId\": \"{callId}\"}",
          "id": 1,
          "company": 1,
          "ddi": null
      }
      """

  Scenario: Cannot update webhook to have no events
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/webhooks/1" with body:
      """
      {
          "name": "Invalid Webhook",
          "uri": "https://webhook.invalid.com/none",
          "eventStart": false,
          "eventRing": false,
          "eventAnswer": false,
          "eventEnd": false,
           "template": "{\"error\": \"no events\"}"
       }
      """
     Then the response status code should be 400
      And the response should be in JSON

  Scenario: Cannot update webhook with invalid URI
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/webhooks/1" with body:
      """
      {
          "name": "Invalid URI Webhook",
          "uri": "not-a-valid-uri",
          "eventStart": true,
          "eventRing": false,
          "eventAnswer": false,
          "eventEnd": false,
           "template": "{\"event\": \"start\"}"
       }
      """
     Then the response status code should be 400
      And the response should be in JSON

  Scenario: Cannot update webhook from other brand
    Given I add "Authorization" header equal to "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE0MjAwNzAwMjMsImV4cCI6MjAzNTUxMTIyMywidXNlciI6MiwiYWRtaW4iOiJicmFuZCIsInJvbGVzIjpbIlJPTEVfQlJBTkRfQURNSU4iXX0.l5CJr4aPlQzUZJKDKinGGW9k-xFnPF7iaBGY9ZbQsbc"
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/webhooks/1" with body:
      """
      {
          "name": "Forbidden Update",
          "uri": "https://webhook.forbidden.com/test"
      }
      """
     Then the response status code should be 401
