Feature: Create webhooks
  In order to manage webhooks
  As a brand admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a company webhook
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/webhooks" with body:
      """
      {
          "name": "Start Webhook",
          "uri": "https://webhook.example.com/start",
          "eventStart": true,
          "eventRing": false,
          "eventAnswer": false,
          "eventEnd": false,
          "template": "{\"event\": \"start\", \"callId\": \"{callId}\"}",
          "brand": 1,
          "company": 1
       }
      """
     Then the response status code should be 201
      And the response should be in JSON

  Scenario: Cannot create webhook with invalid URI
    Given I add Brand Authorization header
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
          "brand": 1,
          "company": 1
       }
      """
     Then the response status code should be 400
      And the response should be in JSON

  Scenario: Cannot create webhook with name too long
    Given I add Brand Authorization header
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
          "template": "{\"event\": \"start\"}",
          "brand": 1,
          "company": 1
         }
      """
     Then the response status code should be 400
      And the response should be in JSON

  Scenario: Create DDI-specific webhook successfully
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/webhooks" with body:
      """
      {
          "name": "DDI Webhook Test",
          "uri": "https://webhook.ddi.test.com/call",
          "eventStart": false,
          "eventRing": true,
          "eventAnswer": false,
          "eventEnd": false,
          "template": "{\"event\": \"ring\", \"ddi\": \"{ddiId}\"}",
          "company": 1,
          "ddi": 1
      }
      """
     Then the response status code should be 201
      And the response should be in JSON
      And the JSON should be like:
      """
      {
          "name": "DDI Webhook Test",
          "description": null,
          "uri": "https://webhook.ddi.test.com/call",
          "eventStart": false,
          "eventRing": true,
          "eventAnswer": false,
          "eventEnd": false,
           "template": "{\"event\": \"ring\", \"ddi\": \"{ddiId}\"}",
           "id": 7,
           "company": 1,
           "ddi": 1
      }
      """

  Scenario: Cannot create webhook with no events enabled
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/webhooks" with body:
      """
      {
          "name": "No Events Webhook",
          "uri": "https://webhook.example.com/noevents",
          "eventStart": false,
          "eventRing": false,
          "eventAnswer": false,
          "eventEnd": false,
          "template": "{\"event\": \"none\"}",
          "brand": 1,
          "company": 1
      }
      """
     Then the response status code should be 400
      And the response should be in JSON

  Scenario: Cannot create webhook with invalid protocol
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/webhooks" with body:
      """
      {
          "name": "FTP Webhook",
          "uri": "ftp://webhook.example.com/test",
          "eventStart": true,
          "eventRing": false,
          "eventAnswer": false,
          "eventEnd": false,
          "template": "{\"event\": \"start\"}",
          "brand": 1,
          "company": 1
      }
      """
     Then the response status code should be 400
      And the response should be in JSON

  Scenario: Create brand-level webhook successfully
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/webhooks" with body:
      """
      {
          "name": "Brand Level Webhook",
          "uri": "https://webhook.brand.com/events",
          "eventStart": true,
          "eventRing": false,
          "eventAnswer": false,
          "eventEnd": true,
          "template": "{\"event\": \"{event}\", \"brand\": \"{brandId}\"}",
           "company": null,
           "ddi": null
       }
      """
     Then the response status code should be 201
      And the response should be in JSON
      And the JSON should be like:
      """
      {
          "name": "Brand Level Webhook",
          "description": null,
          "uri": "https://webhook.brand.com/events",
          "eventStart": true,
          "eventRing": false,
          "eventAnswer": false,
          "eventEnd": true,
            "template": "{\"event\": \"{event}\", \"brand\": \"{brandId}\"}",
            "id": 8,
            "company": null,
            "ddi": null
      }
      """

  Scenario: Cannot create webhook with brand inconsistent with company
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/webhooks" with body:
      """
      {
          "name": "Inconsistent Brand Webhook",
          "uri": "https://webhook.inconsistent.com/brand",
          "eventStart": true,
          "eventRing": false,
          "eventAnswer": false,
          "eventEnd": false,
           "template": "{\"event\": \"start\"}",
           "brand": 1,
           "company": 6
      }
      """
     Then the response status code should be 400
      And the response should be in JSON

  Scenario: Cannot create webhook with inconsistent DDI/Company/Brand
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/webhooks" with body:
      """
      {
          "name": "Inconsistent Webhook",
          "uri": "https://webhook.inconsistent.com/test",
          "eventStart": true,
          "eventRing": false,
          "eventAnswer": false,
          "eventEnd": false,
          "template": "{\"event\": \"start\"}",
          "ddi": 1,
          "company": 2
      }
      """
     Then the response status code should be 400
      And the response should be in JSON

  Scenario: Cannot create webhook with description too long
    Given I add Brand Authorization header
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
          "template": "{\"event\": \"start\"}",
          "company": 1
      }
      """
     Then the response status code should be 400
      And the response should be in JSON
