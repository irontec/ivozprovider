Feature: Retrieve extensions
  In order to manage extensions
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the extensions json list
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "extensions"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      [
          {
              "number": "101",
              "id": 1
          },
          {
              "number": "102",
              "id": 2
          },
          {
              "number": "12346",
              "routeType": "number",
              "id": 3
          }
      ]
    """

  Scenario: Retrieve certain extension json
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "extensions/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      {
          "number": "101",
          "routeType": "user",
          "numberValue": null,
          "friendValue": null,
          "id": 1,
          "company": {
              "type": "vpbx",
              "name": "DemoCompany",
              "domainUsers": "127.0.0.1",
              "nif": "12345678A",
              "distributeMethod": "hash",
              "maxCalls": 0,
              "postalAddress": "Company Address",
              "postalCode": "54321",
              "town": "Company Town",
              "province": "Company Province",
              "countryName": "Company Country",
              "ipfilter": false,
              "onDemandRecord": 0,
              "onDemandRecordCode": "",
              "externallyextraopts": "",
              "recordingsLimitMB": null,
              "recordingsLimitEmail": "",
              "id": 1,
              "language": 1,
              "mediaRelaySets": 1,
              "defaultTimezone": 1,
              "brand": 1,
              "domain": 3,
              "applicationServer": null,
              "country": 1,
              "transformationRuleSet": 1,
              "outgoingDdi": null,
              "outgoingDdiRule": null,
              "voicemailNotificationTemplate": null,
              "outgoingDdiRule": null,
              "voicemailNotificationTemplate": 1,
              "faxNotificationTemplate": null
          },
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
