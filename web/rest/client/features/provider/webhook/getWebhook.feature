Feature: Retrieve webhooks
  In order to manage webhooks
  As a company admin
  I need to be able to retrieve my company's webhooks through the API.

  @createSchema
  Scenario: Retrieve the webhooks json list for my company
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "/webhooks"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "name": "Answer Webhook Company 1",
              "description": null,
              "uri": "https://webhook.company1.com/answer",
              "eventStart": false,
              "eventRing": false,
              "eventAnswer": true,
              "eventEnd": false,
              "template": "{\"event\": \"answer\", \"callId\": \"{callId}\"}",
              "id": 2
          },
          {
              "name": "DDI Specific Webhook",
              "description": null,
              "uri": "https://webhook.ddi.com/123456",
              "eventStart": false,
              "eventRing": true,
              "eventAnswer": false,
              "eventEnd": false,
              "template": "{\"event\": \"ring\", \"ddi\": \"{ddiId}\"}",
              "id": 5
          },
          {
              "name": "Start Webhook Company 1",
              "description": null,
              "uri": "https://webhook.company1.com/start",
              "eventStart": true,
              "eventRing": false,
              "eventAnswer": false,
              "eventEnd": false,
              "template": "{\"event\": \"start\", \"callId\": \"{callId}\"}",
              "id": 1
          }
      ]
      """

  Scenario: Retrieve certain webhook json
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "/webhooks/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
         "name": "Start Webhook Company 1",
         "description": null,
         "uri": "https://webhook.company1.com/start",
         "eventStart": true,
         "eventRing": false,
         "eventAnswer": false,
         "eventEnd": false,
         "template": "{\"event\": \"start\", \"callId\": \"{callId}\"}",
         "id": 1,
         "company": {
             "type": "vpbx",
             "name": "DemoCompany",
             "id": 1,
             "*": "~"
         },
         "ddi": null
      }
      """
