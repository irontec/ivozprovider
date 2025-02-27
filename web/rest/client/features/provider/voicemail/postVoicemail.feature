Feature: Create voicemails
  In order to manage voicemails
  As a client admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a voicemail
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/voicemails" with body:
      """
      {
          "name": "newGenericVoicemail",
          "email": "generic@voicemail.com",
          "sendMail": true,
          "attachSound": true
      }
      """
     Then the response status code should be 201
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "enabled": true,
          "name": "newGenericVoicemail",
          "email": "generic@voicemail.com",
          "sendMail": true,
          "attachSound": true,
          "id": 6,
          "user": null,
          "residentialDevice": null,
          "company": 1,
          "locution": null,
          "relUserIds": []
      }
      """

  Scenario: Retrieve created voicemail
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "/voicemails/6"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "enabled": true,
          "name": "newGenericVoicemail",
          "email": "generic@voicemail.com",
          "sendMail": true,
          "attachSound": true,
          "id": 6,
          "user": null,
          "residentialDevice": null,
          "company": {
              "type": "vpbx",
              "name": "DemoCompany",
              "domainUsers": "127.0.0.1",
              "onDemandRecordCode": "",
              "balance": 1.2,
              "id": 1,
              "invoicing": {
                  "nif": "12345678A"
              },
              "language": 1,
              "defaultTimezone": 145,
              "country": 68,
              "transformationRuleSet": 1,
              "outgoingDdi": null,
              "outgoingDdiRule": null
          },
          "locution": null,
          "relUserIds": []
      }
      """

  Scenario: Create a generic voicemail with rel users
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/voicemails" with body:
      """
      {
          "enabled":true,
          "sendMail":"0",
          "locution":null,
          "relUserIds":["1","2"],
          "name":"newGenericVoicemail2"
      }
      """
     Then the response status code should be 201
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "enabled": true,
          "name": "newGenericVoicemail2",
          "email": null,
          "sendMail": false,
          "attachSound": true,
          "id": 7,
          "user": null,
          "residentialDevice": null,
          "company": 1,
          "locution": null,
          "relUserIds": [
              1,
              2
          ]
      }
      """

# # Only vpbx clients can create generic voicemails
