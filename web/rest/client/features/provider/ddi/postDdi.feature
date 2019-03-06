Feature: Create Ddis
  In order to manage Ddis
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a Ddi
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/ddis" with body:
    """
      {
          "ddi": "1234",
          "ddie164": "+341234",
          "recordCalls": "none",
          "displayName": "",
          "routeType": "user",
          "billInboundCalls": false,
          "friendValue": "",
          "company": 2,
          "brand": 1,
          "conferenceRoom": null,
          "language": null,
          "queue": null,
          "externalCallFilter": null,
          "user": 1,
          "ivr": null,
          "huntGroup": null,
          "fax": null,
          "ddiProvider": null,
          "country": 1,
          "residentialDevice": null,
          "conditionalRoute": null
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "ddi": "1234",
          "ddie164": "+341234",
          "recordCalls": "none",
          "displayName": "",
          "routeType": "user",
          "billInboundCalls": false,
          "friendValue": "",
          "id": 2,
          "company": 2,
          "conferenceRoom": null,
          "language": null,
          "queue": null,
          "externalCallFilter": null,
          "user": 1,
          "ivr": null,
          "huntGroup": null,
          "fax": null,
          "country": 1,
          "residentialDevice": null,
          "conditionalRoute": null,
          "retailAccount": null
      }
    """

  Scenario: Retrieve created Ddi
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "ddis/2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "ddi": "1234",
          "ddie164": "+341234",
          "recordCalls": "none",
          "displayName": "",
          "routeType": "user",
          "billInboundCalls": false,
          "friendValue": "",
          "id": 2,
          "company": "~",
          "conferenceRoom": null,
          "language": null,
          "queue": null,
          "externalCallFilter": null,
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
              "language": null,
              "terminal": 1,
              "extension": null,
              "timezone": 1,
              "outgoingDdi": null,
              "outgoingDdiRule": null,
              "voicemailLocution": null
          },
          "ivr": null,
          "huntGroup": null,
          "fax": null,
          "country": {
              "code": "ES",
              "countryCode": "+34",
              "id": 1,
              "name": {
                  "en": "Spain",
                  "es": "España"
              },
              "zone": {
                  "en": "Europe",
                  "es": "Europa"
              }
          },
          "residentialDevice": null,
          "conditionalRoute": null,
          "retailAccount": null
      }
    """
