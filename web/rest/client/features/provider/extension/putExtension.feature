Feature: Update extensions
  In order to manage extensions
  As an super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update an extensions
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/extensions/1" with body:
    """
       {
          "number": "108",
          "routeType": "user",
          "numberValue": null,
          "friendValue": null,
          "id": 1,
          "company": 1,
          "ivr": null,
          "huntGroup": null,
          "conferenceRoom": null,
          "user": 1,
          "queue": null,
          "conditionalRoute": null,
          "numberCountry": 2
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be like:
    """
      {
          "number": "108",
          "routeType": "user",
          "numberValue": null,
          "friendValue": null,
          "id": 1,
          "company": "~",
          "ivr": null,
          "huntGroup": null,
          "conferenceRoom": null,
          "user": {
              "name": "Alice",
              "lastname": "Allison",
              "email": "alice@democompany.com",
              "pass": "*****",
              "doNotDisturb": false,
              "isBoss": false,
              "active": true,
              "maxCalls": 1,
              "externalIpCalls": "0",
              "voicemailEnabled": true,
              "voicemailSendMail": true,
              "voicemailAttachSound": true,
              "tokenKey": "ec6a6536ca304edf844d1d248a4f08dc",
              "gsQRCode": false,
              "id": 1,
              "company": 1,
              "callAcl": null,
              "bossAssistant": null,
              "bossAssistantWhiteList": null,
              "transformationRuleSet": 1,
              "language": null,
              "terminal": 1,
              "extension": null,
              "timezone": 1,
              "outgoingDdi": null,
              "outgoingDdiRule": null,
              "voicemailLocution": null
          },
          "queue": null,
          "conditionalRoute": null,
          "numberCountry": null
      }
    """
