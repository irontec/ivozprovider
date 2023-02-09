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
          "id": 5,
          "user": null,
          "residentialDevice": null,
          "company": 1,
          "locution": null
      }
    """

  Scenario: Retrieve created voicemail
    Given I add Company Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/voicemails/2"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be like:
    """
      {
          "enabled": true,
          "name": "Voicemail For Residential 1",
          "email": "",
          "sendMail": false,
          "attachSound": false,
          "id": 2,
          "user": null,
          "residentialDevice": {
              "name": "residentialDevice",
              "description": "",
              "transport": "udp",
              "password": "+rA778LidL",
              "id": 1,
              "transformationRuleSet": null,
              "outgoingDdi": null,
              "language": null
          },
          "company": {
              "type": "vpbx",
              "name": "DemoCompany",
              "domainUsers": "127.0.0.1",
              "nif": "12345678A",
              "onDemandRecordCode": "",
              "balance": 1.2,
              "id": 1,
              "language": 1,
              "defaultTimezone": 145,
              "country": 68,
              "transformationRuleSet": 1,
              "outgoingDdi": null,
              "outgoingDdiRule": null
          },
          "locution": null
      }
    """
