Feature: Create webhooks
  In order to manage webhooks
  As a company admin
  I need to be able to create them for my company through the API.

  @createSchema
  Scenario: Create a DDI webhook for my company
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/webhooks" with body:
      """
      {
          "name": "DDI Start Webhook",
          "uri": "https://webhook.mycompany.com/start",
          "eventStart": true,
          "eventRing": false,
          "eventAnswer": false,
          "eventEnd": false,
          "template": "{\"event\": \"start\", \"ddi\": \"{ddiId}\"}",
          "ddi": 1
      }
      """
     Then the response status code should be 201
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
         "name": "DDI Start Webhook",
         "description": null,
         "uri": "https://webhook.mycompany.com/start",
         "eventStart": true,
         "eventRing": false,
         "eventAnswer": false,
         "eventEnd": false,
         "template": "{\"event\": \"start\", \"ddi\": \"{ddiId}\"}",
         "id": 6,
         "company": 1,
         "ddi": 1
      }
      """

  Scenario: Cannot create webhook without any event
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/webhooks" with body:
      """
      {
          "name": "Invalid Webhook",
          "uri": "https://webhook.invalid.com/none",
          "eventStart": false,
          "eventRing": false,
          "eventAnswer": false,
          "eventEnd": false,
          "template": "{\"error\": \"no events\"}",
          "ddi": 1
      }
      """
     Then the response status code should be 400
      And the response should be in JSON

  Scenario: Cannot create webhook with invalid URI
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/webhooks" with body:
      """
      {
          "name": "Invalid URI Webhook",
          "uri": "not-a-valid-uri",
          "eventStart": true,
          "eventRing": false,
          "eventAnswer": false,
          "eventEnd": false,
          "template": "{\"event\": \"start\"}",
          "ddi": 1
      }
      """
     Then the response status code should be 400
      And the response should be in JSON

  Scenario: Cannot create webhook with name too long
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/webhooks" with body:
      """
      {
          "name": "This is a very long webhook name that exceeds the maximum allowed length of 64 characters for the name field",
          "uri": "https://webhook.longname.com/test",
          "eventStart": true,
          "eventRing": false,
          "eventAnswer": false,
          "eventEnd": false,
          "template": "{\"event\": \"start\"}"
      }
      """
     Then the response status code should be 400
      And the response should be in JSON

  Scenario: Cannot create webhook with description too long
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/webhooks" with body:
      """
      {
          "name": "Long Description Test",
          "description": "This is a very long description that exceeds the maximum allowed length of 255 characters for the description field. This description is intentionally created to be longer than the database field allows, which should trigger a validation error when trying to create the webhook with such an overly lengthy description text.",
          "uri": "https://webhook.description.com/test",
          "eventStart": true,
          "eventRing": false,
          "eventAnswer": false,
          "eventEnd": false,
          "template": "{\"event\": \"start\"}"
      }
      """
     Then the response status code should be 400
      And the response should be in JSON
